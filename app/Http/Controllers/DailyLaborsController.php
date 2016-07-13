<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Entities\{ Project, DailyLabor };

class DailyLaborsController extends Controller
{
    public function all()
    {
        $dailyLabors = DailyLabor::all();

        return response()->json([
            'daily_labors' => $dailyLabors
        ]);
    }

    public function index($projectId, Request $request)
    {
        $project = Project::findOrFail($projectId);

        $query = $project->dailyLabors();

        if ($request->has('date')) {
            $query->whereDate($project->dailyLabors()->getTable().'.created_at', '=', new Carbon($request->date));
        }

        $dailyLabors = $query->get()->map($this->getJsonTransformer());

        return response()->json([
            'daily_labors' => $dailyLabors
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
            'name' => 'required_without:daily_labor_id',
            'daily_labor_id' => 'required_without:name',
            'amount' => 'required'
        ]);

        $dailyLabor = DailyLabor::find($request->input('daily_labor_id'));

        if (is_null($dailyLabor)) {
            $dailyLabor = DailyLabor::create(['name' => $request->input('name')]);
        }

        $pivotTable = $project->dailyLabors()->getTable();
        $query = $project->dailyLabors()->getQuery();
        $projectDailyLabor = $query->whereDate("$pivotTable.created_at", '=', Carbon::today())->find($dailyLabor->id);

        if ($projectDailyLabor) {
            $project->dailyLabors()->updateExistingPivot($dailyLabor->id, ['amount' => $request->input('amount')]);
        } else {
            $project->dailyLabors()->attach(
                $dailyLabor->id,
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

        $dailyLaborSets = $project->dailyLabors->groupBy('pivot.daily_labor_id');

        $totalAmountSet = $dailyLaborSets->map(function ($dailyLabors) {
            return $dailyLabors->sum('pivot.amount');
        });

        return response()->json([
            'total_amount' => $totalAmountSet
        ]);
    }

    protected function getJsonTransformer()
    {
        return function (DailyLabor $model) {
            return [
                'id' => $model->pivot->id,
                'labor_id' => $model->id,
                'project_id' => $model->pivot->project_id,
                'name' => $model->name,
                'amount' => $model->pivot->amount,
                'created_at' => (string) $model->pivot->created_at,
                'updated_at' => (string) $model->pivot->updated_at
            ];
        };
    }
}
