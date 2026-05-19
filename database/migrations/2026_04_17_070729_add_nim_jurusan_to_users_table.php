<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nim')->nullable()->unique()->after('role');
            $table->string('jurusan')->nullable()->after('nim');
            $table->string('devisi')->nullable()->after('jurusan');
            $table->string('jabatan')->nullable()->after('devisi');
            $table->string('photo')->nullable()->after('jabatan');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nim', 'jurusan', 'devisi', 'jabatan', 'photo']);
        });
    }
};
