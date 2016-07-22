<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Entities\{
    Labor,
    Project
};
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repos\Contracts\{
    ConstructionDaily as ConstructionDailyRepo,
    DailyLabor as DailyLaborRepo
};
use Carbon\Carbon;
use DatePeriod;
use DateInterval;

class ConstructionDailiesController extends Controller
{
    public function index($projectId)
    {
        $project = \App\Entities\Project::findOrFail($projectId);

        $datePeriod = $this->datePeriodToCollection(
            new DatePeriod(
                (new Carbon('today'))->subDays('5'),
                new DateInterval('P1D'),
                new Carbon('today')
            )
        );

        $datePeriod = $datePeriod->reverse();

        return view('project-constructiondailies.index', compact('project', 'datePeriod'));
    }

    public function show($projectId, $date)
    {
        $project = \App\Entities\Project::findOrFail($projectId);

        return view('project-constructiondailies.show', compact('project', 'date'));
    }

    public function getLabors(
        $projectId,
        $date,
        ConstructionDailyRepo $repo,
        DailyLaborRepo $dailyLaborRepo
    ) {
        $project = Project::findOrFail($projectId);
        $date = new Carbon($date);

        $constructionDaily = $repo->getConstructionDaily($project, $date);

        $result = $dailyLaborRepo->transform(
            $constructionDaily->labors,
            $constructionDaily
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

        $result = $dailyLaborRepo->transform(
            $dailyLabor,
            $constructionDaily
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
