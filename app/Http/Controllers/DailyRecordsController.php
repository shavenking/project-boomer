<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Entities\{ Project, DailyRecord };

class DailyRecordsController extends Controller
{
    public function index($projectId, Request $request)
    {
        $project = Project::findOrFail($projectId);

        $query = $project->dailyRecords();

        if ($request->has('date')) {
            $query->whereDate((new DailyRecord)->getTable().'.created_at', '=', new Carbon($request->date));
        }

        $dailyRecords = $query->first();

        return response()->json([
            'daily_records' => $dailyRecords
        ]);
    }

    public function create()
    {
        //
    }

    public function store($projectId, Request $request)
    {
        $project = Project::findOrFail($projectId);

        $dailyRecord = $project->dailyRecords()->whereDate((new DailyRecord)->getTable().'.created_at', '=', new Carbon('today'))->first();

        if ($dailyRecord) {
            $dailyRecord->update([
                'check_record' => $request->input('check_record'),
                'important_record' => $request->input('important_record')
            ]);
        } else {
            $project->dailyRecords()->create([
                'check_record' => $request->input('check_record'),
                'important_record' => $request->input('important_record')
            ]);
        }

        return response()->json();
    }

    public function show($id)
    {
        //
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
        //
    }
}
