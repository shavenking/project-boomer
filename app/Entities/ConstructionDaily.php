<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ConstructionDaily extends Model
{
    public function works()
    {
        return $this->belongsToMany(ProjectWork::class)->withPivot('id', 'seat')->withTimestamps();
    }

    public function labors()
    {
        return $this->belongsToMany(DailyLabor::class)->withPivot('id', 'amount')->withTimestamps();
    }

    public function materials()
    {
        return $this->belongsToMany(DailyMaterial::class)->withPivot('id', 'amount')->withTimestamps();
    }
}
