<?php

namespace App\Repos\Contracts;

use App\User;
use App\Entities\{
    Project as ProjectEntity,
    Role as RoleEntity
};
use Illuminate\Support\Collection;
use ArrayAccess;
use App\Repos\Contracts\Access;

interface Project
{
    public function __construct(Access $access);

    public function userProjects(User $user): Collection;

    public function getMembers(ProjectEntity $project): Collection;

    public function getMember(ArrayAccess $candidate, ProjectEntity $project): User;

    public function create(User $user, ArrayAccess $data): ProjectEntity;

    public function addMemberByEmail(string $email, $roleName, ProjectEntity $project);

    public function addMember(User $user, RoleEntity $role, ProjectEntity $project);

    public function removeMember(User $user, ProjectEntity $project);

    public function findOrFail(int $id): ProjectEntity;

    public function destroy(int $id);

    public function isUserProjectManager(User $user, ProjectEntity $project): bool;

    public function isUserInProject(User $user, ProjectEntity $project): bool;

    public function isRole(User $user, ProjectEntity $project, string $roleName): bool;
}
