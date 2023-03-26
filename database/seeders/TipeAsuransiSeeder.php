<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipeAsuransiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipe_asuransi')->insert([
            'nama' => 'Manulife',
            'kode_asuransi' => '',
            'telepon' => 62821880,
            'email' => 'manulife@insurance.com',
            'alamat' => 'Jl Kapt.Tendean No 28/A',
            'created_at' => now(),
            'updated_at' => now()
        ]);    

        DB::table('tipe_asuransi')->insert([
            'nama' => 'BPJS Kesehatan',
            'kode_asuransi' => '',
            'telepon' => 62821880,
            'email' => 'bpjs.kes@gov.id',
            'alamat' => 'Jl Kapt.Tendean No 28/A',
            'created_at' => now(),
            'updated_at' => now()
        ]);    

        DB::table('tipe_asuransi')->insert([
            'nama' => 'Prudential',
            'kode_asuransi' => '',
            'telepon' => 62821880,
            'email' => 'prudential@insurance.com',
            'alamat' => 'Jl Kapt.Tendean No 28/A',
            'created_at' => now(),
            'updated_at' => now()
        ]);    

        DB::table('tipe_asuransi')->insert([
            'nama' => 'AXA',
            'kode_asuransi' => '',
            'telepon' => 62821880,
            'email' => 'axa_mandiri@insurance.com',
            'alamat' => 'Jl Kapt.Tendean No 28/A',
            'created_at' => now(),
            'updated_at' => now()
        ]);    

        DB::table('tipe_asuransi')->insert([
            'nama' => 'AIA',
            'kode_asuransi' => '',
            'telepon' => 62821880,
            'email' => 'aia_ins@insurance.com',
            'alamat' => 'Jl Cikarang No 28/A',
            'created_at' => now(),
            'updated_at' => now()
        ]);    
    }
}
