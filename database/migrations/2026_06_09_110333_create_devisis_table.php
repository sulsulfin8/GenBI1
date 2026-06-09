<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('devisis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_devisi');
            $table->text('deskripsi');
            $table->string('warna')->default('blue');
            $table->text('ikon')->nullable(); // Untuk menyimpan gambar ikon
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devisis');
    }
};
