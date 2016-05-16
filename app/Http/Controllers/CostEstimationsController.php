<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DatePeriod;
use DateInterval;

use App\Entities\{ Project, ProjectChecklist, CostEstimation };

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

        return view('cost-estimations.show', compact('project', 'date'));
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

        return response()->json([
            'project_checklists' => $pChecklists
        ]);
    }
}
