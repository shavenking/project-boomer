<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
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

    private function datePeriodToCollection(DatePeriod $datePeriod)
    {
        $collection = collect();

        foreach ($datePeriod as $date) {
            $collection->push($date->format('Y-m-d'));
        }

        return $collection;
    }
}
