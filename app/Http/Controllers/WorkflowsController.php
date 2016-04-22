<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Entities\Work;
use App\Entities\Checklist;
use App\Entities\Workflow;
use App\Entities\WorkflowNode;

class WorkflowsController extends Controller
{
    public function index(Request $request)
    {
        $workflows = Workflow::all();

        if ($request->ajax()) {
            return response()->json(compact('workflows'));
        }

        return view('workflows.index')->withWorkflows($workflows);
    }

    public function indexOfNodes($workflowId)
    {
        $workflow = Workflow::with('nodes')->findOrFail($workflowId);

        $nodes = $workflow->nodes;

        return response()->json(compact('workflow', 'nodes'));
    }

    public function create()
    {
        return view('workflows.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $workflow = Workflow::create([
            'name' => $request->name
        ]);

        if ($request->has('work_ids')) {
            $workIds = explode(',', $request->input('work_ids'));
            $works = Work::findOrFail($workIds);

            foreach ($works as $work) {
                $work->update(['workflow_id' => $workflow->id]);
            }
        }

        if ($request->ajax()) {
            return response()->json(compact('workflow'));
        }

        return redirect()->route('workflows.show', $workflow->id);
    }

    public function storeOfNodes($workflowId, Request $request)
    {
        $node = Workflow::findOrFail($workflowId)
            ->nodes()
            ->create([
                'order' => $request->order,
                'title' => $request->title
            ]);

        return response()->json(compact('node'));
    }

    public function show($id, Request $request)
    {
        $workflow = Workflow::findOrFail($id);

        if ($request->ajax()) {
            return response()->json(compact('workflow'));
        }

        return view('workflows.show')->withWorkflow($workflow);
    }

    public function showOfNodes($workflowId, $id)
    {
        $node = WorkflowNode::whereWorkflowId($workflowId)
            ->whereId($id)
            ->firstOrFail();

        return response()->json(compact('node'));
    }

    public function edit($id)
    {
        $workflow = Workflow::findOrFail($id);

        return view('workflows.edit')->withWorkflow($workflow);
    }

    public function update($id, Request $request)
    {
        $workflow = Workflow::findOrFail($id);

        $workflow->update(array_only($request->all(), 'name'));

        return redirect()->route('workflows.index');
    }



    public function updateOfNodes($workflowId, $id, Request $request)
    {
        $node = WorkflowNode::whereWorkflowId($workflowId)
            ->whereId($id)
            ->firstOrFail();

        $node->update([
            'order' => $request->order,
            'title' => $request->title
        ]);

        return response()->json(compact('node'));
    }

    public function destroy($id, Request $request)
    {
        $workflow = Workflow::findOrFail($id);

        WorkflowNode::destroy($workflow->nodes()->lists('id')->all());

        $workflow->delete();

        if ($request->ajax()) {
            return response()->json();
        }

        return redirect()->back();
    }

    public function destroyOfNodes($workflowId, $id)
    {
        $node = WorkflowNode::whereWorkflowId($workflowId)
            ->whereId($id)
            ->firstOrFail();

        $node->delete();

        return response()->json();
    }

    public function checklist($workflowId, Request $request)
    {
        $workflow = app(\App\Entities\Workflow::class)->findOrFail($workflowId);

        // $checklist = app(\App\Entities\Checklist::class)->whereWorkflowId($workflow->id)->get();

        //return view('workflows.checklists')->withWorkflow($workflow)->withChecklist($checklist);

        if (!$workflow->checklist) {
            $checklist = Checklist::create([
                'workflow_id' => $workflow->id,
                'name' => $workflow->name
            ] );
        } else {
            $checklist = $workflow->checklist;
        }

        return view('workflows.checklists', compact('workflow', 'checklist'));

        //if (!$workflow->checklist) {
        //    return redirect()->route('checklists.create', ['workflow_id' => $workflow->id]);
        //}

        //return redirect()->route('checklists.show', $workflow->checklist->id);
    }

    public function works($id)
    {
        $workflow = app(\App\Entities\Workflow::class)->findOrFail($id);

        $works = app(\App\Entities\Work::class)->whereWorkflowId($workflow->id)->get();

        return view('workflows.works')->withWorkflow($workflow)->withWorks($works);
    }
}
