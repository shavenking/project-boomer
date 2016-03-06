<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ProjectChecklist extends Model
{
    protected $fillable = ['project_id', 'name', 'passes_amount'];

    protected $casts = [
        'passes_amount' => 'integer'
    ];

    public function checkitems()
    {
        return $this->hasMany(ProjectCheckitem::class);
    }
}
