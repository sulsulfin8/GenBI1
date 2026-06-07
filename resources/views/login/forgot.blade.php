<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Sandi - Sistem Informasi GenBI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-blue': '#2563eb',
                        'primary-dark': '#1e40af',
                        'bg-main': '#f8fafc',
                    },
                    animation: {
                        'fade-in': 'fadeIn 1s ease-out forwards',
                        'slide-up': 'slideUp 0.8s ease-out forwards',
                        'blob': 'blob 7s infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': {
                                opacity: '0'
                            },
                            '100%': {
                                opacity: '1'
                            }
                        },
                        slideUp: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(20px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            }
                        },
                        blob: {
                            '0%': {
                                transform: 'translate(0px, 0px) scale(1)'
                            },
                            '33%': {
                                transform: 'translate(30px, -50px) scale(1.1)'
                            },
                            '66%': {
                                transform: 'translate(-20px, 20px) scale(0.9)'
                            },
                            '100%': {
                                transform: 'translate(0px, 0px) scale(1)'
                            },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>

<body class="bg-bg-main font-sans min-h-screen flex overflow-hidden">

    <div
        class="hidden lg:flex lg:w-1/2 relative bg-gradient-to-br from-primary-blue to-primary-dark items-center justify-center overflow-hidden">
        <div
            class="absolute top-0 -left-4 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-2xl opacity-50 animate-blob">
        </div>
        <div
            class="absolute top-0 -right-4 w-72 h-72 bg-cyan-400 rounded-full mix-blend-multiply filter blur-2xl opacity-50 animate-blob animation-delay-2000">
        </div>
        <div
            class="absolute -bottom-8 left-20 w-72 h-72 bg-blue-400 rounded-full mix-blend-multiply filter blur-2xl opacity-50 animate-blob animation-delay-4000">
        </div>

        <div class="relative z-10 text-center text-white px-12 animate-fade-in">
            <div
                class="w-40 h-40 mx-auto mb-8 p-4 bg-white/10 rounded-[2rem] backdrop-blur-md border border-white/20 shadow-2xl transform hover:scale-105 transition duration-500">
                <img src="{{ asset('logo_kiri.png') }}" alt="Logo GenBI"
                    class="w-full h-full object-contain filter drop-shadow-md">
            </div>
            <h1 class="text-4xl font-extrabold tracking-tight mb-4">Sistem Informasi Manajemen GenBI</h1>
            <p class="text-lg text-blue-100 font-light max-w-md mx-auto leading-relaxed">
                Sistem keamanan ganda kami mengirimkan kode unik (OTP) ke email Anda untuk memastikan validitas
                kepemilikan akun.
            </p>
            <div class="mt-10 flex justify-center gap-3">
                <span class="w-3 h-1.5 bg-white/40 rounded-full"></span>
                <span class="w-10 h-1.5 bg-white rounded-full opacity-100 shadow-glow"></span>
                <span class="w-3 h-1.5 bg-white/40 rounded-full"></span>
            </div>
        </div>
    </div>

    <div
        class="w-full lg:w-1/2 h-screen flex flex-col bg-white relative animate-slide-up shadow-[-10px_0_30px_rgba(0,0,0,0.05)] z-20 overflow-y-auto">
        <div class="absolute inset-0 z-0 opacity-[0.02]"
            style="background-image: radial-gradient(#2563eb 1.5px, transparent 1.5px); background-size: 24px 24px;">
        </div>

        <div class="w-full max-w-md mx-auto p-8 sm:p-12 py-10 lg:py-16 relative z-10">

            <a href="{{ route('login') }}"
                class="inline-flex items-center gap-2 text-sm font-bold text-gray-400 hover:text-primary-blue transition-colors mb-8 group">
                <div
                    class="bg-gray-50 p-2.5 rounded-xl group-hover:bg-blue-50 transition-colors border border-gray-100 group-hover:border-blue-100">
                    <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </div>
                Kembali ke Login
            </a>

            <div class="mb-10 relative">
                <div class="absolute left-0 top-5 transform -translate-y-1/2 w-full h-1.5 bg-gray-100 rounded-full z-0">
                </div>
                <div class="absolute left-0 top-5 transform -translate-y-1/2 h-1.5 bg-primary-blue rounded-full z-0 transition-all duration-700 ease-in-out"
                    style="width: {{ session('step') == 'otp' ? '50%' : '0%' }}"></div>

                <div class="relative z-10 flex justify-between items-center">
                    <div class="flex flex-col items-center">
                        <div
                            class="w-10 h-10 rounded-full flex items-center justify-center font-extrabold text-sm shadow-md transition-all duration-500 
                            {{ session('step') == 'otp' ? 'bg-primary-blue text-white' : 'bg-primary-blue text-white ring-4 ring-blue-100 scale-110' }}">
                            @if (session('step') == 'otp')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            @else
                                1
                            @endif
                        </div>
                        <span
                            class="text-[11px] sm:text-xs font-bold mt-2.5 text-primary-blue text-center">Identifikasi</span>
                    </div>

                    <div class="flex flex-col items-center">
                        <div
                            class="w-10 h-10 rounded-full flex items-center justify-center font-extrabold text-sm shadow-sm transition-all duration-500 
                            {{ session('step') == 'otp' ? 'bg-primary-blue text-white ring-4 ring-blue-100 scale-110 shadow-md' : 'bg-white border-2 border-gray-200 text-gray-400' }}">
                            2
                        </div>
                        <span
                            class="text-[9px] sm:text-xs font-bold mt-2.5 text-center {{ session('step') == 'otp' ? 'text-primary-blue' : 'text-gray-400' }}">Verifikasi
                            OTP</span>
                    </div>

                    <div class="flex flex-col items-center">
                        <div
                            class="w-10 h-10 rounded-full bg-white border-2 border-gray-200 flex items-center justify-center font-extrabold text-sm text-gray-400 shadow-sm transition-all duration-500">
                            3
                        </div>
                        <span class="text-[11px] sm:text-xs font-bold mt-2.5 text-center text-gray-400">Selesai</span>
                    </div>
                </div>
            </div>

            @if (session('error'))
                <div
                    class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-xl text-sm font-bold flex items-start gap-3 shadow-sm">
                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif
            @if (session('success'))
                <div
                    class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 rounded-r-xl text-sm font-bold flex items-start gap-3 shadow-sm">
                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                        </path>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if (session('step') == 'otp')
                <div class="mb-8">
                    <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Verifikasi OTP
                        <p class="text-gray-500 mt-2 text-sm font-medium">Masukkan 6 digit angka yang telah kami
                            kirimkan ke
                            email Anda.</p>
                </div>

                <form action="{{ route('password.reset') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="action" value="reset">
                    <input type="hidden" name="login" value="{{ session('email') }}">
                    <input type="hidden" name="otp" id="real-otp-input" required>

                    <div class="px-4 py-3 bg-blue-50/50 border border-blue-100 rounded-xl flex items-center gap-3">
                        <div class="p-1.5 bg-white rounded-lg shadow-sm border border-blue-50">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <p class="text-xs font-bold text-gray-600 uppercase tracking-widest">
                            Tujuan: <span class="text-blue-600 ml-1 lowercase">{{ session('email') }}</span>
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Kode Keamanan</label>
                        <div class="flex justify-between gap-2 sm:gap-3" id="otp-container">
                            <input type="number" maxlength="1"
                                class="otp-box w-12 h-14 sm:w-14 sm:h-16 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-primary-blue focus:ring-4 focus:ring-blue-500/20 focus:bg-white text-center text-2xl font-black text-gray-800 transition-all outline-none"
                                autofocus>
                            <input type="number" maxlength="1"
                                class="otp-box w-12 h-14 sm:w-14 sm:h-16 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-primary-blue focus:ring-4 focus:ring-blue-500/20 focus:bg-white text-center text-2xl font-black text-gray-800 transition-all outline-none">
                            <input type="number" maxlength="1"
                                class="otp-box w-12 h-14 sm:w-14 sm:h-16 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-primary-blue focus:ring-4 focus:ring-blue-500/20 focus:bg-white text-center text-2xl font-black text-gray-800 transition-all outline-none">
                            <input type="number" maxlength="1"
                                class="otp-box w-12 h-14 sm:w-14 sm:h-16 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-primary-blue focus:ring-4 focus:ring-blue-500/20 focus:bg-white text-center text-2xl font-black text-gray-800 transition-all outline-none">
                            <input type="number" maxlength="1"
                                class="otp-box w-12 h-14 sm:w-14 sm:h-16 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-primary-blue focus:ring-4 focus:ring-blue-500/20 focus:bg-white text-center text-2xl font-black text-gray-800 transition-all outline-none">
                            <input type="number" maxlength="1"
                                class="otp-box w-12 h-14 sm:w-14 sm:h-16 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-primary-blue focus:ring-4 focus:ring-blue-500/20 focus:bg-white text-center text-2xl font-black text-gray-800 transition-all outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Sandi Baru</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-primary-blue transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                            </div>
                            <input type="password" name="password" required
                                placeholder="Buat sandi yang kuat (Min. 6 Karakter)"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3.5 pl-11 pr-4 focus:outline-none focus:border-primary-blue focus:ring-4 focus:ring-primary-blue/15 text-sm transition-all duration-300 font-semibold text-gray-800 focus:bg-white placeholder-gray-400">
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-600 to-primary-blue hover:from-blue-700 hover:to-blue-600 text-white rounded-xl py-4 font-bold text-sm tracking-wide shadow-lg shadow-blue-500/30 transition-all duration-300 transform hover:-translate-y-0.5 mt-2">
                        Validasi & Selesai
                    </button>
                </form>
            @else
                <div class="mb-8">
                    <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Lupa Sandi?
                        <p class="text-gray-500 mt-2 text-sm font-medium">Masukkan alamat email Anda yang
                            terdaftar untuk memulihkan akses.</p>
                </div>

                <form action="{{ route('password.reset') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="action" value="send_otp">

                    <div>
                        <label id="label-login" class="block text-sm font-bold text-gray-700 mb-2">Email
                            Terdaftar</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <svg id="icon-login"
                                    class="w-5 h-5 text-gray-400 group-focus-within:text-primary-blue transition-colors duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <input type="text" id="input-login" name="login" required
                                placeholder="Masukkan email Anda..."
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3.5 pl-11 pr-4 focus:outline-none focus:border-primary-blue focus:ring-4 focus:ring-primary-blue/15 text-sm transition-all duration-300 font-medium text-gray-800 focus:bg-white placeholder-gray-400">
                        </div>
                    </div>

                    <button id="btn-submit" type="submit"
                        class="w-full bg-primary-blue hover:bg-primary-dark text-white rounded-xl py-4 font-bold text-sm tracking-wide shadow-lg shadow-blue-500/30 transition-all duration-300 transform hover:-translate-y-0.5 mt-2 flex justify-center items-center gap-2">
                        <span id="btn-text">Minta Kode OTP Sekarang</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </button>
                </form>
            @endif

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const otpInputs = document.querySelectorAll('.otp-box');
            const realOtpInput = document.getElementById('real-otp-input');

            if (otpInputs.length > 0) {
                otpInputs.forEach((input, index) => {
                    input.addEventListener('input', (e) => {
                        if (e.target.value.length > 1) e.target.value = e.target.value.slice(0, 1);
                        if (e.target.value.length === 1 && index < otpInputs.length - 1) otpInputs[
                            index + 1].focus();
                        updateRealOtp();
                    });
                    input.addEventListener('keydown', (e) => {
                        if (e.key === 'Backspace' && !e.target.value && index > 0) otpInputs[index -
                            1].focus();
                    });
                    input.addEventListener('paste', (e) => {
                        e.preventDefault();
                        const pastedData = e.clipboardData.getData('text').slice(0, 6);
                        if (/^\d+$/.test(pastedData)) {
                            for (let i = 0; i < pastedData.length; i++)
                                if (otpInputs[i]) otpInputs[i].value = pastedData[i];
                            if (pastedData.length < 6) otpInputs[pastedData.length].focus();
                            else otpInputs[5].focus();
                            updateRealOtp();
                        }
                    });
                });

                function updateRealOtp() {
                    realOtpInput.value = Array.from(otpInputs).map(i => i.value).join('');
                }
            }
        });
    </script>
</body>

</html>
