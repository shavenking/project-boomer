<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Entities\Project;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        return view('projects.index')->withProjects($projects);
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validator = $this->validate($request, [
            'name' => 'required'
        ]);

        $name = $request->input('name');

        $project = Project::create(compact('name'));

        return redirect()->route('projects.show', $project->id);
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);

        return view('projects.show')->withProject($project);
    }

    public function destroy($id)
    {
        \App\Entities\Project::destroy($id);

        return redirect()->route('projects.index');
    }

    public function internal($id)
    {
        $project = Project::findOrFail($id);

        return view('projects.internal')->withProject($project);
    }

    public function external($id)
    {
        $project = Project::findOrFail($id);

        return view('projects.external')->withProject($project);
    }

    public function finance($id)
    {
        $project = Project::findOrFail($id);

        return view('projects.finance')->withProject($project);
    }
}
