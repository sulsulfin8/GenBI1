<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;

    protected $fillable = [
        'visi',
        'misi',
        'komitmen',
        'pelanggaran',
        'qris',
        'apresiasi',
        'sp',
        'kriteria_beasiswa',
        'dokumen_beasiswa'
    ];
}
