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
            JenisPenyakitSeeder::class,
            TipeAsuransiSeeder::class,
            PasienSeeder::class,
            PermissionTableSeeder::class,
            UsersTableSeeder::class,
        ]);
    }
}
