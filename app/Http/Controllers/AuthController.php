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
            'login' => 'required|string',
            'password' => 'required|min:6'
        ]);

        if ($request->tipe === 'pengurus') {
            if (!filter_var($request->login, FILTER_VALIDATE_EMAIL)) {
                return back()->with('error', 'Pengurus wajib menggunakan format Email yang benar!');
            }

            $user = User::where('email', $request->login)->first();

            if (!$user) {
                return back()->with('error', 'Akun Pengurus dengan email tersebut tidak ditemukan!');
            }
            if ($user->role === 'anggota') {
                return back()->with('error', 'Akun ini terdaftar sebagai Anggota, silakan pilih tipe akun Anggota!');
            }
        } else {
            $request->validate([
                'nim' => 'required|string',
                'jurusan' => 'required|string',
            ], [
                'nim.required' => 'NIM wajib diisi untuk validasi keamanan Anggota!',
                'jurusan.required' => 'Jurusan wajib diisi untuk validasi keamanan Anggota!',
            ]);

            $user = User::where('name', $request->login)
                ->where('nim', $request->nim)
                ->where('jurusan', $request->jurusan)
                ->first();

            if (!$user) {
                return back()->with('error', 'Data tidak cocok! Pastikan Nama, NIM, dan Jurusan persis dengan data yang terdaftar.');
            }
            if ($user->role !== 'anggota') {
                return back()->with('error', 'Akun ini terdaftar sebagai Pengurus, silakan pilih tipe akun Pengurus!');
            }
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('success', 'Kata sandi berhasil diperbarui! Silakan login dengan sandi baru.');
    }
}
