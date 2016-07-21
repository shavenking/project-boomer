<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Entities\{
    DailyLabor,
    Project
};
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repos\Contracts\{
    ConstructionDaily as ConstructionDailyRepo
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
        ConstructionDailyRepo $repo
    ) {
        $project = Project::findOrFail($projectId);
        $date = new Carbon($date);

        $constructionDaily = $repo->getConstructionDaily($project, $date);
        $dailyLabors = $constructionDaily->labors;

        return response()->json(compact('dailyLabors'));
    }

    public function addLabor(
        $projectId,
        $date,
        ConstructionDailyRepo $repo,
        Request $request
    ) {
        $this->validate($request, [
            'daily_labor_id' => 'required',
            'amount' => 'required'
        ]);

        $project = Project::findOrFail($projectId);
        $date = new Carbon($date);
        $labor = DailyLabor::findOrFail($request->input('daily_labor_id'));
        $amount = (int) $request->input('amount');

        $constructionDaily = $repo->getConstructionDaily($project, $date);
        $repo->addLabor($constructionDaily, $labor, $amount);

        return response()->json();
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
