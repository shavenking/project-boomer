<?php

namespace App\Entities;

use App\Entities\AbstractEntity;

class ProjectCheckitem extends AbstractEntity
{
    protected $fillable = ['project_checklist_id', 'name', 'detail', 'passes'];

    protected $casts = [
        'passes' => 'boolean'
    ];

    public function setPassesAttribute($passes)
    {
        if ($passes === 'null') {
            return $this->attributes['passes'] = null;
        }

        $this->attributes['passes'] = (boolean) $passes;
    }

    public function faultImprovement()
    {
        return $this->hasOne(FaultImprovement::class);
    }

    public function checklist()
    {
        return $this->belongsTo(ProjectChecklist::class, 'project_checklist_id');
    }
}
