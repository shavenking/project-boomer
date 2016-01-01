<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Entities\Project;
use App\Entities\Checklist;
use App\Entities\ProjectChecklist;

class ChecklistsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($projectId)
    {
        $project = Project::findOrFail($projectId);

        return view('project-checklists.index')->withProject($project);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($projectId)
    {
        $project = Project::findOrFail($projectId);

        $checklists = Checklist::all();

        return view('project-checklists.create')
            ->withProject($project)
            ->withChecklists($checklists);
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
            'checklist_id' => 'required',
            'name' => 'required'
        ]);

        $project = Project::findOrFail($projectId);

        $checklist = $project->checklists()->create(array_only(
            $request->all(),
            ['checklist_id', 'name']
        ));

        foreach ($checklist->originalCheckitems as $checkitem) {
            $checklist->checkitems()->create([
                'project_id' => $projectId,
                'checkitem_id' => $checkitem->id
            ]);
        }

        return redirect()->route('projects.checklists.show', [$projectId, $checklist->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($projectId, $checklistId)
    {
        $project = Project::findOrFail($projectId);

        $checklist = ProjectChecklist::findOrFail($checklistId);

        return view('project-checklists.show')
            ->withProject($project)
            ->withChecklist($checklist);
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

    public function updateCheckitemsResults($projectId, $checklistId, Request $request)
    {
        $checklist = ProjectChecklist::findOrFail($checklistId);

        $checklist->checkitems->each(function ($checkitem) use ($request) {
            $checkitem->update([
                'passes' => $request->passes[$checkitem->id]
            ]);
        });

        return redirect()->route('projects.checklists.show', [$projectId, $checklistId]);
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
