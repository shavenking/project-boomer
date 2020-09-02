<?php

namespace App\Repos;

use App\User as UserEntity;
use App\Repos\Contracts\User as UserContract;
use Illuminate\Support\Collection;

class User implements UserContract
{
    public function all(): Collection
    {
        return UserEntity::all();
    }
}
