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
        }

        if (!empty($detailingflowTypeId)) {
            $query->whereDetailingflowTypeId($detailingflowTypeId);
        }

        $works = $query->get();

        return view('bids.works')->withProject($project)->withWorks($works);
    }
}
