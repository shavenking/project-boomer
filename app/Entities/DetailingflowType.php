<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class DetailingflowType extends Model
{
    protected $fillable = ['mainflow_type_id', 'name'];

    public function mainflowType()
    {
        return $this->hasOne(MainflowType::class, 'id', 'mainflow_type_id');
    }
}
