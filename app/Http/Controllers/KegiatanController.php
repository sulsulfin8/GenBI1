<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Absensi;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        // Mulai membuat query dari model Kegiatan, urutkan dari yang terbaru
        $query = Kegiatan::latest();

        // 1. Logika Filter Devisi 
        if ($request->has('devisi') && $request->devisi != '') {
            $query->where('devisi', $request->devisi);
        }

        // 2. Logika Pencarian (Search / Live Search)
        if ($request->has('search') && $request->search != '') {
            $keyword = $request->search;

            // Mencari berdasarkan nama_kegiatan atau tempat
            $query->where(function ($q) use ($keyword) {
                $q->where('nama_kegiatan', 'like', '%' . $keyword . '%')
                    ->orWhere('tempat', 'like', '%' . $keyword . '%');
            });
        }

        // 3. Menangkap jumlah 'Show Entries' dari dropdown (Default 10)
        $perPage = $request->input('per_page', 10);

        // 4. Jalankan query dengan PAGINATION
        $kegiatans = $query->paginate($perPage);

        return view('kegiatan.index', compact('kegiatans'));
    }

    // Menyimpan data kegiatan baru
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'devisi' => 'required',
            'nama_kegiatan' => 'required',
            'waktu' => 'required',
            'tanggal' => 'required',
            'tempat' => 'required',
        ]);

        // 2. Simpan ke Database
        Kegiatan::create([
            'devisi' => $request->devisi,
            'nama_kegiatan' => $request->nama_kegiatan,
            'waktu' => $request->waktu,
            'tanggal' => $request->tanggal,
            'tempat' => $request->tempat,
        ]);

        // 3. Kembali ke halaman kegiatan dengan pesan sukses 
        return redirect()->route('kegiatan')->with('success', 'Kegiatan berhasil ditambahkan!');
    }

    // Fungsi untuk memproses pembaruan data (Edit)
    public function update(Request $request, $id)
    {
        // 1. Validasi Input
        $request->validate([
            'devisi' => 'required',
            'nama_kegiatan' => 'required',
            'waktu' => 'required',
            'tanggal' => 'required',
            'tempat' => 'required',
        ]);

        // 2. Cari data berdasarkan ID, lalu update
        $kegiatan = Kegiatan::findOrFail($id);
        $namaLama = $kegiatan->nama_kegiatan; // Simpan nama lama sebelum diupdate

        $kegiatan->update([
            'devisi' => $request->devisi,
            'nama_kegiatan' => $request->nama_kegiatan,
            'waktu' => $request->waktu,
            'tanggal' => $request->tanggal,
            'tempat' => $request->tempat,
        ]);

        // PERBAIKAN: Jika nama kegiatan diubah, otomatis update nama di tabel Absensi juga!
        if ($namaLama != $request->nama_kegiatan) {
            \App\Models\Absensi::where('kegiatan', 'like', '%' . $namaLama . '%')
                ->update(['kegiatan' => $request->nama_kegiatan]);
        }

        // 3. Kembali ke halaman dengan pesan sukses
        return redirect()->route('kegiatan')->with('success', 'Kegiatan berhasil diperbarui!');
    }

    // Fungsi untuk menghapus data
    public function destroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        // ==================================================
        // PEMBERSIHAN TOTAL (CASCADE DELETE)
        // ==================================================
        // 1. Hapus semua daftar absensi yang terkait dengan nama kegiatan ini
        // PERBAIKAN: Gunakan 'LIKE' agar bisa menghapus absensi yang namanya terlanjur kotor oleh emoji
        \App\Models\Absensi::where('kegiatan', 'like', '%' . $kegiatan->nama_kegiatan . '%')->delete();

        // 2. Hapus semua rincian anggaran yang terkait dengan ID kegiatan ini
        \App\Models\Anggaran::where('kegiatan_id', $kegiatan->id)->delete();

        // 3. Terakhir, baru hapus acara kegiatannya
        $kegiatan->delete();

        // 4. Kembali ke halaman dengan pesan sukses 
        return redirect()->route('kegiatan')->with('success', 'Kegiatan beserta seluruh data absensi dan anggarannya berhasil dihapus permanen!');
    }
}
