<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ConstructionDaily extends Model
{
    protected $fillable = ['inspection_record', 'important_record'];

    public function works()
    {
        return $this->belongsToMany(ProjectWork::class)->withPivot('id', 'seat')->withTimestamps();
    }

    public function labors()
    {
        return $this->belongsToMany(Labor::class)->withPivot('id', 'amount')->withTimestamps();
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class)->withPivot('id', 'amount')->withTimestamps();
    }

    public function appliances()
    {
        return $this->belongsToMany(Appliance::class)->withPivot('id', 'amount')->withTimestamps();
    }
}
