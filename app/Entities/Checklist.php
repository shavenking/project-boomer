<?php

namespace App\Entities;

use App\Entities\AbstractEntity;

class Checklist extends AbstractEntity
{
    protected $fillable = ['workflow_id', 'name'];

    public function checkitems()
    {
        return $this->hasMany(Checkitem::class);
    }

    public function workflow()
    {
        return $this->belongsTo(Workflow::class);
    }
}
