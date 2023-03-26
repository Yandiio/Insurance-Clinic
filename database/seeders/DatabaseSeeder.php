<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            StatusSeeder::class,
            UsersTableSeeder::class,
            JenisPenyakitSeeder::class,
            TipeAsuransiSeeder::class,
            PasienSeeder::class
        ]);
    }
}
