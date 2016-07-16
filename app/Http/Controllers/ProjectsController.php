<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\Project\StoreRequest;
use App\Http\Controllers\Controller;

use App\Repos\Contracts\{
    Project as ProjectRepo
};

class ProjectsController extends Controller
{
    public function index(Request $request, ProjectRepo $repo)
    {
        $projects = $repo->all();

        return view('projects.index')->withProjects($projects);
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(StoreRequest $request, ProjectRepo $repo)
    {
        $user = $request->user();

        $project = $repo->create($user, $request);

        return redirect()->route('projects.show', $project->id);
    }

    public function show($id, ProjectRepo $repo)
    {
        $project = $repo->findOrFail($id);

        return view('projects.show')->withProject($project);
    }

    public function destroy($id, ProjectRepo $repo)
    {
        $repo->destroy($id);

        return redirect()->route('projects.index');
    }

    public function internal($id, ProjectRepo $repo)
    {
        $project = $repo->findOrFail($id);

        return view('projects.internal')->withProject($project);
    }

    public function external($id, ProjectRepo $repo)
    {
        $project = $repo->findOrFail($id);

        return view('projects.external')->withProject($project);
    }

    public function finance($id, ProjectRepo $repo)
    {
        $project = $repo->findOrFail($id);

        return view('projects.finance')->withProject($project);
    }
}
