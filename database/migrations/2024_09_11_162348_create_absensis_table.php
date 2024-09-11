<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->bigIncrements('id_absensi');
            $table->unsignedBigInteger('id_detail');
            $table->string('jam_masuk');
            $table->string('jam_keluar')->nullable();
            $table->string('tanggal_masuk');
            $table->string('tanggal_keluar')->nullable();
            $table->string('lokasi_masuk');
            $table->string('lokasi_keluar')->nullable();
            $table->enum('jenis_absensi', ['Hadir', 'Sakit', 'Izin', 'Alfa']);
            $table->string('keterangan');
            $table->string('foto_masuk')->nullable();
            $table->string('foto_keluar')->nullable();
            $table->timestamps();

            $table->foreign('id_detail')->references('id_detail')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
