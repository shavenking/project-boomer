<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name'];

    public function works()
    {
        return $this->belongsToMany(Work::class, 'project_work')
            ->withPivot('name', 'amount', 'unit_price')
            ->withTimestamps();
    }
}
