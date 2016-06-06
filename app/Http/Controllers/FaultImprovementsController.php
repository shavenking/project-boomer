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

        if ($request->ajax()) {
            foreach (['before_notes', 'current_notes', 'after_notes'] as $key) {
                if ($request->has($key)) {
                    $faultImprovement->update([$key => $request->input($key)]);
                }
            }

            return response()->json([
                'fault_improvement' => $faultImprovement
            ]);
        }

        $this->validate($request, ['passes' => 'required']);

        $faultImprovement->update(['passes' => $request->input('passes')]);

        return redirect()->route('projects.checklists.show', [$projectId, $faultImprovement->checkitem->checklist->id]);
    }

    public function storePhotos($projectId, $faultImprovementId, $step, Request $request)
    {
        $this->validate($request, [
            'file' => 'required|image'
        ]);

        $faultImprovement = \App\Entities\FaultImprovement::findOrFail($faultImprovementId);

        $photo = $request->file('file')->move(public_path('images', rand()));

        $faultImprovement->update([
            "{$step}_photo" => $photo->getFilename()
        ]);

        return response()->json([
            'photo' => $photo->getFilename()
        ]);
    }
}
