<?php

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        
        $permissions = [
            [
                'role_id' => '1',
                'permission_id' => '1', 
            ],
            [
                'role_id' => '2',
                'permission_id' => '2', 
            ],
        ];

        DB::table('permission_role')->insert($permissions);
    }
}
