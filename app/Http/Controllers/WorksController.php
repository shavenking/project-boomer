<?php

namespace App\Http\Controllers;

use App\Entities\DetailingflowType;
use Illuminate\Http\Request;

use App\Http\Requests\StandardWork\{
    StoreRequest as StoreWorkRequest,
    EditRequest as EditWorkRequest,
    UpdateRequest as UpdateWorkRequest,
    DestroyRequest as DestroyWorkRequest
};

use App\Http\Requests\StandardWorkitem\{
    UpdateRequest as UpdateWorkitemRequest,
    StoreRequest as StoreWorkitemRequest,
    DestroyRequest as DestroyWorkitemRequest
};

use App\Http\Controllers\Controller;

use App\Entities\Work;
use App\Entities\WorkItem;

class WorksController extends Controller
{
    public function index(Request $request)
    {
        $detailingflowTypeId = $request->query('detailingflow_type_id');
        $mainflowTypeId = $request->query('mainflow_type_id');

        $query = Work::query();


        if ($mainflowTypeId) {
            $query->whereHas('detailingflowType', function ($query) use ($mainflowTypeId) {
                $query->where('mainflow_type_id', $mainflowTypeId);
            });
        }

        if ($detailingflowTypeId) {
            $query->where('detailingflow_type_id', $detailingflowTypeId);
        }

        $works = $query->get();

        if ($request->ajax()) {
            return response()->json(compact('works'));
        }

        return view('works.index')->withWorks($works);
    }

    public function indexOfWorkitems($workId)
    {
        $items = WorkItem::whereWorkId($workId)->get();

        return response()->json([
            'work_items' => $items
        ]);
    }

    public function create()
    {
        return view('works.create');
    }

    public function store(Request $request)
    {
        $user = $request->user();

        // since detailingflow_type_id is going to be removed
        // temporarily use the first detailingflow_type_id of
        // specified mainflow_type
        $detailingflowType = DetailingflowType::where('mainflow_type_id', $request->input('mainflow_type_id'))->firstOrFail();

        $work = $user->works()->create(
            array_merge($request->all(), ['unit_price' => 0, 'detailingflow_type_id' => $detailingflowType->id])
        );

        return redirect(route('works.show', $work->id));
    }

    public function storeOfWorkitems($workId, StoreWorkitemRequest $request)
    {
        $work = app(\App\Entities\Work::class)->findOrFail($workId);

        $workItem = WorkItem::create(array_merge($request->all(), [
            'work_id' => $workId
        ]));

        $work->increment('unit_price', $workItem->total_price);

        return response()->json([
            'work_item' => $workItem
        ]);
    }

    public function show($id, Request $request)
    {
        $work = Work::findOrFail($id);

        if ($request->ajax()) {
            return response()->json(compact('work'));
        }

        return view('works.show')->withWork($work);
    }

    public function edit($workId, EditWorkRequest $request)
    {
        $work = Work::findOrFail($workId);

        return view('works.edit')->withWork($work);
    }

    public function update($workId, Request $request)
    {
        $work = Work::findOrFail($workId);

        // since detailingflow_type_id is going to be removed
        // temporarily use the first detailingflow_type_id of
        // specified mainflow_type
        if ($request->has('mainflow_type_id')) {
            $detailingflowType = DetailingflowType::where('mainflow_type_id', $request->input('mainflow_type_id'))->firstOrFail();

            $work->detailingflow_type_id = $detailingflowType->id;
        }

        $work->update($request->all());

        return redirect(route('works.show', $work->id));
    }

    public function updateOfWorkitems($workId, $itemId, UpdateWorkitemRequest $request)
    {
        $work = Work::findOrFail($workId);
        $workItem = WorkItem::findOrFail($itemId);

        $workItem->update($request->all());
        $work->reCalculateUnitPrice();

        return response()->json([
            'work_item' => $workItem
        ]);
    }

    public function destroy($id, DestroyWorkRequest $request)
    {
        $work = app(\App\Entities\Work::class)->findOrFail($id);

        $work->items()->delete();
        $work->delete();

        return redirect()->route('works.index');
    }

    public function destroyOfWorkitems($workId, $itemId, DestroyWorkitemRequest $request)
    {
        $workItem = WorkItem::findOrFail($itemId);

        $workItem->delete();

        $work = app(\App\Entities\Work::class)->findOrFail($workId);

        if ($work->unit_price < $workItem->total_price) {
            $work->update(['unit_price' => 0]);
        } else {
            $work->decrement('unit_price', $workItem->total_price);
        }

        return response()->json();
    }

    public function checklist($workId)
    {
        $work = Work::findOrFail($workId);

        return redirect()->route('checklists.show', $work->workflow->checklist->id);
    }

    public function workItems($workId)
    {
        $work = Work::findOrFail($workId);

        return view('works.work-items')->withWork($work);
    }

    public function workflow($workId)
    {
        $work = Work::findOrFail($workId);

        return view('works.workflow')->withWork($work);
    }
}
