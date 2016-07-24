<?php

namespace App\Http\Controllers;

use App\Repos\ConstructionDaily;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use App\Entities\{
    Appliance, Labor, Material, Project, ProjectWork, Subcontractor, Transformers\DailyThingTransformer, Transformers\DailyWorkTransformer
};
use App\Repos\Contracts\{
    ConstructionDaily as ConstructionDailyRepo,
    DailyLabor as DailyLaborRepo
};
use Carbon\Carbon;
use DatePeriod;

class ConstructionDailiesController extends Controller
{
    public function index($projectId)
    {
        $project = Project::findOrFail($projectId);
        $constructionDailies = $project->constructionDailies;

        return view('project-constructiondailies.index', compact('project', 'constructionDailies'));
    }

    public function show($projectId, $date)
    {
        $project = Project::findOrFail($projectId);

        return view('project-constructiondailies.show', compact('project', 'date'));
    }

    public function store(
        $projectId,
        Request $request,
        ConstructionDailyRepo $repo
    ) {
        $this->validate($request, ['date' => 'required']);
        $project = Project::findOrFail($projectId);
        $date = new Carbon($request->input('date'));

        try {
            $repo->getConstructionDaily($project, $date);
        } catch (ModelNotFoundException $e) {
            // Create if not found
            $repo->create(collect(['work_date' => $date]), $project);
        }

        return redirect(route('projects.construction-dailies.show', [
            $project->id,
            $date->toDateString()
        ]));
    }

    public function update(
        $projectId,
        $date,
        ConstructionDailyRepo $repo,
        Request $request
    ) {
        $constructionDaily = $repo->getConstructionDaily(
            Project::findOrFail($projectId),
            new Carbon($date)
        );

        $constructionDaily->update($request->all());

        return response()->json();
    }

    public function getLabors(
        $projectId,
        $date,
        ConstructionDailyRepo $repo
    ) {
        $project = Project::findOrFail($projectId);
        $date = new Carbon($date);

        $constructionDaily = $repo->getConstructionDaily($project, $date);

        $result = call_user_func(
            app('fractalTransform'),
            $constructionDaily->labors,
            new DailyThingTransformer(
                $constructionDaily
            ),
            'daily_labor'
        );

        return response()->json($result);
    }

    public function getMaterials(
        $projectId,
        $date,
        ConstructionDailyRepo $repo
    ) {
        $project = Project::findOrFail($projectId);
        $date = new Carbon($date);

        $constructionDaily = $repo->getConstructionDaily($project, $date);

        $result = call_user_func(
            app('fractalTransform'),
            $constructionDaily->materials,
            new DailyThingTransformer(
                $constructionDaily
            ),
            'daily_material'
        );

        return response()->json($result);
    }

    public function getAppliances(
        $projectId,
        $date,
        ConstructionDailyRepo $repo
    ) {
        $project = Project::findOrFail($projectId);
        $date = new Carbon($date);

        $constructionDaily = $repo->getConstructionDaily($project, $date);

        $result = call_user_func(
            app('fractalTransform'),
            $constructionDaily->appliances,
            new DailyThingTransformer(
                $constructionDaily
            ),
            'daily_appliance'
        );

        return response()->json($result);
    }

    public function addLabor(
        $projectId,
        $date,
        ConstructionDailyRepo $repo,
        Request $request,
        DailyLaborRepo $dailyLaborRepo
    ) {
        $this->validate($request, [
            'daily_labor_id' => 'required',
            'amount' => 'required'
        ]);

        $project = Project::findOrFail($projectId);
        $date = new Carbon($date);
        $labor = Labor::findOrFail($request->input('daily_labor_id'));
        $amount = (int) $request->input('amount');

        $constructionDaily = $repo->getConstructionDaily($project, $date);
        $repo->addLabor($constructionDaily, $labor, $amount);
        $dailyLabor = $dailyLaborRepo->firstOrFail($constructionDaily, $labor);

        $result = call_user_func(
            app('fractalTransform'),
            $dailyLabor,
            new DailyThingTransformer(
                $constructionDaily
            ),
            'daily_labor'
        );

        return response()->json($result);
    }

    public function addMaterial(
        $projectId,
        $date,
        ConstructionDailyRepo $repo,
        Request $request
    ) {
        $this->validate($request, [
            'material_id' => 'required',
            'amount' => 'required'
        ]);

        $project = Project::findOrFail($projectId);
        $date = new Carbon($date);
        $material = Material::findOrFail($request->input('material_id'));
        $amount = (int) $request->input('amount');

        $constructionDaily = $repo->getConstructionDaily($project, $date);
        $repo->addMaterial($constructionDaily, $material, $amount);
        $dailyMaterial = (
            $repo
                ->dailyMaterials($constructionDaily, $material)
                ->firstOrFail()
        );

        $result = call_user_func(
            app('fractalTransform'),
            $dailyMaterial,
            new DailyThingTransformer(
                $constructionDaily
            ),
            'daily_material'
        );

        return response()->json($result);
    }

    public function addAppliance(
        $projectId,
        $date,
        ConstructionDailyRepo $repo,
        Request $request
    ) {
        $this->validate($request, [
            'appliance_id' => 'required',
            'amount' => 'required'
        ]);

        $project = Project::findOrFail($projectId);
        $date = new Carbon($date);
        $appliance = Appliance::findOrFail($request->input('appliance_id'));
        $amount = (int) $request->input('amount');

        $constructionDaily = $repo->getConstructionDaily($project, $date);
        $repo->addAppliance($constructionDaily, $appliance, $amount);
        $dailyAppliance = (
            $repo
                ->dailyAppliances($constructionDaily, $appliance)
                ->firstOrFail()
        );

        $result = call_user_func(
            app('fractalTransform'),
            $dailyAppliance,
            new DailyThingTransformer(
                $constructionDaily
            ),
            'daily_appliance'
        );

        return response()->json($result);
    }

    public function addWork(
        $projectId,
        $date,
        ConstructionDailyRepo $repo,
        Request $request
    ) {
        $this->validate($request, [
            'project_work_id' => 'required',
            'seat' => 'required',
            'subcontractor_id' => 'required'
        ]);

        $constructionDaily = $repo->getConstructionDaily(
            Project::findOrFail($projectId),
            new Carbon($date)
        );

        // Create DailyWork and its checklist
        $repo->addDailyWork(
            $request->input('seat'),
            Subcontractor::findOrFail($request->input('subcontractor_id')),
            ProjectWork::findOrFail($request->input('project_work_id')),
            $constructionDaily
        );

        return response()->json();
    }

    public function getWorks(
        $projectId,
        $date,
        ConstructionDailyRepo $repo
    ) {
        $constructionDaily = $repo->getConstructionDaily(
            Project::findOrFail($projectId),
            new Carbon($date)
        );

        $result = call_user_func(
            app('fractalTransform'),
            $constructionDaily->works,
            new DailyWorkTransformer(
                $constructionDaily
            ),
            'daily_work'
        );

        return response()->json($result);
    }

    private function datePeriodToCollection(DatePeriod $datePeriod)
    {
        $collection = collect();

        foreach ($datePeriod as $date) {
            $collection->push($date->format('Y-m-d'));
        }

        return $collection;
    }
}
