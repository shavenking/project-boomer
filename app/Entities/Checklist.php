<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    protected $fillable = ['workflow_id', 'name'];

    public function checkitems()
    {
        return $this->hasMany(Checkitem::class);
    }

    public function workflow()
    {
        return $this->belongsTo(Workflow::class);
    }
}
