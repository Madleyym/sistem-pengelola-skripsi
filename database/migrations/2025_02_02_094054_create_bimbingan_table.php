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
        Schema::create('bimbingan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skripsi_id');
            $table->unsignedBigInteger('dosen_id');
            $table->date('tanggal_bimbingan');
            $table->time('waktu_bimbingan');
            $table->text('catatan_bimbingan');
            $table->string('file_bimbingan')->nullable();
            $table->enum('status', ['diajukan', 'diterima', 'revisi']);
            $table->text('keterangan')->nullable();
            $table->foreign('skripsi_id')->references('id')->on('skripsi')->onDelete('cascade');
            $table->foreign('dosen_id')->references('id')->on('dosen');
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
        Schema::dropIfExists('bimbingan');
    }
};
