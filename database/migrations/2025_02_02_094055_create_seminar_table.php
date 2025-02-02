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
        Schema::create('seminar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skripsi_id');
            $table->date('tanggal_seminar');
            $table->time('waktu_seminar');
            $table->string('ruangan');
            $table->enum('jenis_seminar', ['proposal', 'hasil']);
            $table->enum('status', ['terjadwal', 'selesai', 'ditunda']);
            $table->text('catatan')->nullable();
            $table->decimal('nilai', 5, 2)->nullable();
            $table->string('file_presentasi')->nullable();
            $table->string('file_revisi')->nullable();
            $table->foreign('skripsi_id')->references('id')->on('skripsi')->onDelete('cascade');
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
        Schema::dropIfExists('seminar');
    }
};
