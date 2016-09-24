<?php

namespace App\Entities;

use App\Entities\AbstractEntity;

class CostEstimationBounce extends AbstractEntity
{
    protected $fillable = ['name', 'unit_id'];

    public function unit()
    {
        return $this->hasOne(Unit::class, 'id', 'unit_id');
    }

    public function costEstimations()
    {
        return $this->belongsToMany(CostEstimation::class, 'cost_estimation_cost_estimation_bounce', 'cost_estimation_bounce_id', 'cost_estimation_id')
            ->withPivot('id', 'amount', 'unit_price')
            ->withTimestamps();
    }
}
