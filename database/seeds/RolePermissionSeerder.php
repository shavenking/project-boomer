<?php

use App\Entities\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeerder extends Seeder
{
    private $roles = [
        '總經理' => 'general_manager',
        '專案經理' => 'project_manager',
        '品質管理人員' => 'quality_manager',
        '現場工程師' => 'field_engineer',
        '成本控制人員' => 'cost_manager',
        '估驗計價人員' => 'estimation_manager',
        '權限管理人員' => 'permission_manager',
        '專案成員' => 'project_member'
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

        foreach ($this->roles as $displayName => $role) {
            Role::create([
                'name' => $role,
                'display_name' => $displayName
            ]);
        }
    }
}
