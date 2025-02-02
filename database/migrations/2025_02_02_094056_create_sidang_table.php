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
        Schema::create('sidang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skripsi_id');
            $table->date('tanggal_sidang');
            $table->time('waktu_sidang');
            $table->string('ruangan');
            $table->unsignedBigInteger('penguji1_id');
            $table->unsignedBigInteger('penguji2_id');
            $table->unsignedBigInteger('penguji3_id')->nullable();
            $table->enum('status', ['terjadwal', 'lulus', 'tidak_lulus', 'ditunda']);
            $table->decimal('nilai_penguji1', 5, 2)->nullable();
            $table->decimal('nilai_penguji2', 5, 2)->nullable();
            $table->decimal('nilai_penguji3', 5, 2)->nullable();
            $table->decimal('nilai_akhir', 5, 2)->nullable();
            $table->text('catatan')->nullable();
            $table->string('file_revisi_final')->nullable();
            $table->foreign('skripsi_id')->references('id')->on('skripsi')->onDelete('cascade');
            $table->foreign('penguji1_id')->references('id')->on('dosen');
            $table->foreign('penguji2_id')->references('id')->on('dosen');
            $table->foreign('penguji3_id')->references('id')->on('dosen');
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
        Schema::dropIfExists('sidang');
    }
};
