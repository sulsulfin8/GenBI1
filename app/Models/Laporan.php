<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_laporan',
        'jenis_laporan',
        'devisi',
        'lokasi',
        'tanggal_laporan',
        'file_path'
    ];
}
