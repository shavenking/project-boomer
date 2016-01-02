<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ProjectWorkitem extends Model
{
    protected $fillable = [
        'project_work_id',
        'unit_id',
        'cost_type_id',
        'name',
        'order',
        'amount',
        'unit_price'
    ];

    protected $casts = [
        'amount' => 'integer',
        'unit_price' => 'integer'
    ];

    public function unit()
    {
        return $this->hasOne(Unit::class, 'id', 'unit_id');
    }

    public function costType()
    {
        return $this->hasOne(CostType::class, 'id', 'cost_type_id');
    }

    public function getTotalPriceAttribute()
    {
        return $this->amount * $this->unit_price;
    }
}
