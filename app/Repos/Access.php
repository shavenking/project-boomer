<?php

namespace App\Repos;

use App\Entities\Role;
use App\Repos\Contracts\Access as AccessContract;

class Access implements AccessContract
{
    public function getProjectManager(): Role
    {
        return Role::whereName('project_manager')->firstOrFail();
    }

    public function getRoleByName(string $roleName): Role
    {
        return Role::whereName($roleName)->firstOrFail();
    }

    public function getRoles()
    {
        return Role::all();
    }
}
