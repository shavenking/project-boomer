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

    public function workflow()
    {
        return $this->hasOne(Workflow::class, 'id', 'workflow_id');
    }
}
