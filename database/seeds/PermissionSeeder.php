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
            'menu-dashboard',
            'menu-rekam-medis',
            'menu-rawat-jalan',
            'menu-rawat-inap',

            'menu-setup-user',
            'menu-setup-role',
            'menu-satuan-tugas-medis',
            'menu-layanan-bagian',
            'menu-list-dokter',
        ];

        foreach ($dataPermissions as $dp) {
            Permission::updateOrCreate(['name'=>$dp],['name'=> $dp]);
        }


    }
}
