<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Entities\{ Project, DailyMaterial };

class DailyMaterialsController extends Controller
{
    public function all()
    {
        $dailyMaterials = DailyMaterial::all();

        return response()->json([
            'daily_materials' => $dailyMaterials
        ]);
    }

    public function index($projectId, Request $request)
    {
        $project = Project::findOrFail($projectId);

        $query = $project->dailyMaterials();

        if ($request->has('date')) {
            $query->whereDate($project->dailyMaterials()->getTable().'.created_at', '=', new Carbon($request->date));
        }

        $dailyMaterials = $query->get()->map($this->getJsonTransformer());

        return response()->json([
            'daily_materials' => $dailyMaterials
        ]);
    }

    public function create()
    {
    }

    public function store($projectId, Request $request)
    {
        $project = Project::findOrFail($projectId);

        $this->validate($request, [
            'name' => 'required_without:daily_material_id',
            'daily_material_id' => 'required_without:name',
            'amount' => 'required'
        ]);

        if ($request->has('daily_material_id')) {
            $dailyMaterial = DailyMaterial::findOrFail($request->input('daily_material_id'));

            $project->dailyMaterials()->attach(
                $dailyMaterial->id,
                ['amount' => $request->amount]
            );
        } else {
            $project->dailyMaterials()->create(
                ['name' => $request->name],
                ['amount' => $request->amount]
            );
        }

        return response()->json();
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }

    protected function getJsonTransformer()
    {
        return function (DailyMaterial $model) {
            return [
                'id' => $model->pivot->id,
                'material_id' => $model->id,
                'project_id' => $model->pivot->project_id,
                'name' => $model->name,
                'amount' => $model->pivot->amount,
                'created_at' => (string) $model->pivot->created_at,
                'updated_at' => (string) $model->pivot->updated_at
            ];
        };
    }
}
