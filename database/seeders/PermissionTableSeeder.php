<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'pasien-list',
            'pasien-create',
            'pasien-edit',
            'pasien-view',
            'pasien-delete',
            'jenisasuransi-list',
            'jenisasuransi-create',
            'jenisasuransi-edit',
            'jenisasuransi-view',
            'jenisasuransi-delete',
            'jenispenyakit-list',
            'jenispenyakit-create',
            'jenispenyakit-edit',
            'jenispenyakit-view',
            'jenispenyakit-delete',
            'penyakit-list',
            'penyakit-create',
            'penyakit-edit',
            'penyakit-view',
            'penyakit-delete',
            'klaimasuransi-list',
            'klaimasuransi-create',
            'klaimasuransi-edit',
            'klaimasuransi-view',
            'klaimasuransi-delete',
            'klaimasuransi-search',
            'reimburse-index',
            'reimburse-view',
            'reimburse-klaim',
            'reimburse-search',
         ];
      
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
