<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('poins', function (Blueprint $table) {
            $table->id();
            // Menambahkan kolom untuk tabel poin
            $table->string('nim')->nullable();
            $table->string('nama_lengkap')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('devisi')->nullable();
            $table->string('total_poin')->default('0');
            $table->string('sp')->default('Aman');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('poins');
    }
};
