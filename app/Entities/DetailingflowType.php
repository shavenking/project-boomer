<?php

namespace App\Entities;

use App\Entities\AbstractEntity;

class DetailingflowType extends AbstractEntity
{
    protected $fillable = ['mainflow_type_id', 'name'];

    public function mainflowType()
    {
        return $this->hasOne(MainflowType::class, 'id', 'mainflow_type_id');
    }
}
