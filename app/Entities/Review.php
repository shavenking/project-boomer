<?php

namespace App\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['resource_type', 'resource_id', 'status', 'role_name'];
}
