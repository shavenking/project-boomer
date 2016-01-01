<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ProjectChecklist extends Model
{
    protected $table = 'project_checklist';

    protected $fillable = ['project_id', 'checklist_id', 'name'];

    public function getWorkflowAttribute()
    {
        return $this->originalChecklist->workflow;
    }

    public function originalChecklist()
    {
        return $this->belongsTo(Checklist::class, 'checklist_id', 'id');
    }

    public function originalCheckitems()
    {
        return $this->hasMany(Checkitem::class, 'checklist_id', 'checklist_id');
    }

    public function checkitems()
    {
        return $this->hasMany(ProjectCheckitem::class, 'project_checklist_id', 'id');
    }
}
