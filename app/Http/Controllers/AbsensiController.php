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
        $kegiatans = Kegiatan::latest()->get();
        $namaKegiatans = $kegiatans->pluck('nama_kegiatan')->toArray();
        Absensi::whereNotIn('kegiatan', $namaKegiatans)->delete();

        $sudahAbsen = Absensi::distinct()->pluck('kegiatan')->toArray();

        $query = User::whereIn('role', ['admin', 'sekretaris', 'bendahara', 'anggota'])->latest();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('nim', 'like', '%' . $search . '%');
            });
        }

        $perPage = $request->input('per_page', 10);
        $users = $query->paginate($perPage);

        $absensiRecord = collect();
        if ($request->has('kegiatan') && $request->kegiatan != '') {
            $absensiRecord = Absensi::where('kegiatan', $request->kegiatan)
                ->get()
                ->keyBy('nim');
        }

        return view('absensi.index', compact('users', 'kegiatans', 'sudahAbsen', 'absensiRecord'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'absensi' => 'required|array',
            'absensi.*.status' => 'required|in:H,A,I,S',
            'absensi.*.kegiatan' => 'required',
        ]);

        $kegiatan = collect($request->absensi)->first()['kegiatan'] ?? '';

        if (!empty($kegiatan)) {
            foreach ($request->absensi as $userId => $data) {
                $user = User::find($userId);
                if ($user) {
                    Absensi::updateOrCreate(
                        [
                            'nim' => $user->nim,
                            'kegiatan' => $kegiatan,
                        ],
                        [
                            'nama_lengkap' => $user->name,
                            'jurusan' => $user->jurusan,
                            'devisi' => $user->devisi,
                            'status' => $data['status'],
                        ]
                    );
                }
            }
        }

        return redirect()->back()->with('success', 'Data absensi berhasil disimpan!');
    }
}
