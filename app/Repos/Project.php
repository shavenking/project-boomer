<?php

namespace App\Repos;

use App\User;
use App\Entities\{
    Project as ProjectEntity,
    Role as RoleEntity
};
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

    public function usersNotInProject(ProjectEntity $project): Collection
    {
        $memberIds = $project->users->pluck('id');

        return User::whereNotIn('id', $memberIds)->get();
    }

    public function all(): Collection
    {
        return ProjectEntity::all();
    }

    public function getMembers(ProjectEntity $project): Collection
    {
        $members = $project->users;

        $members = $members->map(function ($member) use ($project) {
            $role = $member->roles($project->id)->first();

            return $member->setRelation('role', $role);
        });

        return $members;
    }

    public function getMember(ArrayAccess $candidate, ProjectEntity $project): User
    {
        $query = $project->users();

        if (isset($candidate['email'])) {
            $query->where('users.email', $candidate['email']);
        }

        if (isset($candidate['id'])) {
            $query->where('users.id', $candidate['id']);
        }

        return $query->firstOrFail();
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

    public function isRole(User $user, ProjectEntity $project, string $roleName): bool
    {
        $roleNames = explode('|', $roleName);

        foreach ($roleNames as $roleName) {
            $role = $this->access->getRoleByName($roleName);

            if (!is_null($user->projects()->wherePivot('role_id', $role->id)->find($project->id))) {
                return true;
            }
        }

        return false;
    }

    public function create(User $user, ArrayAccess $data): ProjectEntity
    {
        $role = $this->access->getProjectManager();

        $project = $user->projects()->create([
            'name' => $data['name']
        ], ['role_id' => $role->id]);

        return $project;
    }

    public function addMemberByEmail(string $email, $roleName, ProjectEntity $project)
    {
        $user = User::whereEmail($email)->firstOrFail();
        $role = $this->access->getRoleByName($roleName);

        return $this->addMember($user, $role, $project);
    }

    public function addMember(User $user, RoleEntity $role, ProjectEntity $project)
    {
        if (!$project->users()->whereEmail($user->email)->first()) {
            return $project->users()->attach($user->id, ['role_id' => $role->id]);
        }

        return null;
    }

    public function removeMember(User $user, ProjectEntity $project)
    {
        if ($project->users()->where('users.id', $user->id)->firstOrFail()) {
            return $project->users()->detach($user->id);
        }

        return null;
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
