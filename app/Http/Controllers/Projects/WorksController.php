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
    public function index(Request $request)
    {
        $detailingflowTypeId = $request->query('detailingflow_type_id');

        // if ($detailingflowTypeId) {
        //     $workIds = \App\Entities\Work::whereDetailingflowTypeId($detailingflowTypeId)->lists('id');
        //     $works = \App\Entities\ProjectWork::whereIn('work_id', $workIds)->get();
        // } else {
            $works = \App\Entities\ProjectWork::all();
        // }

        return response()->json(compact('works'));
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
            'detailingflow_type_id' => 'required',
            'work_id' => 'required',
            'name' => 'required',
            'amount' => 'required',
            'unit_price' => 'required'
        ]);

        $referencedWork = \App\Entities\Work::findOrFail($request->input('work_id'));

        $project = \App\Entities\Project::findOrFail($projectId);

        $work = $project->works()->create(array_merge($referencedWork->toArray(), [
            'name' => $request->input('name'),
            'amount' => $request->input('amount')
        ]));

        foreach ($referencedWork->items as $workitem) {
            $work->workitems()->create($workitem->toArray());
        }

        if ($request->ajax()) {
            return response()->json(compact('work'));
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

        \App\Entities\ProjectWorkitem::destroy($work->workitems()->lists('id'));

        $work->delete();

        return redirect()->route('projects.bid.works', $projectId);
    }
}
