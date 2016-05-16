<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class CostEstimation extends Model
{
    protected $dates = ['settled_at'];

    protected $fillable = ['settled_at'];
}
