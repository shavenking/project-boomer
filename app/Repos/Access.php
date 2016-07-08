<?php

namespace App\Repos;

use App\Entities\Role;

class Access
{
    public static function getProjectManager(): Role
    {
        return Role::whereName('project_manager')->firstOrFail();
    }
}
