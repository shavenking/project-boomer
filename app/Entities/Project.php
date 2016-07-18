<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name'];

    public function dailyRecords()
    {
        return $this->hasMany(DailyRecord::class);
    }

    public function works()
    {
        return $this->hasMany(ProjectWork::class);
    }

    public function checklists()
    {
        return $this->hasMany(ProjectChecklist::class);
    }

    public function costEstimations()
    {
        return $this->hasMany(CostEstimation::class);
    }

    public function users()
    {
        return (
            $this
            ->belongsToMany(config('auth.model'), config('entrust.role_user_table'))
            ->withPivot('role_id')
            ->withTimestamps()
        );
    }

    public function addUser($userId, $roleId)
    {
        return $this->users()->attach($userId, ['role_id' => $roleId]);
    }

    public function constructionDailies()
    {
        return $this->hasMany(ConstructionDaily::class);
    }
}
