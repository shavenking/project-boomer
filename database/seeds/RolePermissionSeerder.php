<?php

use App\Entities\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeerder extends Seeder
{
    private $roles = [
        'general_manager', // 總經理
        'project_manager', // 專案經理
        'quality_manager', // 品質管理人員
        'field_engineer', // 現場工程師
        'cost_manager', // 成本控制人員
        'estimation_manager', // 估驗計價人員
        'permission_manager', // 權限管理人員
        'project_member'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission_role')->truncate();
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();

        foreach ($this->roles as $role) {
            Role::create([
                'name' => $role
            ]);
        }
    }
}
