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
                    return [
                        'total_amount' => $labors->sum('pivot.amount'),
                        'name' => $labors[0]->name
                    ];
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
                    return [
                        'total_amount' => $materials->sum('pivot.amount'),
                        'name' => $materials[0]->name
                    ];
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
                ->map(function ($appliances) {
                    return [
                        'total_amount' => $appliances->sum('pivot.amount'),
                        'name' => $appliances[0]->name
                    ];
                })
        );

        return response()->json(compact('appliances'));
    }
}
