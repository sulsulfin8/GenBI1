<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->string('judul_laporan');
            $table->string('jenis_laporan');
            $table->string('devisi')->nullable();
            $table->string('lokasi')->nullable();
            $table->date('tanggal_laporan')->nullable();
            $table->string('file_path')->nullable(); // Jika nanti ingin simpan file PDF/Word
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
