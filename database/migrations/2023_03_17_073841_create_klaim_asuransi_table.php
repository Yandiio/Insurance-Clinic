<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('klaim_asuransi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('id_pasien');
            $table->unsignedBigInteger('id_tipe_asuransi');
            $table->char('tindakan');
            $table->char('lab');
            $table->char('obat');
            $table->unsignedBigInteger('id_statusklaim');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('id_pasien')->references('id')->on('pasien');
            $table->foreign('id_statusklaim')->references('id')->on('status');
            $table->foreign('id_tipe_asuransi')->references('id')->on('tipe_asuransi');
            $table->string('no_klaim')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('klaim_asuransi');
    }
};
