<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\User;
use App\Models\Poin;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL; // <-- Tambahan untuk URL terenkripsi

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $jenis = $request->jenis ?? 'Rancang Anggaran';
        $search = $request->search;
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $laporans = collect();

        if ($jenis == 'Rancang Anggaran') {
            $query = Kegiatan::has('anggarans')->latest();
            if ($search) $query->where('devisi', 'like', "%{$search}%")->orWhere('nama_kegiatan', 'like', "%{$search}%");
            if ($bulan) $query->whereMonth('tanggal', $bulan);
            if ($tahun) $query->whereYear('tanggal', $tahun);

            $kegiatans = $query->get()->groupBy('devisi');
            foreach ($kegiatans as $devisi => $kegs) {
                $laporans->push((object)[
                    'id_devisi' => $devisi,
                    'judul_laporan' => 'RAB Keseluruhan - ' . $devisi,
                    'jenis_laporan' => 'Rancang Anggaran',
                    'devisi' => $devisi,
                    'tanggal_laporan' => ($bulan && $tahun) ? "Bulan $bulan Tahun $tahun" : now()->format('Y-m-d'),
                ]);
            }
        } else if ($jenis == 'Absensi') {
            $kegiatanBerabsen = Absensi::select('kegiatan')->distinct()->pluck('kegiatan');
            $query = Kegiatan::whereIn('nama_kegiatan', $kegiatanBerabsen)->latest();
            if ($search) $query->where('nama_kegiatan', 'like', "%{$search}%");
            if ($bulan) $query->whereMonth('tanggal', $bulan);
            if ($tahun) $query->whereYear('tanggal', $tahun);

            $kegiatans = $query->get()->unique('nama_kegiatan');
            foreach ($kegiatans as $keg) {
                $laporans->push((object)[
                    'id' => $keg->id,
                    'judul_laporan' => 'Laporan Absensi - ' . $keg->nama_kegiatan,
                    'devisi' => $keg->devisi,
                    'jenis_laporan' => 'Absensi',
                    'tanggal_laporan' => $keg->tanggal,
                ]);
            }
        } else if ($jenis == 'Poin Keaktifan') {
            $queryKeg = Kegiatan::query();
            if ($bulan) $queryKeg->whereMonth('tanggal', $bulan);
            if ($tahun) $queryKeg->whereYear('tanggal', $tahun);

            if ($queryKeg->count() > 0) {
                $laporans->push((object)[
                    'id' => 1,
                    'judul_laporan' => 'Rekapitulasi Poin Keaktifan & SP Anggota',
                    'devisi' => 'Semua Devisi',
                    'jenis_laporan' => 'Poin Keaktifan',
                    'tanggal_laporan' => ($bulan && $tahun) ? "Periode: Bulan $bulan Tahun $tahun" : now()->format('Y-m-d'),
                ]);
            }
        }

        return view('laporan.index', compact('laporans', 'jenis', 'search', 'bulan', 'tahun'));
    }

    private function getLogos()
    {
        $logoL = "";
        $logoR = "";
        if (file_exists(public_path('logo_kiri.png'))) $logoL = 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('logo_kiri.png')));
        if (file_exists(public_path('logo_kanan.png'))) $logoR = 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('logo_kanan.png')));
        return [$logoL, $logoR];
    }

    private function generateQrCode($url)
    {
        \SimpleSoftwareIO\QrCode\Facades\QrCode::format('png');
        return base64_encode(QrCode::size(200)->generate($url));
    }

    public function cetakWord(Request $request, $devisi)
    {
        $namaDevisi = urldecode($devisi);
        $kegiatans = Kegiatan::with('anggarans')->where('devisi', $namaDevisi)->has('anggarans')->get();
        if ($kegiatans->isEmpty()) return back()->with('error', 'Data tidak ditemukan.');

        list($logoL, $logoR) = $this->getLogos();

        // PERBAIKAN: Generate URL Terenkripsi untuk QR Code
        $urlVerifikasi = URL::signedRoute('verifikasi.dokumen', [
            'jenis' => 'anggaran',
            'devisi' => $namaDevisi
        ]);
        $qrCodeBase64 = $this->generateQrCode($urlVerifikasi);

        $kop = (object)[
            'baris1' => 'GENERASI BARU INDONESIA (GenBI)',
            'baris2' => 'PROVINSI SULAWESI TENGGARA',
            'baris3' => 'KOMISARIAT USN KOLAKA',
            'alamat' => 'Sekretariat Usn: Jl. Pemuda, Tahoa, Kec Kolaka, Kab Kolaka, Sulawesi Tenggara.',
            'kontak' => 'No. Hp: 082228576830 Email: genbisultra@gmail.com',
        ];

        if ($request->has('download')) {
            $headers = ["Content-type" => "application/vnd.ms-word", "Content-Disposition" => "attachment;Filename=Laporan_RAB.doc"];
            return response()->view('laporan.word', compact('kegiatans', 'namaDevisi', 'kop', 'logoL', 'logoR', 'qrCodeBase64'))->withHeaders($headers);
        }

        $pdf = Pdf::loadView('laporan.word', compact('kegiatans', 'namaDevisi', 'kop', 'logoL', 'logoR', 'qrCodeBase64'));
        return $pdf->setPaper('A4', 'portrait')->stream();
    }

    public function cetakAbsensi(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->absensis = Absensi::where('kegiatan', $kegiatan->nama_kegiatan)->get()->unique('nim');

        list($logoL, $logoR) = $this->getLogos();

        // PERBAIKAN: Generate URL Terenkripsi untuk QR Code
        $urlVerifikasi = URL::signedRoute('verifikasi.dokumen', [
            'jenis' => 'absensi',
            'id' => $kegiatan->id
        ]);
        $qrCodeBase64 = $this->generateQrCode($urlVerifikasi);

        $kop = (object)[
            'baris1' => 'GENERASI BARU INDONESIA (GenBI)',
            'baris2' => 'PROVINSI SULAWESI TENGGARA',
            'baris3' => 'KOMISARIAT USN KOLAKA',
            'alamat' => 'Sekretariat Usn: Jl. Pemuda, Tahoa, Kec Kolaka, Kab Kolaka, Sulawesi Tenggara.',
            'kontak' => 'No. Hp: 082228576830 Email: genbisultra@gmail.com',
        ];

        if ($request->has('download')) {
            $headers = ["Content-type" => "application/vnd.ms-word", "Content-Disposition" => "attachment;Filename=Laporan_Absensi.doc"];
            return response()->view('laporan.word_absensi', compact('kegiatan', 'kop', 'logoL', 'logoR', 'qrCodeBase64'))->withHeaders($headers);
        }

        $pdf = Pdf::loadView('laporan.word_absensi', compact('kegiatan', 'kop', 'logoL', 'logoR', 'qrCodeBase64'));
        return $pdf->setPaper('A4', 'portrait')->stream();
    }

    public function cetakPoin(Request $request)
    {
        $users = \App\Models\User::whereIn('role', ['admin', 'sekretaris', 'bendahara', 'anggota'])->get()->unique('nim');
        $rekapData = [];

        $queryKegiatan = \App\Models\Kegiatan::query();
        if ($request->bulan) $queryKegiatan->whereMonth('tanggal', $request->bulan);
        if ($request->tahun) $queryKegiatan->whereYear('tanggal', $request->tahun);
        $kegiatanAktif = $queryKegiatan->pluck('nama_kegiatan');

        foreach ($users as $user) {
            if (empty($user->nim)) continue;

            $alpa = \App\Models\Absensi::where('nim', $user->nim)->whereIn('kegiatan', $kegiatanAktif)->where('status', 'A')->count('kegiatan');
            $izin = \App\Models\Absensi::where('nim', $user->nim)->whereIn('kegiatan', $kegiatanAktif)->where('status', 'I')->count('kegiatan');

            $poinRecord = \App\Models\Poin::where('nim', $user->nim)->first();
            $poinManual = $poinRecord ? (int)$poinRecord->total_poin : 0;
            $poinAbsensi = ($alpa * 10) + ($izin * 1);
            $grandTotal = $poinAbsensi + $poinManual;

            $ketAbsensi = [];
            if ($alpa > 0) $ketAbsensi[] = "Alpa $alpa";
            if ($izin > 0) $ketAbsensi[] = "Izin $izin";
            $stringKeterangan = empty($ketAbsensi) ? "-" : "Absensi: " . implode(', ', $ketAbsensi);

            $rekapData[] = (object)[
                'nim'          => $user->nim,
                'nama'         => $user->name,
                'jurusan'      => $user->jurusan,
                'poin_absensi' => $poinAbsensi,
                'poin_manual'  => $poinManual,
                'total_poin'   => max(0, $grandTotal),
                'sp'           => $grandTotal >= 100 ? 'SP 3' : ($grandTotal >= 50 ? 'SP 2' : ($grandTotal >= 25 ? 'SP 1' : 'Aman')),
                'keterangan'   => $stringKeterangan
            ];
        }

        list($logoL, $logoR) = $this->getLogos();

        // PERBAIKAN: Generate URL Terenkripsi untuk QR Code
        $urlVerifikasi = URL::signedRoute('verifikasi.dokumen', [
            'jenis' => 'poin',
            'bulan' => $request->bulan,
            'tahun' => $request->tahun
        ]);
        $qrCodeBase64 = $this->generateQrCode($urlVerifikasi);

        $kop = (object)[
            'baris1' => 'GENERASI BARU INDONESIA (GenBI)',
            'baris2' => 'PROVINSI SULAWESI TENGGARA',
            'baris3' => 'KOMISARIAT USN KOLAKA',
            'alamat' => 'Sekretariat Usn: Jl. Pemuda, Tahoa, Kec Kolaka, Kab Kolaka, Sulawesi Tenggara.',
            'kontak' => 'No. Hp: 082228576830 Email: genbisultra@gmail.com',
        ];

        $pdf = Pdf::loadView('laporan.pdf_poin', compact('rekapData', 'kop', 'logoL', 'logoR', 'qrCodeBase64'));
        return $pdf->setPaper('letter', 'portrait')->stream();
    }

    // =========================================================================
    // FUNGSI BARU: Untuk membaca QR Code dan menampilkan dokumen asli di HP
    // =========================================================================
    public function verifikasiDokumen(Request $request)
    {
        // 1. Cek apakah tanda tangan enkripsi valid (Mencegah pemalsuan QR)
        if (! $request->hasValidSignature()) {
            abort(403, 'Peringatan: QR Code Tidak Valid atau Telah Dipalsukan!');
        }

        // 2. Jika valid, render langsung dokumen aslinya ke browser HP penguji
        $jenis = $request->jenis;
        if ($jenis == 'anggaran') {
            return $this->cetakWord($request, $request->devisi);
        } elseif ($jenis == 'absensi') {
            return $this->cetakAbsensi($request, $request->id);
        } elseif ($jenis == 'poin') {
            return $this->cetakPoin($request);
        }

        abort(404, 'Dokumen tidak ditemukan.');
    }
}
