<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $fillable = [
        'detailingflow_type_id',
        'unit_id',
        'workflow_id',
        'name',
        'amount',
        'unit_price'
    ];

    protected $appends = [
        'unit_name',
        'total_price'
    ];

    protected $casts = [
        'amount' => 'integer',
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

    public function items()
    {
        return $this->hasMany(WorkItem::class, 'work_id', 'id');
    }
}
