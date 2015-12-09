<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class WorkflowNode extends Model
{
    protected $fillable = ['workflow_id', 'order', 'title'];
}
