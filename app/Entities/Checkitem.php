<?php

namespace App\Entities;

use App\Entities\AbstractEntity;

class Checkitem extends AbstractEntity
{
    protected $fillable = ['checklist_id', 'name', 'detail'];
}
