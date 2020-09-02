<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DatePeriod;
use DateInterval;

use App\Entities\{
    CostEstimationBounce, Project, ProjectChecklist, CostEstimation
};

class CostEstimationsController extends Controller
{
    public function index($projectId)
    {
        $project = Project::findOrFail($projectId);

        $costEstimations = $project->costEstimations->sortByDesc('settled_at');

        return view('cost-estimations.index', compact('project', 'costEstimations'));
    }

    public function create($projectId, Request $request)
    {
        $this->validate($request, [
            'date' => 'required|date'
        ]);

        $project = Project::findOrFail($projectId);

        $date = new Carbon($request->date);

        return view('cost-estimations.create', compact('project', 'date'));
    }

    public function store($projectId, Request $request)
    {
        $date = new Carbon($request->date);

        $project = Project::findOrFail($projectId);

        $project->costEstimations()->create(['settled_at' => $date]);

        return redirect()->route('projects.cost-estimations.show', [$projectId, $date->toDateString()]);
    }

    public function show($projectId, $date)
    {
        $project = Project::findOrFail($projectId);
        $date = new Carbon($date);
        $costEstimation = $project->costEstimations()->whereDate('settled_at', '=', $date)->firstOrFail();

        return view('cost-estimations.show', compact('project', 'date', 'costEstimation'));
    }

    /**
     * Show all available bounces.
     */
    public function allBounces()
    {
        $costEstimationBounces = CostEstimationBounce::all();

        return response()->json([
            'cost_estimation_bounces' => $costEstimationBounces->load('unit')
        ]);
    }

    /**
     * Create or Add CostEstimationBounce
     *
     * @param $projectId
     * @param $costEstimationId
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeBounce($projectId, $costEstimationId, Request $request)
    {
        $this->validate($request, [
            'name' => 'required_without:cost_estimation_bounce_id',
            'cost_estimation_bounce_id' => 'required_without:name',
            'unit_id' => 'required',
            'unit_price' => 'required',
            'amount' => 'required'
        ]);

        $project = Project::findOrFail($projectId);
        $costEstimation = $project->costEstimations()->findOrFail($costEstimationId);

        if ($request->has('name')) {
            $costEstimation->bounces()->create([
                'name' => $request->input('name'),
                'unit_id' => $request->input('unit_id'),
            ], [
                'unit_price' => $request->input('unit_price'),
                'amount' => $request->input('amount')
            ]);
        }

        if ($request->has('cost_estimation_bounce_id')) {
            $costEstimationBounce = $costEstimation->bounces()->find(
                $request->input('cost_estimation_bounce_id')
            );

            if ($costEstimationBounce) {
                $costEstimation->bounces()->updateExistingPivot($costEstimationBounce->id, [
                    'unit_price' => $request->input('unit_price'),
                    'amount' => $request->input('amount')
                ]);
            } else {
                $costEstimation->bounces()->attach(
                    $request->input('cost_estimation_bounce_id'),
                    [
                        'unit_price' => $request->input('unit_price'),
                        'amount' => $request->input('amount')
                    ]
                );
            }
        }

        return response()->json();
    }

    public function getPreviousEstimation($projectId, $projectWorkId, Request $request)
    {
        $this->validate($request, ['date' => 'required|date']);

        $projectWork = Project::findOrFail($projectId)->works()->findOrFail($projectWorkId);

        $date = new Carbon($request->input('date'));

        $previousEstimation = CostEstimation::whereDate('settled_at', '<', $date)->orderBy('settled_at', 'desc')->first(['settled_at']);

        if (!$previousEstimation) {
            return response()->json();
        }

        $previousDate = new Carbon(
            $previousEstimation->settled_at
        );

        $pChecklists = ProjectChecklist::whereHas('projectWork', function ($q) use ($projectWork) {
            $q->whereProjectWorkId($projectWork->id);
        })->whereHas('checkitems', function ($q) {
            $q->whereNull('passes');
        }, '=', 0)->whereDate('finished_at', '<=', $previousDate)->get();

        $repo = new \App\Repos\ReviewRepo;
        $pChecklists = $pChecklists->reject(function ($pChecklist) use ($repo, $date) {
            $latestReview = $repo->getLatestReview('project_checklist', $pChecklist->id);

            return !$latestReview || $latestReview->status !== 'finished' || $latestReview->updated_at->gt($date);
        });

        return response()->json([
            'project_checklists' => $pChecklists
        ]);
    }

    public function estimations($projectId, $projectWorkId, Request $request)
    {
        $projectWork = Project::findOrFail($projectId)->works()->findOrFail($projectWorkId);

        $date = new Carbon($request->input('date', 'today'));

        $pChecklists = ProjectChecklist::whereHas('projectWork', function ($q) use ($projectWork) {
            $q->whereProjectWorkId($projectWork->id);
        })->whereHas('checkitems', function ($q) {
            $q->whereNull('passes');
        }, '=', 0)->whereDate('finished_at', '<=', $date)->get();

        $repo = new \App\Repos\ReviewRepo;
        $pChecklists = $pChecklists->reject(function ($pChecklist) use ($repo, $date) {
            $latestReview = $repo->getLatestReview('project_checklist', $pChecklist->id);

            return !$latestReview || $latestReview->status !== 'finished' || $latestReview->updated_at->gt($date);
        });

        return response()->json([
            'project_checklists' => $pChecklists
        ]);
    }

    public function getBouncesByProject($projectId, Request $request)
    {
        $project = Project::findOrFail($projectId);

        $query = $project->costEstimations();

        if ($request->has('cost_estimation_id')) {
            $costEstimation = $project->costEstimations()->findOrFail($request->input('cost_estimation_id'));

            $query->whereDate('settled_at', '<=', $costEstimation->settled_at);
        }

        $costEstimations = $query->with('bounces')->get();

        $results = $costEstimations->map(function ($costEstimation) {
            return $costEstimation->bounces;
        })->collapse()->map($this->getJsonTransformer());

        return response()->json([
            'cost_estimation_bounces' => $results
        ]);
    }

    protected function getJsonTransformer()
    {
        return function ($model) {
            return [
                'id' => $model->pivot->id,
                'cost_estimation_bounce_id' => $model->id,
                'cost_estimation_id' => $model->pivot->cost_estimation_id,
                'name' => $model->name,
                'amount' => (int) $model->pivot->amount,
                'unit_price' => (int) $model->pivot->unit_price,
                'unit_name' => $model->unit->name,
                'created_at' => (string) $model->pivot->created_at,
                'updated_at' => (string) $model->pivot->updated_at
            ];
        };
    }
}
