<?php

namespace App\Entities;

use App\Entities\AbstractEntity;

class ProjectWork extends AbstractEntity
{
    protected $fillable = [
        'project_id',
        'detailingflow_type_id',
        'unit_id',
        'workflow_id',
        'name',
        'amount',
        'unit_price'
    ];

    protected $casts = [
        'amount' => 'integer',
        'unit_price' => 'integer'
    ];

    public function getTotalPriceAttribute()
    {
        return $this->amount * $this->unit_price;
    }

    public function workitems()
    {
        return $this->hasMany(ProjectWorkitem::class);
    }

    public function workflow()
    {
        return $this->hasOne(Workflow::class, 'id', 'workflow_id');
    }

    public function detailingflowType()
    {
        return $this->hasOne(DetailingflowType::class, 'id', 'detailingflow_type_id');
    }

    public function unit()
    {
        return $this->hasOne(Unit::class, 'id', 'unit_id');
    }

    public function checklists()
    {
        return $this->hasMany(ProjectChecklist::class);
    }

    public function reCalculateUnitPrice()
    {
        if (!$this->exists) {
            return false;
        }

        $unitPrice = 0;
        foreach ($this->workitems as $workitem) {
            $unitPrice += $workitem->total_price;
        }
        $this->unit_price = $unitPrice;
        return $this->save();
    }

    public function constructionDailies()
    {
        return $this->belongsToMany(ConstructionDaily::class)->withPivot('id', 'seat')->withTimestamps();
    }
}
