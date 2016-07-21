<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Entities\{
    Project
};

class StatisticsController extends Controller
{
    public function dailyLabors($projectId)
    {
        $project = Project::findOrFail($projectId);

        $constructionDailies = (
            $project
                ->constructionDailies()
                ->with('labors')
                ->get()
        );

        $labors = (
            $constructionDailies
                ->pluck('labors')
                ->collapse()
                ->groupBy('id')
                ->map(function ($labors) {
                    return $labors->sum('pivot.amount');
                })
        );

        return response()->json(compact('labors'));
    }
}
