<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class WorkItem extends Model
{
    protected $fillable = [
        'work_id',
        'unit_id',
        'cost_type_id',
        'name',
        'order',
        'amount',
        'unit_price'
    ];

    protected $appends = [
        'unit_name',
        'total_price',
        'cost_type_name'
    ];

    protected $casts = [
        'amount' => 'double',
        'unit_price' => 'integer'
    ];

    public function getUnitNameAttribute()
    {
        return $this->unit->name;
    }

    public function getTotalPriceAttribute()
    {
        return $this->amount * $this->unit_price;
    }

    public function getCostTypeNameAttribute()
    {
        return $this->costType->name;
    }

    public function unit()
    {
        return $this->hasOne(Unit::class, 'id', 'unit_id');
    }

    public function costType()
    {
        return $this->hasOne(CostType::class, 'id', 'cost_type_id');
    }
}
