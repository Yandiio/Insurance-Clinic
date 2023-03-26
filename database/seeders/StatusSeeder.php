<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StatusReimburse;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = new StatusReimburse;
        $status->status = "Belum Klaim";
        $status->save();

        $status = new StatusReimburse;
        $status->status = "Diproses";
        $status->save();

        $status = new StatusReimburse;
        $status->status = "Sudah Klaim";
        $status->save();
    }
}
