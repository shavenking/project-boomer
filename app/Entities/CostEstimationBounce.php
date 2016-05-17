<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class CostEstimationBounce extends Model
{
    protected $fillable = ['name', 'unit_id'];
    
    public function unit()
    {
        return $this->hasOne(Unit::class, 'id', 'unit_id');
    }
}
