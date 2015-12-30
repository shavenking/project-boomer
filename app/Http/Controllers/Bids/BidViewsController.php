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

    public function works($projectId)
    {
        $project = \App\Entities\Project::findOrFail($projectId);

        $works = \App\Entities\ProjectWork::all();

        return view('bids.works')->withProject($project)->withWorks($works);
    }
}
