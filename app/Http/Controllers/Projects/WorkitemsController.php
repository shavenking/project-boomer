<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WorkitemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($projectId, $workitemId)
    {
        $project = \App\Entities\Project::findOrFail($projectId);
        $workitem = \App\Entities\ProjectWorkitem::findOrFail($workitemId);
        $work = $workitem->work;

        return view('project-workitems.edit')
            ->withProject($project)
            ->withWorkitem($workitem)
            ->withWork($work);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($projectId, $workitemId, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'amount' => 'required',
            'unit_price' => 'required'
        ]);

        $workitem = \App\Entities\ProjectWorkitem::findOrFail($workitemId);

        $workitem->update($request->all());

        $workitem->work->recalculateUnitPrice();

        return redirect()->route('projects.works.show', [$projectId, $workitem->work->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($projectId, $workitemId)
    {
        $workitem = \App\Entities\ProjectWorkitem::findOrFail($workitemId);

        $work = \App\Entities\ProjectWork::findOrFail($workitem->getAttribute('project_work_id'));

        $workitem->delete();
        $work->reCalculateUnitPrice();

        return redirect()->route('projects.works.show', [$projectId, $work->id]);
    }
}
