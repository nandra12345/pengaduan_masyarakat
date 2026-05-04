<?php
// database/migrations/2024_01_01_000004_create_tanggapan_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tanggapan', function (Blueprint $table) {
            $table->id('id_tanggapan');
            $table->unsignedBigInteger('id_pengaduan');
            $table->date('tgl_tanggapan');
            $table->text('tanggapan');
            $table->unsignedBigInteger('id_petugas');
            $table->timestamps();

            // Foreign Key ke tabel pengaduan
            $table->foreign('id_pengaduan')
                  ->references('id_pengaduan')
                  ->on('pengaduan')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            // Foreign Key ke tabel petugas
            $table->foreign('id_petugas')
                  ->references('id_petugas')
                  ->on('petugas')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tanggapan');
    }
};