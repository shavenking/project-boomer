<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name'];

    public function dailyMaterials()
    {
        return $this->belongsToMany(DailyMaterial::class, 'project_daily_material', 'project_id', 'daily_material_id')
            ->withPivot('id', 'amount')
            ->withTimestamps();
    }

    public function works()
    {
        return $this->hasMany(ProjectWork::class);
    }

    public function checklists()
    {
        return $this->hasMany(ProjectChecklist::class);
    }
}
