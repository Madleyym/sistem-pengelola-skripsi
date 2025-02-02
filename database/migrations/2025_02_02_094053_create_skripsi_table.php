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
        Schema::create('skripsi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mahasiswa_id');
            $table->string('judul_skripsi');
            $table->text('abstrak')->nullable();
            $table->text('kata_kunci')->nullable();
            $table->unsignedBigInteger('pembimbing1_id');
            $table->unsignedBigInteger('pembimbing2_id')->nullable();
            $table->enum('status', ['pengajuan', 'diterima', 'ditolak', 'revisi', 'selesai']);
            $table->string('file_proposal')->nullable();
            $table->string('file_skripsi')->nullable();
            $table->date('tanggal_pengajuan');
            $table->date('tanggal_selesai')->nullable();
            $table->text('keterangan')->nullable();
            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('pembimbing1_id')->references('id')->on('dosen');
            $table->foreign('pembimbing2_id')->references('id')->on('dosen');
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
        Schema::dropIfExists('skripsi');
    }
};
