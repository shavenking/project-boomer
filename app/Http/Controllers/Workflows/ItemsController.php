<?php

namespace App\Http\Controllers\Workflows;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Entities\Workflow;
use App\Entities\WorkflowNode;

class ItemsController extends Controller
{
    public function index($workflowId)
    {
        $workflow = Workflow::with('nodes')->findOrFail($workflowId);

        $nodes = $workflow->nodes;

        return response()->json(compact('workflow', 'nodes'));
    }

    public function store($workflowId, Request $request)
    {
        $workflow = Workflow::findOrFail($workflowId)
            ->nodes()
            ->create([
                'order' => $request->order,
                'title' => $request->title
            ]);

        return response()->json(compact('workflow'));
    }

    public function show($workflowId, $id)
    {
        $node = WorkflowNode::whereWorkflowId($workflowId)
            ->whereId($id)
            ->firstOrFail();

        return response()->json(compact('node'));
    }

    public function update($workflowId, $id, Request $request)
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

    public function destroy($workflowId, $id)
    {
        $node = WorkflowNode::whereWorkflowId($workflowId)
            ->whereId($id)
            ->firstOrFail();

        $node->delete();

        return response()->json();
    }
}
