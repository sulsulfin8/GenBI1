<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poin extends Model
{
    use HasFactory;

    // Tambahkan ini agar bisa menyimpan ke database
    protected $fillable = [
        'nim',
        'nama_lengkap',
        'jurusan',
        'devisi',
        'total_poin',
        'sp',
        'keterangan'
    ];
}
