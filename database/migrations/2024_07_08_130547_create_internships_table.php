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
        Schema::create('internships', function (Blueprint $table) {
            $table->bigIncrements('id_internship');
            $table->unsignedBigInteger('id_detail');
            $table->string('nik')->unique();
            $table->string('nama_lengkap');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Pria', 'Wanita']);
            $table->string('asal_instansi');
            $table->text('alamat');
            $table->string('no_telepon');
            $table->string('email')->unique();
            $table->date('tanggal_masuk');
            $table->string('posisi');
            $table->enum('status_internship', ['Aktif', 'Tidak Aktif'])->default('Aktif');
            $table->string('foto_internship')->nullable();
            $table->timestamps();

            $table->foreign('id_detail')->references('id_detail')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internships');
    }
};
