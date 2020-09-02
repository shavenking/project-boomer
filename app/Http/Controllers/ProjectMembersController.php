<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repos\Contracts\Project as ProjectRepo;
use App\Repos\Contracts\Access as AccessRepo;

class ProjectMembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($projectId, ProjectRepo $repo)
    {
        $project = $repo->findOrFail($projectId);
        $members = $repo->getMembers($project);

        return view('project-members.index', compact('project', 'members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($projectId, ProjectRepo $repo, AccessRepo $access)
    {
        $project = $repo->findOrFail($projectId);
        $roles = $access->getRoles();

        return view('project-members.create', compact('project', 'roles'));
    }

    public function fastCreate($projectId, ProjectRepo $repo, AccessRepo $access)
    {
        $project = $repo->findOrFail($projectId);
        $roles = $access->getRoles();
        $users = $repo->usersNotInProject($project);

        return view('project-members.fast-create', compact('project', 'roles', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($projectId, Request $request, ProjectRepo $repo)
    {
        $this->validate($request, [
            'email' => 'required',
            'role_name' => 'required'
        ]);

        $project = $repo->findOrFail($projectId);

        $repo->addMemberByEmail(
            $request->input('email'),
            $request->input('role_name'),
            $project
        );

        return redirect(route('projects.members.index', $project->id));
    }

    public function fastStore($projectId, Request $request, ProjectRepo $repo)
    {
        $this->validate($request, [
            'email' => 'required',
            'role_name' => 'required'
        ]);

        $project = $repo->findOrFail($projectId);

        $repo->addMemberByEmail(
            $request->input('email'),
            $request->input('role_name'),
            $project
        );

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($projectId, $memberId, ProjectRepo $repo)
    {
        $project = $repo->findOrFail($projectId);
        $user = $repo->getMember(collect(['id' => $memberId]), $project);

        $repo->removeMember($user, $project);

        return redirect()->back();
    }
}
