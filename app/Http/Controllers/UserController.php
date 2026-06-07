<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::latest();
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('nim', 'like', '%' . $search . '%');
            });
        }
        $perPage = $request->input('per_page', 10);
        $users = $query->paginate($perPage);

        return view('user.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,anggota,sekretaris,bendahara,pembina',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi foto dikembalikan
        ]);

        // Logika Upload Foto
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }

        User::create([
            'name' => $request->name,
            'nim' => $request->nim,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'jurusan' => $request->jurusan,
            'devisi' => $request->devisi,
            'jabatan' => $request->jabatan, // <-- Simpan Jabatan untuk Struktur Organisasi
            'photo' => $photoPath, // <-- Simpan Foto
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email,' . $id,
            'role' => 'required|in:admin,anggota,sekretaris,bendahara,pembina',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi foto dikembalikan
        ]);

        $user = User::findOrFail($id);

        $dataToUpdate = [
            'name' => $request->name,
            'nim' => $request->nim,
            'email' => $request->email,
            'role' => $request->role,
            'jurusan' => $request->jurusan,
            'devisi' => $request->devisi,
            'jabatan' => $request->jabatan, // <-- Update Jabatan untuk Struktur Organisasi
        ];

        // Jika password diisi, maka update password
        if ($request->filled('password')) {
            $dataToUpdate['password'] = Hash::make($request->password);
        }

        // Logika Update Foto
        if ($request->hasFile('photo')) {
            // Hapus foto lama dari folder storage
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }
            // Upload foto baru
            $dataToUpdate['photo'] = $request->file('photo')->store('photos', 'public');
        }

        // ==============================================================
        // KUNCI PERBAIKAN: Jika user ini sedang meminta reset sandi, 
        // matikan tanda merahnya otomatis saat Admin menekan tombol simpan
        // ==============================================================
        if ($user->request_reset) {
            $dataToUpdate['request_reset'] = false;
        }

        $user->update($dataToUpdate);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Hapus foto profil dari penyimpanan saat user dihapus
        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }

        // Pembersihan Total (Cascade Delete) agar tidak ada data hantu di Absensi & Poin
        if (!empty($user->nim)) {
            \App\Models\Absensi::where('nim', $user->nim)->delete();
            \App\Models\Poin::where('nim', $user->nim)->delete();
            if (\Illuminate\Support\Facades\Schema::hasTable('notifikasis')) {
                \Illuminate\Support\Facades\DB::table('notifikasis')->where('nim', $user->nim)->delete();
            }
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'Anggota beserta seluruh datanya berhasil dihapus!');
    }
}
