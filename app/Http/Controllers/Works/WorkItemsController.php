<?php

namespace App\Http\Controllers\Works;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Entities\WorkItem;

class WorkItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($workId)
    {
        $items = WorkItem::whereWorkId($workId)->get();

        return response()->json([
            'work_items' => $items
        ]);
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
    public function store($workId, Request $request)
    {
        $this->validate($request, [
            'unit_id' => 'required',
            'cost_type_id' => 'required',
            'name' => 'required',
            'order' => 'required',
            'amount' => 'required',
            'unit_price' => 'required'
        ]);

        $work = app(\App\Entities\Work::class)->findOrFail($workId);

        $workItem = WorkItem::create(array_merge($request->all(), [
            'work_id' => $workId
        ]));

        $work->increment('unit_price', $workItem->total_price);

        return response()->json([
            'work_item' => $workItem
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy($workId, $itemId)
    {
        $workItem = WorkItem::findOrFail($itemId);

        $workItem->delete();

        $work = app(\App\Entities\Work::class)->findOrFail($workId);

        $work->decrement('unit_price', $workItem->total_price);

        return response()->json();
    }
}
