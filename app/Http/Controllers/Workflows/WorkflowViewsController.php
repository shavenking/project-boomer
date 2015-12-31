<?php

namespace App\Http\Controllers\Workflows;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WorkflowViewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('workflows.index');
    }

    public function checklist($workflowId)
    {
        $workflow = app(\App\Entities\Workflow::class)->findOrFail($workflowId);

        return redirect()->route('checklists.show', $workflow->checklist->id);
    }

    public function works($id)
    {
        $workflow = app(\App\Entities\Workflow::class)->findOrFail($id);

        $works = app(\App\Entities\Work::class)->whereWorkflowId($workflow->id)->get();

        return view('workflows.works')->withWorkflow($workflow)->withWorks($works);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('workflows.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validate($request, [
            'name' => 'required'
        ]);

        $name = $request->input('name');

        $workflow = app(\App\Entities\Workflow::class)->create(compact('name'));

        if ($request->has('work_ids')) {
            $workIds = explode(',', $request->input('work_ids'));
            $works = app(\App\Entities\Work::class)->findOrFail($workIds);

            foreach ($works as $work) {
                $work->update(['workflow_id' => $workflow->id]);
            }
        }

        return redirect()->route('workflows.show', $workflow->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $workflow = app(\App\Entities\Workflow::class)->findOrFail($id);

        return view('workflows.show')->withWorkflow($workflow);
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
