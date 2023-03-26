<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisPenyakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenis_penyakit')->insert([
            'nama_penyakit' => 'GERD',
            'created_at' => now(),
            'updated_at' => now()
        ]); 

        DB::table('jenis_penyakit')->insert([
            'nama_penyakit' => 'Asthma',
            'created_at' => now(),
            'updated_at' => now()
        ]); 

        DB::table('jenis_penyakit')->insert([
            'nama_penyakit' => 'Diabetes',
            'created_at' => now(),
            'updated_at' => now()
        ]); 

        DB::table('jenis_penyakit')->insert([
            'nama_penyakit' => 'Kolesterol',
            'created_at' => now(),
            'updated_at' => now()
        ]); 

        DB::table('jenis_penyakit')->insert([
            'nama_penyakit' => 'Maag',
            'created_at' => now(),
            'updated_at' => now()
        ]); 
        
        DB::table('jenis_penyakit')->insert([
            'nama_penyakit' => 'TBC',
            'created_at' => now(),
            'updated_at' => now()
        ]); 
    }
}
