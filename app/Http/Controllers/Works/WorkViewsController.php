<?php

namespace App\Http\Controllers\Works;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Entities\Work;

class WorkViewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $works = Work::all();

        return view('works.index')->withWorks($works);
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('works.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'detailingflow_type_id' => 'required',
            'unit_id' => 'required',
            'workflow_id' => 'required',
            'name' => 'required',
            'amount' => 'required',
            'unit_price' => 'required'
        ]);

        $work = Work::create($request->all());

        return redirect(route('works.show', $work->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $work = Work::findOrFail($id);

        return view('works.show')->withWork($work);
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
