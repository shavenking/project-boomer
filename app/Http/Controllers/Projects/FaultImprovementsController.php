<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FaultImprovementsController extends Controller
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
    public function show($projectId, $faultImprovementId)
    {
        $project = \App\Entities\Project::findOrFail($projectId);
        $faultImprovement = \App\Entities\FaultImprovement::findOrFail($faultImprovementId);
        $checklist = $faultImprovement->checkitem->checklist;

        return view('fault-improvements.show', compact('project', 'faultImprovement', 'checklist'));
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
    public function update($projectId, $faultImprovementId, Request $request)
    {
        $faultImprovement = \App\Entities\FaultImprovement::findOrFail($faultImprovementId);

        $photoKeys = ['before_photo', 'current_photo', 'after_photo'];

        $collection = ['passes' => $request->input('passes')];

        foreach ($photoKeys as $photoKey) {
            if ($request->hasFile($photoKey)) {
                $photo = $request->file($photoKey)->move(public_path('images', rand()));

                $collection[$photoKey] = $photo->getFileName();
            }
        }

        $faultImprovement->update($collection);

        return redirect()->route('projects.checklists.show', [$projectId, $faultImprovement->checkitem->checklist->id]);
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
