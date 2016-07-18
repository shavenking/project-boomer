<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ConstructionDaily extends Model
{
    public function works()
    {
        return $this->belongsToMany(ProjectWork::class);
    }
}
