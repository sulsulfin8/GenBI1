<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('anggarans', function (Blueprint $table) {
            $table->id();
            // Tambahkan kolom foreignId ini agar relasi bekerja
            $table->foreignId('kegiatan_id')->constrained('kegiatans')->onDelete('cascade');
            $table->string('nama_barang');
            $table->decimal('harga_satuan', 15, 2);
            $table->integer('jumlah');
            $table->string('satuan');
            $table->decimal('total', 15, 2);
            $table->timestamps();
        });
    }
};
