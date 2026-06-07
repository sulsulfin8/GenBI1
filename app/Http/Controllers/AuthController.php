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

        // Hapus pengecekan filter email, langsung paksa sistem 
        // mencocokkan inputan dengan kolom 'email' (tempat username disimpan)
        $credentials = [
            'email' => $request->login,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Username/Email atau Password salah!');
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
        // TAHAP 1: MINTA OTP (Berlaku untuk semua pengguna sistem)
        if ($request->input('action') === 'send_otp') {
            $request->validate(['login' => 'required']);

            // Mencari user berdasarkan email/username yang didaftarkan
            $user = User::where('email', $request->login)->first();

            if (!$user) return back()->with('error', 'Alamat Email / Username tidak ditemukan!');

            // Generate 6 digit OTP acak
            $otp = rand(100000, 999999);
            $user->otp = $otp;
            $user->otp_expires_at = now()->addMinutes(10); // Berlaku selama 10 menit
            $user->save();

            // Proses Pengiriman Email
            try {
                \Illuminate\Support\Facades\Mail::raw("Halo {$user->name},\n\nKode OTP reset kata sandi Anda adalah: {$otp}\n\nKode ini berlaku selama 10 menit. Jangan berikan kode ini kepada siapapun.", function ($message) use ($user) {
                    $message->to($user->email)->subject('Kode OTP Reset Sandi GenBI');
                });
            } catch (\Exception $e) {
                return back()->with('error', 'Gagal mengirim email. Pastikan koneksi internet & pengaturan SMTP .env sudah benar!');
            }

            return back()->with([
                'success' => 'Kode OTP berhasil dikirim! Silakan cek Kotak Masuk atau folder Spam email Anda.',
                'step' => 'otp',
                'email' => $user->email
            ]);
        }

        // TAHAP 2: VERIFIKASI OTP & JALANKAN RESET SANDI
        elseif ($request->input('action') === 'reset') {
            $request->validate([
                'login' => 'required',
                'otp' => 'required|numeric',
                'password' => 'required|min:6'
            ]);

            $user = User::where('email', $request->login)->first();

            // Cek validasi kecocokan OTP dan masa kedaluwarsa
            if (!$user || $user->otp != $request->otp || now()->greaterThan($user->otp_expires_at)) {
                return back()->with([
                    'error' => 'Kode OTP salah atau sudah kedaluwarsa!',
                    'step' => 'otp',
                    'email' => $request->login
                ]);
            }

            // Simpan Password Baru
            $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
            $user->otp = null;
            $user->otp_expires_at = null;
            $user->save();

            return redirect()->route('login')->with('success', 'Berhasil! Kata sandi baru Anda telah aktif. Silakan login.');
        }

        return back()->with('error', 'Aksi tidak valid.');
    }
}
