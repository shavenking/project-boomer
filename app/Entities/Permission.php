<?php

namespace App\Entities;

use App\Entities\AbstractEntity;
use Zizaco\Entrust\Contracts\EntrustPermissionInterface;
use Zizaco\Entrust\Traits\EntrustPermissionTrait;
use Illuminate\Support\Facades\Config;

class Permission extends AbstractEntity implements EntrustPermissionInterface
{
    use EntrustPermissionTrait;

    protected $fillable = ['name'];

    protected $table;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('entrust.permissions_table');
    }
}
