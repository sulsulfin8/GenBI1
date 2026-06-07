<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kegiatan;
use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        // 1. Pembersihan otomatis jika ada kegiatan yang sudah dihapus
        $kegiatans = Kegiatan::latest()->get();
        $namaKegiatans = $kegiatans->pluck('nama_kegiatan')->toArray();
        Absensi::whereNotIn('kegiatan', $namaKegiatans)->delete();

        // Mengambil daftar kegiatan yang sudah diabsen (dibersihkan dari emoji)
        $sudahAbsenRaw = Absensi::distinct()->pluck('kegiatan')->toArray();
        $sudahAbsen = array_map(function ($item) {
            return trim(str_replace(['✅', '🔴'], '', $item));
        }, $sudahAbsenRaw);

        $query = User::whereIn('role', ['admin', 'sekretaris', 'bendahara', 'anggota'])->latest();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('nim', 'like', '%' . $search . '%');
            });
        }
        $users = $query->get();
        $sudahAbsenRaw = Absensi::distinct()->pluck('kegiatan')->toArray();

        // =======================================================
        // PERBAIKAN: PENARIKAN DATA ABSENSI DARI DATABASE
        // =======================================================
        $absensiRecord = collect();
        // Mengubah 'kegiatan' menjadi 'kegiatan_id' agar cocok dengan View
        if ($request->has('kegiatan_id') && $request->kegiatan_id != '') {
            $kegTerpilih = Kegiatan::find($request->kegiatan_id);
            if ($kegTerpilih) {
                // Tarik data H, I, S, A milik kegiatan ini dan kelompokkan berdasarkan NIM
                $absensiRecord = Absensi::where('kegiatan', $kegTerpilih->nama_kegiatan)
                    ->get()
                    ->keyBy('nim');
            }
        }

        return view('absensi.index', compact('users', 'kegiatans', 'sudahAbsen', 'absensiRecord'));
    }

    public function store(Request $request)
    {
        // PERBAIKAN: Menyesuaikan validasi dengan nama input di View ('kegiatan_nama')
        $request->validate([
            'absensi' => 'required|array',
            'absensi.*.status' => 'required|in:H,A,I,S',
            'absensi.*.kegiatan_nama' => 'required|string',
        ]);

        $kegiatanNama = collect($request->absensi)->first()['kegiatan_nama'] ?? '';

        if (!empty($kegiatanNama)) {
            foreach ($request->absensi as $userId => $data) {
                $user = User::find($userId);
                if ($user) {

                    // Menyesuaikan devisi untuk Pengurus Inti
                    $devisiFinal = $user->devisi;
                    if ($user->role == 'admin') $devisiFinal = 'Ketua Umum';
                    elseif ($user->role == 'sekretaris') $devisiFinal = 'Sekretaris Umum';
                    elseif ($user->role == 'bendahara') $devisiFinal = 'Bendahara Umum';

                    Absensi::updateOrCreate(
                        [
                            'nim'      => $user->nim,
                            'kegiatan' => $kegiatanNama,
                        ],
                        [
                            'nama_lengkap' => $user->name,
                            'jurusan'      => $user->jurusan ?? '-',
                            'devisi'       => $devisiFinal,
                            'status'       => $data['status'],
                        ]
                    );
                }
            }
        }

        return redirect()->back()->with('success', 'Data absensi berhasil disimpan!');
    }
}
