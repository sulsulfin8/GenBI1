<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User; // Tambahan: Memanggil model User

class ProfileController extends Controller
{
    public function index()
    {
        return view('profil.index');
    }

    public function update(Request $request)
    {
        // Memberikan petunjuk ke VS Code bahwa $user adalah Model User kita
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nim' => 'nullable|string',
            'jurusan' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // Maksimal 5MB
        ]);

        $data = $request->only(['name', 'email', 'nim', 'jurusan']);

        // Logika untuk mengganti password (jika diisi)
        if ($request->filled('password')) {
            $request->validate(['password' => 'min:6']);
            $data['password'] = Hash::make($request->password);
        }

        // Logika untuk mengunggah foto
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }
            // Simpan foto baru ke folder storage/app/public/profiles
            $data['photo'] = $request->file('photo')->store('profiles', 'public');
        }

        // Garis merah di bawah ini sekarang pasti sudah hilang!
        $user->update($data);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}
