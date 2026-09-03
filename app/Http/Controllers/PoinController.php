<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Poin;
use App\Models\Absensi;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class PoinController extends Controller
{
    public function index(Request $request)
    {
        // 1. PEMBERSIHAN DATABASE: Hanya hapus poin milik akun yang benar-benar tidak relevan (seperti pembina)
        $validRoles = ['anggota', 'admin', 'sekretaris', 'bendahara'];
        $validNims = User::whereIn('role', $validRoles)->pluck('nim')->filter()->toArray();
        Poin::whereNotIn('nim', $validNims)->delete();

        // ==========================================
        // 2. LOGIKA PENCARIAN (SEARCH)
        // ==========================================
        $search = $request->input('search');
        $query = User::query();

        // Ambil user sesuai hak akses
        if (auth()->user()->role == 'anggota') {
            $query->where('id', auth()->user()->id);
        } else {
            // Admin, Sekretaris, Bendahara akan melihat semua orang termasuk diri mereka sendiri
            $query->whereIn('role', $validRoles);
        }

        // Jika ada input pencarian, filter berdasarkan nama atau NIM
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('nim', 'like', '%' . $search . '%');
            });
        }

        // Eksekusi query
        if (auth()->user()->role == 'anggota') {
            $users = $query->get();
        } else {
            $users = $query->get()->unique('nim');
        }
        // ==========================================

        // ==========================================
        // Mengambil aturan poin dari database (tabel infos)
        $info = \App\Models\Info::first();
        if (!$info) {
            $info = (object) [
                'pelanggaran' => "Alpa: +10 Poin\nIzin: +1 Poin",
                'apresiasi' => "Rajin: -3 Poin\nAktif: -2 Poin",
                'qris' => "",
                'sp' => ""
            ];
        }

        $rekapData = [];
        $kegiatanAktif = Kegiatan::pluck('nama_kegiatan');
        $sp1Min = 25;
        $sp2Min = 50;
        $sp3Min = 100;

        if ($info && !empty($info->sp)) {
            $spLines = explode("\n", str_replace("\r", "", $info->sp));
            foreach ($spLines as $line) {
                if (trim($line) != '') {
                    $parts = explode(':', $line);
                    if (count($parts) == 2) {
                        $label = strtolower(trim($parts[0]));
                        $valStr = $parts[1];
                        preg_match_all('/\d+/', $valStr, $matches);
                        if (!empty($matches[0])) {
                            $min = min(array_map('intval', $matches[0]));
                            if (strpos($valStr, '>') !== false) {
                                $min += 1;
                            }
                            
                            if (preg_match('/sp\s*1/i', $label)) $sp1Min = $min;
                            elseif (preg_match('/sp\s*2/i', $label)) $sp2Min = $min;
                            elseif (preg_match('/sp\s*3/i', $label)) $sp3Min = $min;
                        }
                    }
                }
            }
        }

        // Pastikan logika SP masuk akal, kalau error input kembali ke default
        if ($sp1Min >= $sp2Min || $sp2Min >= $sp3Min) {
            $sp1Min = 25;
            $sp2Min = 50;
            $sp3Min = 100;
        }

        foreach ($users as $user) {
            if (empty($user->nim)) continue;

            $alpa = Absensi::where('nim', $user->nim)->whereIn('kegiatan', $kegiatanAktif)->where('status', 'A')->distinct('kegiatan')->count('kegiatan');
            $izin = Absensi::where('nim', $user->nim)->whereIn('kegiatan', $kegiatanAktif)->where('status', 'I')->distinct('kegiatan')->count('kegiatan');
            $poinAbsensi = ($alpa * 10) + ($izin * 1);

            $poinRecord = Poin::firstOrCreate(
                ['nim' => $user->nim],
                ['nama_lengkap' => $user->name, 'jurusan' => $user->jurusan ?? '-', 'total_poin' => '0', 'sp' => 'Aman', 'keterangan' => '-']
            );

            $poinManual = (int)$poinRecord->total_poin;
            $grandTotal = max(0, $poinAbsensi + $poinManual);

            $sp = 'Aman';
            if ($grandTotal >= $sp3Min) {
                $sp = 'SP 3';
            } elseif ($grandTotal >= $sp2Min) {
                $sp = 'SP 2';
            } elseif ($grandTotal >= $sp1Min) {
                $sp = 'SP 1';
            }
            
            $poinRecord->update(['sp' => $sp]);

            $teksManual = ($poinRecord->keterangan && $poinRecord->keterangan != '-') ? $poinRecord->keterangan : "";

            $teksManualBersih = preg_replace('/Absensi.*?(?=\||$)/i', '', $teksManual);
            $teksManualBersih = preg_replace('/Alpa:\s*\d+\s*kali/i', '', $teksManualBersih);
            $teksManualBersih = preg_replace('/Izin:\s*\d+\s*kali/i', '', $teksManualBersih);
            $teksManualBersih = preg_replace('/(Kegiatan Lain\s*:\s*)+/i', '', $teksManualBersih);
            $teksManualBersih = trim(str_replace(['||', ' | '], '|', $teksManualBersih), " -|");

            // ==============================================================
            // PERBAIKAN: Logika menyembunyikan Absensi jika 0 Alpa & 0 Izin
            // ==============================================================
            $ketAbsensi = [];
            if ($alpa > 0) $ketAbsensi[] = "Alpa: $alpa kali";
            if ($izin > 0) $ketAbsensi[] = "Izin: $izin kali";

            $keteranganAkhir = "";
            if (!empty($ketAbsensi)) {
                $keteranganAkhir = "Absensi (" . implode(', ', $ketAbsensi) . ")";
            }

            if (!empty($teksManualBersih)) {
                $separator = !empty($keteranganAkhir) ? " | " : "";
                $keteranganAkhir .= $separator . "Kegiatan Lain: " . $teksManualBersih;
            }

            // Jika sama sekali tidak ada catatan absensi & kegiatan lain, berikan tanda strip (-)
            if (empty($keteranganAkhir)) {
                $keteranganAkhir = "-";
            }
            // ==============================================================

            // Label Jabatan Khusus
            $jabatanTampil = 'Anggota';
            if ($user->role == 'admin') $jabatanTampil = 'Ketua Umum';
            elseif ($user->role == 'sekretaris') $jabatanTampil = 'Sekretaris Umum';
            elseif ($user->role == 'bendahara') $jabatanTampil = 'Bendahara Umum';

            $rekapData[] = (object)[
                'nim' => $user->nim,
                'nama' => $user->name,
                'jurusan' => $user->jurusan,
                'role' => $user->role, // Kirim role
                'jabatan' => $jabatanTampil, // Kirim nama jabatan
                'poin_absensi' => $poinAbsensi,
                'poin_manual' => $poinManual,
                'total_poin' => $grandTotal,
                'sp' => $sp,
                'keterangan' => $keteranganAkhir,
                'keterangan_asli' => $poinRecord->keterangan ?? '-'
            ];
        }

        $kategoriPoins = \App\Models\KategoriPoin::all();
        return view('poin.index', compact('rekapData', 'info', 'kategoriPoins'));
    }

    public function updatePoin(Request $request)
    {
        $request->validate(['nim' => 'required', 'nilai_poin' => 'required|numeric', 'keterangan' => 'required|string']);
        $poinRecord = Poin::where('nim', $request->nim)->first();

        if ($poinRecord) {
            $newPoin = (int)$poinRecord->total_poin + (int)$request->nilai_poin;
            $ketLama = $poinRecord->keterangan;
            $finalKet = ($ketLama == '-' || $ketLama == '') ? $request->keterangan : $ketLama . ' | ' . $request->keterangan;

            $poinRecord->update(['total_poin' => (string)$newPoin, 'keterangan' => $finalKet]);
            DB::table('notifikasis')->insert([
                'nim' => $request->nim,
                'pesan' => "Ada pembaruan pada Poin Keaktifan / SP Anda. Keterangan: " . $request->keterangan,
                'jenis' => 'warning',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        return redirect()->back()->with('success', 'Poin kegiatan berhasil diperbarui!');
    }

    public function editKeterangan(Request $request)
    {
        $request->validate(['nim' => 'required', 'keterangan' => 'required|string']);
        $poinRecord = Poin::where('nim', $request->nim)->first();
        if ($poinRecord) {
            $poinRecord->update(['keterangan' => $request->keterangan]);
            DB::table('notifikasis')->insert([
                'nim' => $request->nim,
                'pesan' => "Admin memperbarui detail riwayat poin Anda.",
                'jenis' => 'info',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        return redirect()->back()->with('success', 'Teks keterangan berhasil diperbarui!');
    }
    // Fungsi untuk membatalkan pemberian poin tambahan/manual
    // Fungsi untuk membatalkan pemberian poin tambahan/manual
    // Fungsi untuk membatalkan salah satu item poin pilihan admin/sekretaris
    public function batalPoin(Request $request, $id)
    {
        // Mencari data poin berdasarkan ID atau NIM
        $poin = \App\Models\Poin::where('id', $id)->orWhere('nim', $id)->firstOrFail();

        // Ambil index keberapa yang mau dihapus
        $itemIndex = $request->input('item_index');

        if ($itemIndex !== null && !empty($poin->keterangan) && $poin->keterangan !== '-') {
            $splitKet = explode('|', $poin->keterangan);

            // Hapus item pada index terpilih
            if (isset($splitKet[$itemIndex])) {
                unset($splitKet[$itemIndex]);
            }

            // Satukan kembali sisa-sisa item keterangan yang ada
            $sisaKet = array_filter(array_map('trim', $splitKet));
            if (empty($sisaKet)) {
                $poin->keterangan = '-';
            } else {
                $poin->keterangan = implode(' | ', $sisaKet);
            }
        } else {
            $poin->keterangan = '-';
        }

        // --- PROSES REKALKULASI OTOMATIS (SMART PARSER KEMBALI BALIK LAYAR) ---
        $totalPelanggaranManual = 0;
        $totalApresiasiManual = 0;

        if ($poin->keterangan && $poin->keterangan !== '-') {
            if (preg_match_all('/([+-])\s*(\d+)/', $poin->keterangan, $matches)) {
                for ($i = 0; $i < count($matches[0]); $i++) {
                    $sign = $matches[1][$i];
                    $val = (int) $matches[2][$i];
                    if ($sign == '+') {
                        $totalPelanggaranManual += $val;
                    } else {
                        $totalApresiasiManual += $val;
                    }
                }
            }
        }

        // Hitung total poin baru = Poin Absensi + Poin Pelanggaran - Poin Apresiasi
        $poin->total_poin = $poin->poin_absensi + $totalPelanggaranManual - $totalApresiasiManual;

        // Ambil threshold SP dari info
        $info = \App\Models\Info::first();
        $sp1Threshold = 25;
        $sp2Threshold = 50;

        if ($info && !empty($info->sp)) {
            $spLines = explode("\n", str_replace("\r", "", $info->sp));
            foreach ($spLines as $line) {
                if (trim($line) != '') {
                    $parts = explode(':', $line);
                    if (count($parts) == 2) {
                        $label = strtolower(trim($parts[0]));
                        preg_match('/\d+/', $parts[1], $matches);
                        $val = isset($matches[0]) ? (int)$matches[0] : null;
                        if ($val !== null) {
                            if (preg_match('/sp\s*1/i', $label)) $sp1Threshold = $val;
                            elseif (preg_match('/sp\s*2/i', $label)) $sp2Threshold = $val;
                        }
                    }
                }
            }
        }

        // Pastikan logika SP masuk akal, kalau error input kembali ke default
        if ($sp1Threshold >= $sp2Threshold || $sp2Threshold == 0) {
            $sp1Threshold = 25;
            $sp2Threshold = 50;
        }

        // Hitung ulang status ambang batas Surat Peringatan (SP)
        if ($poin->total_poin > $sp2Threshold) {
            $poin->sp = 'SP 3';
        } elseif ($poin->total_poin > $sp1Threshold && $poin->total_poin <= $sp2Threshold) {
            $poin->sp = 'SP 2';
        } elseif ($poin->total_poin == $sp1Threshold) {
            $poin->sp = 'SP 1';
        } else {
            $poin->sp = 'Aman';
        }

        $poin->save();

        // KUNCI PERBAIKAN: Jika permintaan datang dari AJAX (JavaScript), balas dengan JSON tanpa me-reload halaman
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'new_keterangan' => $poin->keterangan
            ]);
        }

        // Jika normal, jalankan ini
        return redirect()->back()->with([
            'success' => 'Berhasil! Item poin pilihan Anda telah dibatalkan.',
            'open_modal_batal_nim' => $poin->nim
        ]);
    }
}
