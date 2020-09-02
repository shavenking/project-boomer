<?php

use App\Entities\Permission;
use App\Entities\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    private $rolePermission = [
        'general_manager' => [
            'display_name' => '總經理',
            'permissions' => []
        ],
        'project_manager' => [
            'display_name' => '專案經理',
            'permissions' => [
                'proceed_review_bid',
                'reject_review_bid',
                'cancel_review_bid',
                'proceed_review_construction_daily',
                'reject_review_construction_daily',
                'cancel_review_construction_daily',
                'proceed_review_checklist',
                'reject_review_checklist',
                'cancel_review_checklist',
                'proceed_review_fault_improvement',
                'reject_review_fault_improvement',
                'cancel_review_fault_improvement',
                'proceed_review_cost_estimation',
                'reject_review_cost_estimation',
                'cancel_review_cost_estimation'
            ]
        ],
        'quality_manager' => [
            'display_name' => '品質管理人員',
            'permissions' => [
                'start_review_project_checklist',
                'start_review_fault_improvement'
            ]
        ],
        'field_engineer' => [
            'display_name' => '工地主任',
            'permissions' => [
                'proceed_review_construction_daily',
                'reject_review_construction_daily',
                'proceed_review_checklist',
                'reject_review_checklist',
                'proceed_review_fault_improvement',
                'reject_review_fault_improvement'
            ]
        ],
        'cost_manager' => [
            'display_name' => '成本控制人員',
            'permissions' => ['start_review_bid']
        ],
        'estimation_manager' => [
            'display_name' => '估驗計價人員',
            'permissions' => ['start_review_cost_estimation']
        ],
        'permission_manager' => [
            'display_name' => '權限管理人員',
            'permissions' => []
        ],
        'project_member' => [
            'display_name' => '專案成員',
            'permissions' => []
        ],
        'engineer' => [
            'display_name' => '現場工程師',
            'permissions' => ['start_review_construction_daily']
        ]
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

        foreach ($this->rolePermission as $name => $role) {
            $roleEntity = Role::create([
                'name' => $name,
                'display_name' => $role['display_name']
            ]);

            // get permissions
            $perms = Permission::whereIn('name', $role['permissions'])->get(['id']);
            $roleEntity->attachPermissions($perms);
        }
    }
}
