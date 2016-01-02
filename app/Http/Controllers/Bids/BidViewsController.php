<?php

namespace App\Http\Controllers\Bids;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BidViewsController extends Controller
{
    public function index($projectId)
    {
        $project = \App\Entities\Project::findOrFail($projectId);

        return view('bids.index')->withProject($project);
    }

    public function works($projectId, Request $request)
    {
        $mainflowTypeId = $request->query('mainflow_type_id');
        $detailingflowTypeId = $request->query('detailingflow_type_id');

        $project = \App\Entities\Project::findOrFail($projectId);

        $query = \App\Entities\ProjectWork::query();

        if (!empty($mainflowTypeId)) {
            $query->whereHas('detailingflowType', function ($query) use ($mainflowTypeId) {
                $query->whereMainflowTypeId($mainflowTypeId);
            });

            $mainflowTypeName = \App\Entities\MainflowType::findOrFail($mainflowTypeId)->name;
        }

        if (!empty($detailingflowTypeId)) {
            $query->whereDetailingflowTypeId($detailingflowTypeId);

            $detailingflowTypeName = \App\Entities\DetailingflowType::findOrFail($detailingflowTypeId)->name;
        }

        $works = $query->get();

        return view('bids.works', compact('project', 'works', 'mainflowTypeName', 'detailingflowTypeName'));
    }
}
