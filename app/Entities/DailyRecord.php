<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class DailyRecord extends Model
{
    protected $fillable = ['check_record', 'important_record'];
}
