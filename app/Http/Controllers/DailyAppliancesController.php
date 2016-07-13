<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Entities\{ Project, DailyAppliance };

class DailyAppliancesController extends Controller
{
    public function all()
    {
        $dailyAppliances = DailyAppliance::all();

        return response()->json([
            'daily_appliances' => $dailyAppliances
        ]);
    }

    public function index($projectId, Request $request)
    {
        $project = Project::findOrFail($projectId);

        $query = $project->dailyAppliances();

        if ($request->has('date')) {
            $query->whereDate($project->dailyAppliances()->getTable().'.created_at', '=', new Carbon($request->date));
        }

        $dailyAppliances = $query->get()->map($this->getJsonTransformer());

        return response()->json([
            'daily_appliances' => $dailyAppliances
        ]);
    }

    public function create()
    {
        //
    }

    public function store($projectId, Request $request)
    {
        $project = Project::findOrFail($projectId);

        $this->validate($request, [
            'name' => 'required_without:daily_appliance_id',
            'daily_appliance_id' => 'required_without:name',
            'amount' => 'required'
        ]);

        $dailyAppliance = DailyAppliance::find($request->input('daily_appliance_id'));

        if (is_null($dailyAppliance)) {
            $dailyAppliance = DailyAppliance::create(['name' => $request->input('name')]);
        }

        $pivotTable = $project->dailyAppliances()->getTable();
        $query = $project->dailyAppliances()->getQuery();
        $projectDailyAppliance = $query->whereDate("$pivotTable.created_at", '=', Carbon::today())->find($dailyAppliance->id);

        if ($projectDailyAppliance) {
            $project->dailyAppliances()->updateExistingPivot($dailyAppliance->id, ['amount' => $request->input('amount')]);
        } else {
            $project->dailyAppliances()->attach(
                $dailyAppliance->id,
                ['amount' => $request->amount]
            );
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

    public function getTotalAmount($projectId)
    {
        $project = Project::findOrFail($projectId);

        $dailyApplianceSets = $project->dailyAppliances->groupBy('pivot.daily_appliance_id');

        $totalAmountSet = $dailyApplianceSets->map(function ($dailyAppliances) {
            return $dailyAppliances->sum('pivot.amount');
        });

        return response()->json([
            'total_amount' => $totalAmountSet
        ]);
    }

    protected function getJsonTransformer()
    {
        return function (DailyAppliance $model) {
            return [
                'id' => $model->pivot->id,
                'appliance_id' => $model->id,
                'project_id' => $model->pivot->project_id,
                'name' => $model->name,
                'amount' => $model->pivot->amount,
                'created_at' => (string) $model->pivot->created_at,
                'updated_at' => (string) $model->pivot->updated_at
            ];
        };
    }
}
