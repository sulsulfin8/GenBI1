<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\User;
use App\Models\Poin;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $jenis = $request->jenis ?? 'Rancang Anggaran';
        $search = $request->search;
        $laporans = collect();

        if ($jenis == 'Rancang Anggaran') {
            $query = Kegiatan::has('anggarans')->latest();

            if ($search) {
                $query->where('devisi', 'like', "%{$search}%")
                    ->orWhere('nama_kegiatan', 'like', "%{$search}%");
            }

            $kegiatans = $query->get()->groupBy('devisi');

            foreach ($kegiatans as $devisi => $kegs) {
                $laporans->push((object)[
                    'id_devisi' => $devisi,
                    'judul_laporan' => 'RAB Keseluruhan - ' . $devisi,
                    'jenis_laporan' => 'Rancang Anggaran',
                    'devisi' => $devisi,
                    'tanggal_laporan' => now()->format('Y-m-d'),
                ]);
            }
        } else if ($jenis == 'Absensi') {
            // Tarik nama, lalu bersihkan dari emoji sebelum dicocokkan
            $kegiatanBerabsenRaw = Absensi::select('kegiatan')->distinct()->pluck('kegiatan')->toArray();
            $kegiatanBerabsen = array_map(function ($item) {
                return trim(str_replace(['✅', '🔴'], '', $item));
            }, $kegiatanBerabsenRaw);

            $query = Kegiatan::whereIn('nama_kegiatan', $kegiatanBerabsen)->latest();

            if ($search) {
                $query->where('nama_kegiatan', 'like', "%{$search}%");
            }

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
            // Cek apakah masih ada kegiatan yang terdaftar
            $jumlahKegiatan = Kegiatan::count();

            if ($jumlahKegiatan > 0) {
                $laporans->push((object)[
                    'id' => 1,
                    'judul_laporan' => 'Rekapitulasi Poin Keaktifan & SP Anggota',
                    'devisi' => 'Semua Devisi',
                    'jenis_laporan' => 'Poin Keaktifan',
                    'tanggal_laporan' => now()->format('Y-m-d'),
                ]);
            }
        }

        return view('laporan.index', compact('laporans', 'jenis', 'search'));
    }

    private function getLogos()
    {
        $logoL = "";
        $logoR = "";

        if (file_exists(public_path('logo_kiri.png'))) {
            $logoL = 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('logo_kiri.png')));
        }
        if (file_exists(public_path('logo_kanan.png'))) {
            $logoR = 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('logo_kanan.png')));
        }

        return [$logoL, $logoR];
    }

    // ==========================================
    // FUNGSI UNTUK RANCANG ANGGARAN (RAB) - WORD & PREVIEW
    // ==========================================
    public function cetakWord(Request $request, $devisi)
    {
        $namaDevisi = urldecode($devisi);
        $kegiatans = Kegiatan::with('anggarans')->where('devisi', $namaDevisi)->has('anggarans')->get();

        if ($kegiatans->isEmpty()) return back()->with('error', 'Data laporan tidak ditemukan.');

        list($logoL, $logoR) = $this->getLogos();
        $fileName = "Laporan_RAB_" . str_replace([' ', '&'], '_', $namaDevisi) . ".doc";

        $kop = (object)[
            'baris1' => 'GENERASI BARU INDONESIA (GenBI)',
            'baris2' => 'PROVINSI SULAWESI TENGGARA',
            'baris3' => 'KOMISARIAT USN KOLAKA',
            'alamat' => 'Sekretariat Usn: Jl. Pemuda, Tahoa, Kec Kolaka, Kab Kolaka, Sulawesi Tenggara.',
            'kontak' => 'No. Hp: 082228576830 Email: genbisultra@gmail.com',
        ];

        if ($request->has('download')) {
            $headers = ["Content-type" => "application/vnd.ms-word", "Content-Disposition" => "attachment;Filename=$fileName"];
            return response()->view('laporan.word', compact('kegiatans', 'namaDevisi', 'kop', 'logoL', 'logoR'))->withHeaders($headers);
        }

        $pdf = Pdf::loadView('laporan.word', compact('kegiatans', 'namaDevisi', 'kop', 'logoL', 'logoR'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('Preview_' . str_replace('.doc', '.pdf', $fileName));
    }

    // ==========================================
    // FUNGSI UNTUK ABSENSI - WORD & PREVIEW
    // ==========================================
    public function cetakAbsensi(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->absensis = Absensi::where('kegiatan', 'like', '%' . $kegiatan->nama_kegiatan . '%')->get()->unique('nim');
        list($logoL, $logoR) = $this->getLogos();

        $kop = (object)[
            'baris1' => 'GENERASI BARU INDONESIA (GenBI)',
            'baris2' => 'PROVINSI SULAWESI TENGGARA',
            'baris3' => 'KOMISARIAT USN KOLAKA',
            'alamat' => 'Sekretariat Usn: Jl. Pemuda, Tahoa, Kec Kolaka, Kab Kolaka, Sulawesi Tenggara.',
            'kontak' => 'No. Hp: 082228576830 Email: genbisultra@gmail.com',
        ];

        $fileName = "Laporan_Absensi_" . str_replace(' ', '_', $kegiatan->nama_kegiatan) . ".doc";

        if ($request->has('download')) {
            $headers = ["Content-type" => "application/vnd.ms-word", "Content-Disposition" => "attachment;Filename=$fileName"];
            return response()->view('laporan.word_absensi', compact('kegiatan', 'kop', 'logoL', 'logoR'))->withHeaders($headers);
        }

        $pdf = Pdf::loadView('laporan.word_absensi', compact('kegiatan', 'kop', 'logoL', 'logoR'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('Preview_' . str_replace('.doc', '.pdf', $fileName));
    }

    // ==========================================
    // FUNGSI UNTUK POIN KEAKTIFAN - PDF
    // ==========================================
    public function cetakPoin(Request $request)
    {
        // PERBAIKAN UTAMA: Ambil SEMUA role agar total data menjadi 55 (termasuk admin, sekretaris, bendahara)
        $users = \App\Models\User::whereIn('role', ['admin', 'sekretaris', 'bendahara', 'anggota'])
            ->get()
            ->unique('nim');

        $rekapData = [];
        $kegiatanAktif = \App\Models\Kegiatan::pluck('nama_kegiatan');

        foreach ($users as $user) {
            if (empty($user->nim)) continue;

            $alpa = \App\Models\Absensi::where('nim', $user->nim)
                ->whereIn('kegiatan', $kegiatanAktif)
                ->where('status', 'A')
                ->distinct('kegiatan')
                ->count('kegiatan');

            $izin = \App\Models\Absensi::where('nim', $user->nim)
                ->whereIn('kegiatan', $kegiatanAktif)
                ->where('status', 'I')
                ->distinct('kegiatan')
                ->count('kegiatan');

            $poinAbsensi = ($alpa * 10) + ($izin * 1);

            $poinRecord = \App\Models\Poin::where('nim', $user->nim)->first();
            $poinManual = $poinRecord ? (int)$poinRecord->total_poin : 0;
            $grandTotal = $poinAbsensi + $poinManual;

            if ($grandTotal < 0) $grandTotal = 0;

            $sp = 'Aman';
            if ($grandTotal >= 25 && $grandTotal < 50) $sp = 'SP 1';
            elseif ($grandTotal >= 50 && $grandTotal <= 100) $sp = 'SP 2';
            elseif ($grandTotal > 100) $sp = 'SP 3';

            // Absensi dinamis
            $ketAbsensi = [];
            if ($alpa > 0) $ketAbsensi[] = "Alpa: $alpa kegiatan";
            if ($izin > 0) $ketAbsensi[] = "Izin: $izin kegiatan";
            $teksAbsensi = empty($ketAbsensi) ? "Hadir 100%" : implode(', ', $ketAbsensi);

            // Membersihkan keterangan manual
            $teksManual = ($poinRecord && $poinRecord->keterangan && $poinRecord->keterangan != '-') ? $poinRecord->keterangan : "";
            $teksManualBersih = preg_replace('/Absensi.*?(?=\||$)/i', '', $teksManual);
            $teksManualBersih = preg_replace('/(Kegiatan Lain\s*:\s*)+/i', '', $teksManualBersih);
            $teksManualBersih = trim(str_replace(['||', ' | '], '|', $teksManualBersih), " -|");

            $keteranganAkhir = "Absensi: " . $teksAbsensi;
            if (!empty($teksManualBersih)) {
                $keteranganAkhir .= " | Catatan: " . $teksManualBersih;
            }

            $rekapData[] = (object)[
                'nim'          => $user->nim,
                'nama'         => $user->name,
                'jurusan'      => $user->jurusan,
                'poin_absensi' => $poinAbsensi,
                'poin_manual'  => $poinManual,
                'total_poin'   => $grandTotal,
                'sp'           => $sp,
                'keterangan'   => $keteranganAkhir
            ];
        }

        list($logoL, $logoR) = $this->getLogos();

        $kop = (object)[
            'baris1' => 'GENERASI BARU INDONESIA (GenBI)',
            'baris2' => 'PROVINSI SULAWESI TENGGARA',
            'baris3' => 'KOMISARIAT USN KOLAKA',
            'alamat' => 'Sekretariat Usn: Jl. Pemuda, Tahoa, Kec Kolaka, Kab Kolaka, Sulawesi Tenggara.',
            'kontak' => 'No. Hp: 082228576830 Email: genbisultra@gmail.com',
        ];

        $pdf = Pdf::loadView('laporan.pdf_poin', compact('rekapData', 'kop', 'logoL', 'logoR'));
        $pdf->setPaper('letter', 'portrait');

        if ($request->has('download') && $request->download == 'pdf') {
            return $pdf->download('Laporan_Poin_Keaktifan_GenBI.pdf');
        }

        return $pdf->stream('Laporan_Poin_Keaktifan_GenBI.pdf');
    }
}
