<?php

namespace App\Entities;

use App\Entities\AbstractEntity;

class FaultImprovement extends AbstractEntity
{
    protected $fillable = ['project_checkitem_id', 'before_photo', 'current_photo', 'after_photo', 'passes', 'before_notes', 'current_notes', 'after_notes'];

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

    public function checkitem()
    {
        return $this->belongsTo(ProjectCheckitem::class, 'project_checkitem_id');
    }
}
