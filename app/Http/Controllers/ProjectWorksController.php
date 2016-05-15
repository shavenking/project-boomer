<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProjectWorksController extends Controller
{
    public function index($projectId, Request $request)
    {
        $mainflowTypeId = $request->query('mainflow_type_id');
        $detailingflowTypeId = $request->query('detailingflow_type_id');

        $project = \App\Entities\Project::findOrFail($projectId);

        $query = \App\Entities\ProjectWork::query();

        if (!empty($mainflowTypeId)) {
            $query->whereHas('detailingflowType', function ($query) use ($mainflowTypeId) {
                $query->whereMainflowTypeId($mainflowTypeId);
            });

            $mainflowTypeName = \App\Entities\MainflowType::findOrFail($mainflowTypeId)->name;
        }

        if (!empty($detailingflowTypeId)) {
            $query->whereDetailingflowTypeId($detailingflowTypeId);

            $detailingflowTypeName = \App\Entities\DetailingflowType::findOrFail($detailingflowTypeId)->name;
        }

        $works = $query->whereProjectId($project->id)->with('detailingflowType.mainflowType', 'unit')->get();

        return response()->json(compact('works'));
    }

    public function indexOfWorkitems($projectId, $workId)
    {
        $workitems = \App\Entities\ProjectWorkitem::whereProjectWorkId($workId)->get();

        return response()->json(compact('workitems'));
    }

    public function search($projectId, Request $request)
    {
        $project = \App\Entities\Project::findOrFail($projectId);

        return view('project-works.search', compact('project'));
    }

    public function create($projectId)
    {
        $project = \App\Entities\Project::findOrFail($projectId);

        return view('project-works.create')->withProject($project);
    }

    public function createOfWorkitems($projectId, $workId)
    {
        $project = \App\Entities\Project::findOrFail($projectId);
        $work = \App\Entities\ProjectWork::findOrFail($workId);
        $units = \App\Entities\Unit::all();
        $costTypes = \App\Entities\CostType::all();

        return view('project-workitems.create', compact('project', 'work', 'units', 'costTypes'));
    }

    public function store($projectId, Request $request)
    {
        $this->validate($request, [
            'work_id' => 'required',
            'name' => 'required'
        ]);

        $work = \App\Entities\Work::findOrFail($request->input('work_id'));

        $project = \App\Entities\Project::findOrFail($projectId);

        $projectWork = $project->works()->create(array_merge($work->toArray(), [
            'name' => $request->input('name')
        ]));

        $work->items->each(function ($item) use ($projectWork) {
            $projectWork->workitems()->create($item->toArray());
        });

        if ($request->ajax()) {
            return response()->json();
        }

        return redirect()->route('projects.bid.works', $projectId);
    }

    public function storeOfWorkitems($projectId, $workId, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'amount' => 'required',
            'unit_price' => 'required',
            'unit_id' => 'required',
            'cost_type_id' => 'required'
        ]);

        $work = \App\Entities\ProjectWork::findOrFail($workId);

        $workitem = $work->workitems()->create($request->all());
        $work->reCalculateUnitPrice();

        if ($request->ajax()) {
            return response()->json(compact('workitem'));
        }

        return redirect()->route('projects.works.show', [$projectId, $workId]);
    }

    public function updateOfWorkitems($projectId, $workId, $workitemId, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'amount' => 'required',
            'unit_price' => 'required'
        ]);

        $workitem = \App\Entities\ProjectWorkitem::findOrFail($workitemId);

        $workitem->update($request->all());

        $workitem->work->recalculateUnitPrice();

        if ($request->ajax()) {
            return response()->json(compact('workitem'));
        }

        return redirect()->route('projects.works.show', [$projectId, $workitem->work->id]);
    }

    public function show($projectId, $workId)
    {
        $project = \App\Entities\Project::findOrFail($projectId);
        $work = \App\Entities\ProjectWork::findOrFail($workId);

        return view('project-works.show')
            ->withProject($project)
            ->withWork($work);
    }

    public function update($projectId, $workId, Request $request)
    {
        \App\Entities\ProjectWork::findOrFail($workId)->update(array_only($request->all(), 'amount'));

        return response()->json();
    }

    public function destroy($projectId, $workId)
    {
        $work = \App\Entities\ProjectWork::findOrFail($workId);

        \App\Entities\ProjectWorkitem::destroy($work->workitems()->lists('id')->all());

        $work->delete();

        return redirect()->route('projects.bid.works', $projectId);
    }

    public function destroyOfWorkitems($projectId, $workId, $workitemId, Request $request)
    {
        $workitem = \App\Entities\ProjectWorkitem::findOrFail($workitemId);

        $work = \App\Entities\ProjectWork::findOrFail($workitem->getAttribute('project_work_id'));

        $workitem->delete();
        $work->reCalculateUnitPrice();

        if ($request->ajax()) {
            return response()->json();
        }

        return redirect()->route('projects.works.show', [$projectId, $work->id]);
    }
}
