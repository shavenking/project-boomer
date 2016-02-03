<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WorksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        $works = $query->with('detailingflowType.mainflowType', 'unit')->get();

        return response()->json(compact('works'));
    }

    public function search($projectId, Request $request)
    {
        $project = \App\Entities\Project::findOrFail($projectId);

        return view('project-works.search', compact('project'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($projectId)
    {
        $project = \App\Entities\Project::findOrFail($projectId);

        return view('project-works.create')->withProject($project);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($projectId, Request $request)
    {
        $this->validate($request, [
            'work_ids' => 'required'
        ]);

        $workIds = explode(',', $request->input('work_ids'));

        $works = \App\Entities\Work::findOrFail($workIds);

        $project = \App\Entities\Project::findOrFail($projectId);

        $works->each(function ($work) use ($project) {
            $projectWork = $project->works()->create($work->toArray());

            $work->items->each(function ($item) use ($projectWork) {
                $projectWork->workitems()->create($item->toArray());
            });
        });

        if ($request->ajax()) {
            return response()->json();
        }

        return redirect()->route('projects.bid.works', $projectId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($projectId, $workId)
    {
        $project = \App\Entities\Project::findOrFail($projectId);
        $work = \App\Entities\ProjectWork::findOrFail($workId);

        return view('project-works.show')
            ->withProject($project)
            ->withWork($work);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($projectId, $workId)
    {
        $work = \App\Entities\ProjectWork::findOrFail($workId);

        \App\Entities\ProjectWorkitem::destroy($work->workitems()->lists('id')->all());

        $work->delete();

        return redirect()->route('projects.bid.works', $projectId);
    }
}
