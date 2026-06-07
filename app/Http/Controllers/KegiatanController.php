<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

        // 1. Bersihkan nama kegiatan (hilangkan spasi di awal/akhir)
        $namaKegiatan = trim($kegiatan->nama_kegiatan);

        // 2. HAPUS ABSENSI (Gunakan LIKE agar jauh lebih aman dan fleksibel)
        // LIKE '%...%' akan memastikan walaupun ada spasi nyangkut di database, datanya tetap terhapus.
        $jumlahTerhapus = \App\Models\Absensi::where('kegiatan', 'like', '%' . $namaKegiatan . '%')->delete();

        // 3. HAPUS ANGGARAN
        \App\Models\Anggaran::where('kegiatan_id', $kegiatan->id)->delete();

        // 4. HAPUS KEGIATAN
        $kegiatan->delete();

        return redirect()->route('kegiatan')->with('success', "Kegiatan dihapus. ($jumlahTerhapus data absensi ikut dibersihkan)");
    }
}
