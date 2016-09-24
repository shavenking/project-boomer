<?php

namespace App\Entities;

use App\Entities\AbstractEntity;

class WorkflowNode extends AbstractEntity
{
    protected $fillable = ['workflow_id', 'order', 'title'];
}
