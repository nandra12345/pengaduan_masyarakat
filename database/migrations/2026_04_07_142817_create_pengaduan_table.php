<?php
// database/migrations/2024_01_01_000003_create_pengaduan_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id('id_pengaduan');
            $table->date('tgl_pengaduan');
            $table->char('nik', 16);
            $table->text('isi_laporan');
            $table->string('foto', 255)->nullable();
            $table->enum('status', ['0', 'proses', 'selesai'])->default('0');
            $table->timestamps();

            // Foreign Key ke tabel masyarakat
            $table->foreign('nik')
                  ->references('nik')
                  ->on('masyarakat')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};