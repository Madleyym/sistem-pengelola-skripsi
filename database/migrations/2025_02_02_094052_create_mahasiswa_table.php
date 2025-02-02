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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('nim')->unique();
            $table->string('nama_mahasiswa');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('email');
            $table->string('no_telp');
            $table->text('alamat');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('jurusan_id');
            $table->integer('angkatan');
            $table->enum('status', ['aktif', 'alumni', 'keluar']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('jurusan_id')->references('id')->on('jurusan')->onDelete('cascade');
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
        Schema::dropIfExists('mahasiswa');
    }
};
