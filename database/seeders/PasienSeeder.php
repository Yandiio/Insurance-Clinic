<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pasien')->insert([
            'nik' => '3273310092984876',
            'nama_lengkap' => 'Man Tan Malakia',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '2002/08/01',
            'alamat' => 'Jl Kapt.Tendean No 28/A',
            'usia' => 21,
            'jenis_kelamin' => 'Laki-laki',
            'golongan_darah' => 'O+',
            'agama' => 'Islam',
            'created_at' => now(),
            'updated_at' => now()
        ]);  

        DB::table('pasien')->insert([
            'nik' => '3273310092984822',
            'nama_lengkap' => 'Cut Muthia',
            'tempat_lahir' => 'Aceh',
            'tanggal_lahir' => '2002/02/01',
            'alamat' => 'Jl Kapt.Tendean No 28/A',
            'usia' => 21,
            'jenis_kelamin' => 'Perempuan',
            'golongan_darah' => 'B+',
            'agama' => 'Islam',
            'created_at' => now(),
            'updated_at' => now()
        ]);  
    }
}
