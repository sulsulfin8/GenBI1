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
                $htmlContent = "
                <div style='font-family: \"Segoe UI\", Tahoma, Geneva, Verdana, sans-serif; max-width: 600px; margin: 0 auto; background-color: #f8fafc; padding: 30px; border-radius: 12px;'>
                    <div style='text-align: center; margin-bottom: 25px;'>
                        <h2 style='color: #1e40af; margin: 0; font-weight: 800; font-size: 24px;'>SIM GenBI</h2>
                    </div>
                    
                    <div style='background-color: #ffffff; padding: 40px; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-top: 5px solid #3b82f6;'>
                        <p style='font-size: 16px; color: #374151; margin-top: 0;'>Halo, <strong>{$user->name}</strong>,</p>
                        <p style='font-size: 15px; color: #4b5563; line-height: 1.6;'>Kami menerima permintaan untuk mereset kata sandi akun Anda. Gunakan kode keamanan (OTP) di bawah ini untuk melanjutkan proses tersebut:</p>
                        
                        <div style='text-align: center; margin: 35px 0;'>
                            <span style='display: inline-block; font-size: 36px; font-weight: 900; letter-spacing: 8px; color: #1d4ed8; background-color: #eff6ff; padding: 15px 35px; border-radius: 12px; border: 2px dashed #93c5fd;'>
                                {$otp}
                            </span>
                        </div>
                        
                        <div style='background-color: #fef2f2; border-left: 4px solid #ef4444; padding: 12px 15px; border-radius: 4px; margin-bottom: 20px;'>
                            <p style='font-size: 14px; color: #b91c1c; margin: 0; font-weight: 600;'>
                                Perhatian: Kode ini hanya berlaku selama 10 Menit.
                            </p>
                        </div>
                        
                        <p style='font-size: 14px; color: #6b7280; line-height: 1.5; margin-bottom: 0;'>Demi keamanan akun Anda, <strong>jangan pernah membagikan kode OTP ini</strong> kepada siapa pun, termasuk pihak yang mengatasnamakan pengurus/admin GenBI.</p>
                    </div>
                    
                    <div style='text-align: center; margin-top: 25px;'>
                        <p style='font-size: 12px; color: #9ca3af; line-height: 1.5; margin: 0;'>
                            &copy; " . date('Y') . " Sistem Informasi Manajemen GenBI USN Kolaka.
                        </p>
                    </div>
                </div>
                ";

                \Illuminate\Support\Facades\Mail::html($htmlContent, function ($message) use ($user) {
                    $message->to($user->email)->subject(' Kode OTP Reset Kata Sandi Anda');
                });
            } catch (\Exception $e) {
                return back()->with('error', 'Gagal mengirim email. Pastikan email yang anda masukkan sudah benar!');
            }

            return back()->with([
                'success' => 'Kode OTP berhasil dikirim! Silakan cek email Anda.',
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
