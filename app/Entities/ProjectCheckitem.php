<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ProjectCheckitem extends Model
{
    protected $table = 'project_checkitem';

    protected $fillable = ['project_id', 'checklist_id', 'checkitem_id', 'passes'];

    protected $casts = [
        'passes' => 'boolean'
    ];

    protected $appends = ['name', 'detail'];

    public function setPassesAttribute($passes)
    {
        if ($passes === 'null') {
            return $this->attributes['passes'] = null;
        }

        $this->attributes['passes'] = (boolean) $passes;
    }

    public function getNameAttribute()
    {
        return $this->originalCheckitem->name;
    }

    public function getDetailAttribute()
    {
        return $this->originalCheckitem->detail;
    }

    public function originalCheckitem()
    {
        return $this->hasOne(Checkitem::class, 'id', 'checkitem_id');
    }
}
