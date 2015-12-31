<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Workflow extends Model
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
