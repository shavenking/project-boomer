<?php

namespace App\Entities;

use App\Entities\Contract\ResourceTypeContract;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractEntity extends Model Implements ResourceTypeContract
{
    public function getResourceType(): string
    {
        $className = class_basename(get_class($this));

        return snake_case($className);
    }
}
