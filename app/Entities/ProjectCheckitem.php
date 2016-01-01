<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ProjectCheckitem extends Model
{
    protected $fillable = ['checklist_id', 'name', 'detail', 'passes'];

    protected $casts = [
        'passes' => 'boolean'
    ];

    public function setPassesAttribute($passes)
    {
        if ($passes === 'null') {
            return $this->attributes['passes'] = null;
        }

        $this->attributes['passes'] = (boolean) $passes;
    }
}
