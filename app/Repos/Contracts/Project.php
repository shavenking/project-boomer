<?php

namespace App\Repos\Contracts;

use App\User;
use App\Entities\Project as ProjectEntity;
use Illuminate\Support\Collection;
use ArrayAccess;
use App\Repos\Contracts\Access;

interface Project
{
    public function __construct(Access $access);

    public function userProjects(User $user): Collection;

    public function create(User $user, ArrayAccess $data): ProjectEntity;

    public function findOrFail(int $id): ProjectEntity;

    public function destroy(int $id);

    public function isUserProjectManager(User $user, ProjectEntity $project): bool;

    public function isUserInProject(User $user, ProjectEntity $project): bool;
}
