<?php

namespace App\Entities;

use App\Entities\AbstractEntity;

class Work extends AbstractEntity
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

    public function reCalculateUnitPrice()
    {
        if (!$this->exists) {
            return false;
        }

        $unitPrice = 0;
        foreach ($this->items as $workitem) {
            $unitPrice += $workitem->total_price;
        }
        $this->unit_price = $unitPrice;
        return $this->save();
    }
}
