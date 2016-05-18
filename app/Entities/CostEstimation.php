<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class CostEstimation extends Model
{
    protected $dates = ['settled_at'];

    protected $fillable = ['settled_at'];
    
    public function bounces()
    {
        return $this->belongsToMany(CostEstimationBounce::class, 'cost_estimation_cost_estimation_bounce', 'cost_estimation_id', 'cost_estimation_bounce_id')
            ->withPivot('id', 'amount', 'unit_price')
            ->withTimestamps();
    }
}
