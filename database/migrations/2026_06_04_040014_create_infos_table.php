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
        Schema::create('infos', function (Blueprint $table) {
            $table->id();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->text('komitmen')->nullable();
            $table->text('pelanggaran')->nullable();
            $table->text('qris')->nullable();
            $table->text('apresiasi')->nullable();
            $table->text('sp')->nullable();
            $table->text('kriteria_beasiswa')->nullable();
            $table->text('dokumen_beasiswa')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infos');
    }
};
