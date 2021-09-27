<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        $dataPermissions = [
            'buat-user',
            'lihat-user',
            'edit-user',
            'hapus-user'
        ];
        $permission = Permission::insert($dataPermissions);
        $role = Role::create(['name' => 'root']);
        $role->givePermissionTo($permission);

    }
}
