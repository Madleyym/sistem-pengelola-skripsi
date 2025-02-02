<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jurusan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_jurusan')->unique();
            $table->string('nama_jurusan');
            $table->string('kepala_jurusan');
            $table->text('deskripsi')->nullable();
            $table->string('akreditasi');
            $table->boolean('status_aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jurusan');
    }
};
