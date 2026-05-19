<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    // Sesuaikan ini dengan kolom-kolom yang ada di phpMyAdmin kamu!
    protected $fillable = [
        'nim',
        'nama_lengkap',
        'jurusan',
        'devisi',
        'kegiatan',
        'status' // Ingat untuk menambahkan kolom status di database ya!
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id');
    }
}
