<?php

namespace App\Repos\Contracts;

use App\Entities\Role;

interface Access
{
    public function getProjectManager(): Role;

    public function getRoleByName(string $roleName): Role;
}
