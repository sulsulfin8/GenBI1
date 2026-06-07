<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\User;
use App\Models\Anggaran;
use Illuminate\Support\Facades\File;
use App\Models\Info;

class DashboardController extends Controller
{
    public function index()
    {
        // Membaca data dari Database MySQL
        $info = Info::first();

        // Jika database masih kosong, berikan nilai default
        if (!$info) {
            $info = (object) [
                'visi' => '',
                'misi' => '',
                'komitmen' => '',
                'pelanggaran' => '',
                'qris' => '',
                'apresiasi' => '',
                'sp' => '',
                'kriteria_beasiswa' => '',
                'dokumen_beasiswa' => ''
            ];
        }
        $galeriPath = public_path('dokumentasi');
        $galeri = [];
        if (File::exists($galeriPath)) {
            $files = File::files($galeriPath);
            foreach ($files as $file) {
                $galeri[] = $file->getFilename();
            }
        }

        $totalKegiatan = Kegiatan::count();
        $totalAnggota = User::where('role', 'anggota')->count();

        try {
            $totalAnggaran = Anggaran::sum('nominal');
        } catch (\Exception $e) {
            $totalAnggaran = 0;
        }

        $kegiatanTerbaru = Kegiatan::latest()->take(5)->get();

        $ketua = User::where('role', 'admin')->first();
        $sekretaris = User::where('role', 'sekretaris')->first();
        $bendahara = User::where('role', 'bendahara')->first();
        $semuaKadep = User::where('jabatan', 'like', 'Ketua Devisi%')->get()->keyBy('jabatan');
        $anggotaDevisi = User::where('role', 'anggota')->get()->groupBy('devisi');

        $agendaTerdekat = Kegiatan::whereDate('tanggal', '>=', now()->toDateString())
            ->orderBy('tanggal', 'asc')
            ->get();

        $tampilkanPopup = false;
        if (auth()->check() && auth()->user()->role == 'anggota' && !session()->has('popup_tampil_sekali')) {
            $tampilkanPopup = true;
            session()->put('popup_tampil_sekali', true);
        }

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
            'anggotaDevisi',
            'agendaTerdekat',
            'tampilkanPopup'
        ));
    }

    // PERBAIKAN: Ubah nama menjadi updateInfo (huruf I besar)
    public function updateInfo(Request $request)
    {
        // Ambil data pertama dari database, jika kosong maka buat baru
        $info = Info::first() ?? new Info();

        if ($request->has('visi')) $info->visi = $request->visi;
        if ($request->has('misi')) $info->misi = $request->misi;
        if ($request->has('komitmen')) $info->komitmen = $request->komitmen;
        if ($request->has('kriteria_beasiswa')) $info->kriteria_beasiswa = $request->kriteria_beasiswa;
        if ($request->has('dokumen_beasiswa')) $info->dokumen_beasiswa = $request->dokumen_beasiswa;

        $info->save();

        return redirect()->back();
    }

    // PERBAIKAN: Ubah nama menjadi updatePoin (huruf P besar) untuk berjaga-jaga
    public function updatePoin(Request $request)
    {
        // Ambil data pertama dari database, jika kosong maka buat baru
        $info = Info::first() ?? new Info();

        if ($request->has('pelanggaran')) $info->pelanggaran = $request->pelanggaran;
        if ($request->has('qris')) $info->qris = $request->qris;
        if ($request->has('apresiasi')) $info->apresiasi = $request->apresiasi;
        if ($request->has('sp')) $info->sp = $request->sp;

        $info->save();

        return redirect()->back();
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

    public function hapusDokumentasi(Request $request)
    {
        $deletedCount = 0;
        if ($request->has('filenames') && is_array($request->filenames)) {
            foreach ($request->filenames as $filename) {
                $path = public_path('dokumentasi/' . $filename);
                if (File::exists($path)) {
                    File::delete($path);
                    $deletedCount++;
                }
            }
            return redirect()->back()->with('success', $deletedCount . ' Foto dokumentasi berhasil dihapus!');
        } else if ($request->has('filename')) {
            $path = public_path('dokumentasi/' . $request->filename);
            if (File::exists($path)) {
                File::delete($path);
                $deletedCount = 1;
            }
            return redirect()->back()->with('success', 'Foto dokumentasi berhasil dihapus!');
        }
        return redirect()->back()->with('error', 'Tidak ada foto yang dipilih untuk dihapus.');
    }

    public function hapus_dokumentasi(Request $request)
    {
        return $this->hapusDokumentasi($request);
    }
}
