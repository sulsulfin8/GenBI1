<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required'
        ]);

        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        $credentials = [
            $loginType => $request->login,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Username (Nama/Email) atau Password salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function showForgotForm()
    {
        return view('login.forgot');
    }

    public function processForgot(Request $request)
    {
        $request->validate([
            'tipe' => 'required|in:pengurus,anggota',
        ]);

        if ($request->tipe === 'pengurus') {
            // --- LOGIKA PENGURUS (Bisa ganti sandi mandiri via Email) ---
            $request->validate([
                'login' => 'required|email',
                'password' => 'required|min:6'
            ]);

            $user = User::where('email', $request->login)->first();

            if (!$user) {
                return back()->with('error', 'Akun Pengurus dengan email tersebut tidak ditemukan!');
            }
            if ($user->role === 'anggota') {
                return back()->with('error', 'Akun ini terdaftar sebagai Anggota, silakan pilih tipe akun Anggota!');
            }

            // Ubah password langsung
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('login')->with('success', 'Kata sandi berhasil diperbarui! Silakan login.');
        } else {
            // --- LOGIKA ANGGOTA (Hanya mengirim permintaan ke Admin) ---
            $request->validate([
                'login' => 'required|string',
                'nim' => 'required|string',
            ]);

            // Cocokkan Nama dan NIM
            $user = User::where('name', $request->login)
                ->where('nim', $request->nim)
                ->first();

            if (!$user) {
                return back()->with('error', 'Data tidak ditemukan! Pastikan Nama dan NIM sesuai dengan profil Anda.');
            }
            if ($user->role !== 'anggota') {
                return back()->with('error', 'Akun ini terdaftar sebagai Pengurus, silakan pilih tipe akun Pengurus!');
            }

            // Tandai akun ini sedang meminta reset password (notifikasi ke admin)
            $user->request_reset = true;
            $user->save();

            return redirect()->route('login')->with('success', 'Permintaan terkirim! Silakan hubungi Admin/Sekretaris untuk mendapatkan sandi baru.');
        }
    }
}
