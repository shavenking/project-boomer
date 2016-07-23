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

    public function dailyMaterials($projectId)
    {
        $project = Project::findOrFail($projectId);

        $constructionDailies = (
            $project
                ->constructionDailies()
                ->with('materials')
                ->get()
        );

        $materials = (
            $constructionDailies
                ->pluck('materials')
                ->collapse()
                ->groupBy('id')
                ->map(function ($materials) {
                    return $materials->sum('pivot.amount');
                })
        );

        return response()->json(compact('materials'));
    }

    public function dailyAppliances($projectId)
    {
        $project = Project::findOrFail($projectId);

        $constructionDailies = (
            $project
                ->constructionDailies()
                ->with('appliances')
                ->get()
        );

        $appliances = (
            $constructionDailies
                ->pluck('appliances')
                ->collapse()
                ->groupBy('id')
                ->map(function ($materials) {
                    return $materials->sum('pivot.amount');
                })
        );

        return response()->json(compact('appliances'));
    }
}
