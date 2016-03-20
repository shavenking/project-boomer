<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Entities\Project;
use App\Entities\Checklist;
use App\Entities\ProjectChecklist;

class ProjectChecklistsController extends Controller
{
    public function index($projectId)
    {
        $project = Project::findOrFail($projectId);

        $checklists = $project->checklists()->whereHas('checkitems', function ($q) {
            $q->wherePasses(null);
        })->get();

        return view('project-checklists.index')
            ->withProject($project)
            ->withChecklists($checklists);
    }

    public function create($projectId)
    {
        $project = Project::findOrFail($projectId);

        $checklists = Checklist::all();

        return view('project-checklists.create')
            ->withProject($project)
            ->withChecklists($checklists);
    }

    public function store($projectId, Request $request)
    {
        $this->validate($request, [
            'checklist_id' => 'required',
            'name' => 'required'
        ]);

        $project = Project::findOrFail($projectId);

        $referencedChecklist = Checklist::findOrFail($request->input('checklist_id'));

        $checklist = $project->checklists()->create(
            array_merge(
                $referencedChecklist->toArray(), [
                    'name' => $request->input('name'),
                    'passes_amount' => 0
                ]
            )
        );

        foreach ($referencedChecklist->checkitems as $checkitem) {
            $checklist->checkitems()->create([
                'name' => $checkitem->name,
                'detail' => $checkitem->detail
            ]);
        }

        return redirect()->route('projects.checklists.show', [$projectId, $checklist->id]);
    }

    public function show($projectId, $checklistId)
    {
        $project = Project::findOrFail($projectId);

        $checklist = ProjectChecklist::findOrFail($checklistId);

        return view('project-checklists.show')
            ->withProject($project)
            ->withChecklist($checklist);
    }

    public function updateCheckitemsResults($projectId, $checklistId, Request $request)
    {
        $checklist = ProjectChecklist::findOrFail($checklistId);

        $checklist->update([
            'passes_amount' => $request->passes_amount
        ]);

        $checklist->checkitems->each(function ($checkitem) use ($request) {
            $checkitem->update([
                'passes' => $request->passes[$checkitem->id]
            ]);

            if (!is_null($checkitem->passes) && !$checkitem->passes) {
                $checkitem->faultImprovement()->create([]);
            } else {
                if ($checkitem->faultImprovement) {
                    $checkitem->faultImprovement->delete();
                }
            }
        });

        return redirect()->route('projects.checklists.show', [$projectId, $checklistId]);
    }
}
