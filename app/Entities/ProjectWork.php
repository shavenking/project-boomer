<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ProjectWork extends Model
{
    protected $table = 'project_work';

    protected $fillable = [
        'project_id',
        'work_id',
        'name',
        'amount',
        'unit_price'
    ];

    protected $appends = [
        'unit_name',
        'total_price',
        'mainflow_type',
        'detailingflow_type'
    ];

    protected $casts = [
        'amount' => 'integer',
        'unit_price' => 'integer'
    ];

    public function getUnitAttribute()
    {
        return $this->originalWork->unit;
    }

    public function getUnitNameAttribute()
    {
        return $this->originalWork->unit->name;
    }

    public function getMainflowTypeAttribute()
    {
        return $this->originalWork->detailingflowType->mainflowType;
    }

    public function getDetailingflowTypeAttribute()
    {
        return $this->originalWork->detailingflowType;
    }

    public function getTotalPriceAttribute()
    {
        return $this->amount * $this->unit_price;
    }

    public function originalWork()
    {
        return $this->hasOne(Work::class, 'id', 'work_id');
    }
}
