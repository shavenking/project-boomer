<?php

namespace App\Repos;

use App\User;
use App\Entities\Project as ProjectEntity;
use App\Repos\Contracts\Project as ProjectContract;
use Illuminate\Support\Collection;
use ArrayAccess;
use App\Repos\Contracts\Access;

class Project implements ProjectContract
{
    private $access;

    public function __construct(Access $access)
    {
        $this->access = $access;
    }

    public function userProjects(User $user): Collection
    {
        return $user->projects;
    }

    public function isUserProjectManager(User $user, ProjectEntity $project): bool
    {
        $role = $this->access->getProjectManager();

        $project = $user->projects()->wherePivot('role_id', $role->id)->find($project->id);

        return !is_null($project);
    }

    public function isUserInProject(User $user, ProjectEntity $project): bool
    {
        return !is_null($user->projects()->whereProjectId($project->id)->first());
    }

    public function create(User $user, ArrayAccess $data): ProjectEntity
    {
        $role = $this->access->getProjectManager();

        $project = $user->projects()->create([
            'name' => $data['name']
        ], ['role_id' => $role->id]);

        return $project;
    }

    public function findOrFail(int $id): ProjectEntity
    {
        return ProjectEntity::findOrFail($id);
    }

    public function destroy(int $id)
    {
        return ProjectEntity::destroy($id);
    }
}
