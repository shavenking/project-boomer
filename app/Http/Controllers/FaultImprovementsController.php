<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FaultImprovementsController extends Controller
{
    public function index($projectId)
    {
        $project = \App\Entities\Project::findOrFail($projectId);

        $checklists = $project->checklists()->has('checkitems.faultImprovement')->get()->map(function ($checklist) {
            // Reject passes or unchecked checkitems
            $checklist->checkitems = $checklist->checkitems->reject(function ($checkitem) {
                return is_null($checkitem->faultImprovement);
            });

            return $checklist;
        });

        return view('project-fault-improvements.index')
            ->withProject($project)
            ->withChecklists($checklists);
    }

    public function show($projectId, $faultImprovementId)
    {
        $project = \App\Entities\Project::findOrFail($projectId);
        $faultImprovement = \App\Entities\FaultImprovement::findOrFail($faultImprovementId);
        $checklist = $faultImprovement->checkitem->checklist;

        return view('fault-improvements.show', compact('project', 'faultImprovement', 'checklist'));
    }

    public function update($projectId, $faultImprovementId, Request $request)
    {
        $faultImprovement = \App\Entities\FaultImprovement::findOrFail($faultImprovementId);

        $photoKeys = ['before_photo', 'current_photo', 'after_photo'];

        $collection = ['passes' => $request->input('passes')];

        foreach ($photoKeys as $photoKey) {
            if ($request->hasFile($photoKey)) {
                $photo = $request->file($photoKey3)->move(public_path('images', rand()));

                $collection[$photoKey] = $photo->getFileName();
            }
        }

        $faultImprovement->update($collection);

        return redirect()->route('projects.checklists.show', [$projectId, $faultImprovement->checkitem->checklist->id]);
    }
}
