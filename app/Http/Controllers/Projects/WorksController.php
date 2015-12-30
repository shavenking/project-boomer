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
            'work_id' => 'required',
            'name' => 'required',
            'amount' => 'required',
            'unit_price' => 'required'
        ]);

        $work = \App\Entities\ProjectWork::create(array_except($request->all(), 'unit_price'));

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
    public function show($id)
    {
        return 'coming soon';
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
    public function destroy($id)
    {
        //
    }
}
