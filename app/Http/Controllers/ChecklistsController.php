<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Entities\Checklist;
use App\Entities\Checkitem;
use App\Entities\Workflow;

class ChecklistsController extends Controller
{
    public function index()
    {
        $checklists = Checklist::all();

        return view('checklists.index')->withChecklists($checklists);
    }

    public function create()
    {
        $workflows = Workflow::all();

        return view('checklists.create', compact('workflows'));
    }

    public function store(Request $request)
    {
        $checklist = Checklist::create(array_only($request->all(), ['workflow_id', 'name']));

        return redirect()->route('checklists.show', $checklist->id);
    }

    public function storeCheckitem($checklistId, Request $request)
    {
        $checklist = Checklist::findOrFail($checklistId);

        if ($request->ajax()) {
            $checkitem = $checklist->checkitems()->create([
                'name' => $request->title,
                'detail' => $request->detail
            ]);

            return response()->json(compact('checkitem'));
        } else {
            $checklist->checkitems()->create(
                array_only($request->all(), ['name', 'detail'])
            );

            return redirect()->route('checklists.show', $checklistId);
        }
    }

    public function show($id, Request $request)
    {
        $checklist = Checklist::findOrFail($id);

        $checkitems = $checklist->checkitems;

        if ($request->ajax()) {
            return response()->json(compact('checklist', 'checkitems'));
        }

        return view('checklists.show')->withChecklist($checklist);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $checklist = app(\App\Entities\Checklist::class)->findOrFail($id);

        $checklist->checkitems()->delete();
        $checklist->delete();

        return redirect()->route('checklists.index');
    }

    public function destroyItem($checklistId, $itemId)
    {
        $checkitem = Checklist::findOrFail($checklistId)->checkitems()->findOrFail($itemId);

        $checkitem->delete();

        return response()->json();
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
}
