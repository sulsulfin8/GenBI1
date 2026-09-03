<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\User;
use App\Models\Anggaran;
use Illuminate\Support\Facades\File;
use App\Models\Info;
use App\Models\Devisi;
use App\Models\KategoriPoin;

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
        // Mengambil data divisi, jika kosong, otomatis buatkan yang standar!
        $daftarDevisi = Devisi::all();
        if ($daftarDevisi->isEmpty()) {
            $defaultDevisi = [
                ['nama_devisi' => 'Pengurus Inti', 'deskripsi' => 'Terdiri dari Ketua, Sekretaris, dan Bendahara. Bertanggung jawab atas jalannya roda organisasi, administrasi, sirkulasi keuangan, serta mengambil keputusan strategis komisariat.', 'warna' => 'gray', 'ikon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m3-4h1m-1 4h1m-5 8h8"></path>'],
                ['nama_devisi' => 'Pendidikan & Kebudayaan', 'deskripsi' => 'Berfokus pada peningkatan kapasitas akademik anggota dan masyarakat, serta pelestarian nilai-nilai kebudayaan lokal melalui kegiatan seminar, diskusi, dan pelatihan.', 'warna' => 'blue', 'ikon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>'],
                ['nama_devisi' => 'Pengabdian Masyarakat', 'deskripsi' => 'Menjadi jembatan antara GenBI dan masyarakat. Menyelenggarakan kegiatan sosial, bantuan kemanusiaan, dan program pemberdayaan untuk menebar energi positif secara langsung.', 'warna' => 'emerald', 'ikon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>'],
                ['nama_devisi' => 'Pubdekdok', 'deskripsi' => 'Divisi Publikasi, Dekorasi & Dokumentasi. Menjadi ujung tombak penyebaran informasi, mengelola media sosial, dan mendokumentasikan setiap momen penting kegiatan GenBI.', 'warna' => 'purple', 'ikon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>'],
                ['nama_devisi' => 'Kewirausahaan', 'deskripsi' => 'Menumbuhkan jiwa entrepreneurship anggota. Menggagas ide bisnis kreatif, pencarian dana mandiri (Danus), dan mendorong kemandirian finansial organisasi.', 'warna' => 'orange', 'ikon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08-.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>'],
                ['nama_devisi' => 'Lingkungan Hidup', 'deskripsi' => 'Bergerak di bidang pelestarian alam. Menginisiasi program penghijauan, kampanye sadar sampah, dan menanamkan kepedulian lingkungan kepada anggota maupun masyarakat sekitar.', 'warna' => 'teal', 'ikon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>'],
            ];
            Devisi::insert($defaultDevisi);
            $daftarDevisi = Devisi::all();
        }

        $kategoriPoins = KategoriPoin::all();

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
            'tampilkanPopup',
            'daftarDevisi',
            'kategoriPoins'
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

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true]);
        }

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

        if ($request->has('kategori_custom')) {
            foreach ($request->kategori_custom as $id => $aturan) {
                $kp = \App\Models\KategoriPoin::find($id);
                if ($kp) {
                    $kp->aturan = $aturan;
                    $kp->save();
                }
            }
        }

        return redirect()->back()->with('open_poin_modal', true);
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

    public function storeDevisi(Request $request)
    {
        $request->validate([
            'nama_devisi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'warna' => 'required|string',
        ]);
        Devisi::create($request->all());
        return redirect()->back()->with('success', 'Divisi baru berhasil ditambahkan!');
    }

    public function updateDevisi(Request $request, $id)
    {
        $request->validate([
            'nama_devisi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'warna' => 'required|string',
        ]);
        $devisi = Devisi::findOrFail($id);
        $devisi->update($request->all());
        return redirect()->back()->with('success', 'Data divisi berhasil diperbarui!');
    }

    public function destroyDevisi($id)
    {
        Devisi::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Divisi berhasil dihapus!');
    }

    public function storeKategoriPoin(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'aturan' => 'nullable|string',
        ]);
        KategoriPoin::create($request->all());
        return redirect()->back()->with('open_info_poin_modal', true)->with('success', 'Kategori poin baru berhasil ditambahkan!');
    }

    public function updateKategoriPoin(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'aturan' => 'nullable|string',
        ]);
        $kategori = KategoriPoin::findOrFail($id);
        $kategori->update($request->all());
        return redirect()->back()->with('open_info_poin_modal', true)->with('success', 'Data kategori poin berhasil diperbarui!');
    }

    public function destroyKategoriPoin(Request $request, $id)
    {
        KategoriPoin::findOrFail($id)->delete();
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Kategori berhasil dihapus.']);
        }
        return redirect()->back()->with('open_info_poin_modal', true)->with('success', 'Kategori poin berhasil dihapus!');
    }
}
