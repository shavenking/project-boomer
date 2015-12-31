<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Checkitem extends Model
{
    protected $fillable = ['checklist_id', 'name', 'detail'];
}
