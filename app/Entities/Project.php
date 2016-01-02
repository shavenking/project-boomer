<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name'];

    public function works()
    {
        return $this->hasMany(ProjectWork::class);
    }

    public function checklists()
    {
        return $this->hasMany(ProjectChecklist::class);
    }
}
