<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dosen', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->unique();
            $table->string('nama_dosen');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('email');
            $table->string('no_telp');
            $table->text('alamat');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('jurusan_id');
            $table->enum('status', ['aktif', 'tidak_aktif']);
            $table->string('bidang_keahlian');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('jurusan_id')->references('id')->on('jurusan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dosen');
    }
};
