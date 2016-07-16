<?php

namespace App\Repos\Contracts;

use Illuminate\Support\Collection;

interface User
{
    public function all(): Collection;
}
