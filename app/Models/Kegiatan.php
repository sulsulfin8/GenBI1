<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'devisi',
        'nama_kegiatan',
        'tujuan',   // Tambahkan ini
        'manfaat',  // Tambahkan ini
        'waktu',
        'tanggal',
        'tempat'
    ];

    // TAMBAHKAN KODE INI:
    public function anggarans()
    {
        return $this->hasMany(Anggaran::class, 'kegiatan_id');
    }
    public function absensis()
    {
        return $this->hasMany(Absensi::class, 'kegiatan_id');
    }
}
