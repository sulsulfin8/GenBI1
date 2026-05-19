<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\User;
use App\Models\Anggaran;
use Illuminate\Support\Facades\File;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil data Visi & Misi dari file JSON
        $infoPath = storage_path('app/genbi_info.json');
        if (File::exists($infoPath)) {
            $info = json_decode(File::get($infoPath));
        } else {
            $info = (object) [
                'visi' => '',
                'misi' => '',
                'komitmen' => '',
                'pelanggaran' => '',
                'qris' => '',
                'apresiasi' => '',
                'sp' => ''
            ];
        }

        // 2. Ambil foto-foto dokumentasi
        $galeriPath = public_path('dokumentasi');
        $galeri = [];
        if (File::exists($galeriPath)) {
            $files = File::files($galeriPath);
            foreach ($files as $file) {
                $galeri[] = $file->getFilename();
            }
        }

        // 3. Statistik Dashboard
        $totalKegiatan = Kegiatan::count();
        $totalAnggota = User::where('role', 'anggota')->count();

        try {
            $totalAnggaran = Anggaran::sum('nominal');
        } catch (\Exception $e) {
            $totalAnggaran = 0;
        }

        $kegiatanTerbaru = Kegiatan::latest()->take(5)->get();

        // 4. STRUKTUR ORGANISASI
        $ketua = User::where('role', 'admin')->first();
        $sekretaris = User::where('role', 'sekretaris')->first();
        $bendahara = User::where('role', 'bendahara')->first();
        $semuaKadep = User::where('jabatan', 'like', 'Ketua Devisi%')->get()->keyBy('jabatan');
        $anggotaDevisi = User::where('role', 'anggota')->get()->groupBy('devisi');

        return view('dashboard.index', compact(
            'info',
            'galeri',
            'totalKegiatan',
            'totalAnggota',
            'totalAnggaran',
            'kegiatanTerbaru',
            'ketua',
            'sekretaris',
            'bendahara',
            'semuaKadep',
            'anggotaDevisi'
        ));
    }

    public function updateInfo(Request $request)
    {
        $infoPath = storage_path('app/genbi_info.json');
        $info = File::exists($infoPath) ? json_decode(File::get($infoPath), true) : [];
        if (!is_array($info)) $info = [];

        $info['visi'] = $request->visi;
        $info['misi'] = $request->misi;
        $info['komitmen'] = $request->komitmen;

        File::put($infoPath, json_encode($info, JSON_PRETTY_PRINT));
        return redirect()->back()->with('success', 'Informasi GenBI berhasil diperbarui!');
    }

    public function update_info(Request $request)
    {
        return $this->updateInfo($request);
    }

    public function updatePoin(Request $request)
    {
        $infoPath = storage_path('app/genbi_info.json');
        $info = File::exists($infoPath) ? json_decode(File::get($infoPath), true) : [];
        if (!is_array($info)) $info = [];

        $info['pelanggaran'] = $request->pelanggaran;
        $info['qris'] = $request->qris;
        $info['apresiasi'] = $request->apresiasi;
        $info['sp'] = $request->sp;

        File::put($infoPath, json_encode($info, JSON_PRETTY_PRINT));
        return redirect()->back()->with('success', 'Aturan Poin berhasil diperbarui!');
    }

    public function update_poin(Request $request)
    {
        return $this->updatePoin($request);
    }

    public function uploadDokumentasi(Request $request)
    {
        $request->validate(['foto' => 'required|image|max:10240']);
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('dokumentasi'), $filename);
        }
        return redirect()->back()->with('success', 'Foto dokumentasi berhasil ditambahkan!');
    }

    public function upload_dokumentasi(Request $request)
    {
        return $this->uploadDokumentasi($request);
    }

    // =========================================================
    // PERBAIKAN: FITUR HAPUS FOTO (MASSAL & SATUAN)
    // =========================================================
    public function hapusDokumentasi(Request $request)
    {
        $deletedCount = 0;

        // 1. Cek jika menggunakan hapus massal (nama file dikirim dalam bentuk Array 'filenames')
        if ($request->has('filenames') && is_array($request->filenames)) {
            foreach ($request->filenames as $filename) {
                $path = public_path('dokumentasi/' . $filename);
                if (File::exists($path)) {
                    File::delete($path);
                    $deletedCount++;
                }
            }
            return redirect()->back()->with('success', $deletedCount . ' Foto dokumentasi berhasil dihapus!');
        }

        // 2. Cek jika menggunakan hapus satuan (hanya 1 nama file 'filename')
        else if ($request->has('filename')) {
            $path = public_path('dokumentasi/' . $request->filename);
            if (File::exists($path)) {
                File::delete($path);
                $deletedCount = 1;
            }
            return redirect()->back()->with('success', 'Foto dokumentasi berhasil dihapus!');
        }

        return redirect()->back()->with('error', 'Tidak ada foto yang dipilih untuk dihapus.');
    }

    // Kembaran nama fungsi agar tidak terjadi error (berjaga-jaga web.php kamu memanggil fungsi yang berbeda)
    public function hapus_dokumentasi(Request $request)
    {
        return $this->hapusDokumentasi($request);
    }
}
