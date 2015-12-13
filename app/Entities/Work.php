<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $fillable = [
        'detailingflow_type_id',
        'unit_id',
        'name',
        'amount',
        'unit_price'
    ];
}
