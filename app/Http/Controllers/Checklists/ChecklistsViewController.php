<?php

namespace App\Http\Controllers\Checklists;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ChecklistsViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $checklists = \App\Entities\Checklist::all();

        return view('checklists.index')->withChecklists($checklists);
    }

    public function workflow($checklistId)
    {
        $checklist = \App\Entities\Checklist::findOrFail($checklistId);

        return view('checklists.workflow')->withChecklist($checklist);
    }

    public function works($checklistId)
    {
        $checklist = \App\Entities\Checklist::findOrFail($checklistId);

        return view('checklists.works')->withChecklist($checklist);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $workflows = \App\Entities\Workflow::all();

        return view('checklists.create', compact('workflows'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $checklist = \App\Entities\Checklist::create(array_only($request->all(), ['workflow_id', 'name']));

        return redirect()->route('checklists.show', $checklist->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $checklist = \App\Entities\Checklist::findOrFail($id);

        return view('checklists.show')->withChecklist($checklist);
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
