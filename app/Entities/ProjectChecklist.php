<?php

namespace App\Entities;

use App\Entities\AbstractEntity;

class ProjectChecklist extends AbstractEntity
{
    protected $fillable = [
        'project_id',
        'project_work_id',
        'subcontractor_id',
        'name',
        'passes_amount',
        'seat',
        'finished_at'
    ];

    protected $dates = ['finished_at'];

    protected $casts = [
        'passes_amount' => 'integer'
    ];

    protected $appends = [
        'project_work'
    ];

    public function getProjectWorkAttribute() {
        return $this->projectWork()->first();
    }

    public function checkitems()
    {
        return $this->hasMany(ProjectCheckitem::class);
    }

    public function projectWork()
    {
        return $this->belongsTo(ProjectWork::class);
    }

    public function subcontractor()
    {
        return $this->belongsTo(Subcontractor::class);
    }
}
