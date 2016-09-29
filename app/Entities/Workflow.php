<?php

namespace App\Entities;

use App\Entities\AbstractEntity;

class Workflow extends AbstractEntity
{
    protected $fillable = ['name'];

    public function nodes()
    {
        return $this->hasMany(WorkflowNode::class);
    }

    public function works()
    {
        return $this->hasMany(Work::class);
    }

    public function checklist()
    {
        return $this->hasOne(Checklist::class);
    }
}
