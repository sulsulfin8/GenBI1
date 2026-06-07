<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Anggaran;
use Illuminate\Http\Request;

class AnggaranController extends Controller
{
    // Jangan lupa pastikan di bagian atas file sudah ada: use Illuminate\Http\Request;

    public function index(Request $request)
    {
        // 1. Mulai query dari model Kegiatan beserta relasi anggarannya
        $query = Kegiatan::with('anggarans')->latest();

        // 2. Logika Filter Devisi
        if ($request->has('devisi') && $request->devisi != '') {
            $query->where('devisi', $request->devisi);
        }

        // 3. Logika Pencarian berdasarkan Nama Kegiatan
        if ($request->has('search') && $request->search != '') {
            $keyword = $request->search;
            $query->where('nama_kegiatan', 'like', '%' . $keyword . '%');
        }

        // 4. Eksekusi query
        $kegiatans = $query->get();

        return view('anggaran.index', compact('kegiatans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kegiatan_id' => 'required|exists:kegiatans,id',
            'tujuan' => 'required',
            'manfaat' => 'required',
            'items' => 'required|array',
        ]);

        // 1. Update Informasi Kegiatan (A, B, C, D)
        $kegiatan = Kegiatan::find($request->kegiatan_id);
        $kegiatan->update([
            'nama_kegiatan' => $request->nama_kegiatan,
            'pengertian'    => $request->pengertian,
            'tujuan' => $request->tujuan,
            'manfaat' => $request->manfaat,
            'waktu' => $request->waktu,
            'tempat' => $request->tempat,
        ]);

        // 2. Simpan Rincian RAB (E)
        Anggaran::where('kegiatan_id', $request->kegiatan_id)->delete();
        foreach ($request->items as $item) {
            Anggaran::create([
                'kegiatan_id'  => $request->kegiatan_id,
                'nama_barang'  => $item['nama'],
                'harga_satuan' => $item['harga'],
                'jumlah'       => $item['qty'],
                'satuan'       => $item['satuan'],
                'total'        => $item['harga'] * $item['qty'],
            ]);
        }

        return redirect()->back()->with('success', 'Rancangan Anggaran Berhasil Disimpan!');
    }
}
