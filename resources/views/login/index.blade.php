<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Informasi Manajemen GenBI</title>
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
        /* CSS Tambahan untuk jeda animasi agar terlihat alami */
        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
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
                class="w-40 h-40 mx-auto mb-8 p-5 bg-white rounded-[2rem] shadow-[0_15px_35px_rgba(0,0,0,0.2)] ring-4 ring-white/30 transform hover:scale-105 transition duration-500 flex items-center justify-center relative z-20">
                <img src="{{ asset('logo_kiri.png') }}" alt="Logo GenBI" class="w-full h-full object-contain">
            </div>

            <h1 class="text-4xl font-extrabold tracking-tight mb-4">Sistem Informasi GenBI</h1>
            <p class="text-lg text-blue-100 font-light max-w-md mx-auto leading-relaxed">
                Platform digital berbasis Web untuk mengelola kegiatan administrasi organisasi Generasi Baru Indonesia
                Komisariat USN Kolaka.
            </p>

            <div class="mt-10 flex justify-center gap-3">
                <span class="w-10 h-1.5 bg-white rounded-full opacity-100 shadow-glow"></span>
                <span class="w-3 h-1.5 bg-white/40 rounded-full"></span>
                <span class="w-3 h-1.5 bg-white/40 rounded-full"></span>
            </div>
        </div>
    </div>

    <div
        class="w-full lg:w-1/2 flex items-center justify-center bg-white relative animate-slide-up shadow-[-10px_0_30px_rgba(0,0,0,0.05)] z-20">

        <div class="absolute inset-0 z-0 opacity-[0.02]"
            style="background-image: radial-gradient(#2563eb 1.5px, transparent 1.5px); background-size: 24px 24px;">
        </div>

        <div class="w-full max-w-md p-8 sm:p-12 relative z-10">

            <div class="lg:hidden text-center mb-10">
                <img src="{{ asset('logo_kiri.png') }}" alt="Logo GenBI"
                    class="w-24 h-24 mx-auto object-contain mb-4 p-2 bg-gray-50 rounded-2xl border border-gray-100 shadow-sm">
                <h1 class="text-2xl font-extrabold text-gray-800">Sistem Informasi Manajemen GenBI</h1>
            </div>

            <div class="mb-10">
                <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Selamat Datang!
                    <p class="text-gray-500 mt-2 text-sm font-medium">Silakan masuk menggunakan akun Anda.</p>
            </div>

            @if (session('success'))
                <div
                    class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 rounded-r-xl text-sm font-bold flex items-center gap-3 shadow-sm">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div
                    class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-xl text-sm font-bold flex items-center gap-3 shadow-sm">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login.proses') }}" method="POST" class="space-y-6">
                @csrf

                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Username (Email / Nama)</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-primary-blue transition-colors duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <input type="text" name="login" required placeholder="Masukkan email atau nama"
                                class="w-full bg-gray-50 border border-gray-200 rounded-2xl py-3.5 pl-11 pr-4 focus:outline-none focus:border-primary-blue focus:ring-4 focus:ring-primary-blue/15 text-sm transition-all duration-300 font-semibold text-gray-800 focus:bg-white placeholder-gray-400">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Password</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-primary-blue transition-colors duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                            </div>

                            <input type="password" name="password" id="password" required placeholder="••••••••"
                                class="w-full bg-gray-50 border border-gray-200 rounded-2xl py-3.5 pl-11 pr-12 focus:outline-none focus:border-primary-blue focus:ring-4 focus:ring-primary-blue/15 text-sm transition-all duration-300 font-semibold text-gray-800 focus:bg-white placeholder-gray-400">

                            <button type="button" id="togglePassword"
                                class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-primary-blue focus:outline-none transition-colors duration-300">
                                <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-end">
                        <a href="{{ route('password.forgot') }}"
                            class="text-sm font-bold text-primary-blue hover:text-primary-dark transition-colors border-b-2 border-transparent hover:border-primary-blue pb-0.5">
                            Lupa Kata Sandi?
                        </a>
                    </div>

                    <button type="submit"
                        class="w-full relative overflow-hidden group bg-primary-blue hover:bg-primary-dark text-white rounded-2xl py-4 font-bold text-sm tracking-wide shadow-xl shadow-blue-500/30 transition-all duration-300 transform hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-blue-500/50">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            Login
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </span>
                    </button>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const passwordInput = document.getElementById('password');
            const togglePasswordButton = document.getElementById('togglePassword');
            const eyeIcon = document.getElementById('eyeIcon');

            if (togglePasswordButton && passwordInput) {
                togglePasswordButton.addEventListener('click', function() {
                    const isPassword = passwordInput.getAttribute('type') === 'password';

                    // Ubah tipe input
                    passwordInput.setAttribute('type', isPassword ? 'text' : 'password');

                    // Ubah Ikon Mata
                    if (isPassword) {
                        // Ikon Mata Dicoret
                        eyeIcon.innerHTML = `
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.024 10.024 0 014.12-5.835m3.23-1.166C10.524 4.14 11.251 4 12 4c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.828M9.758 9.758L14.242 14.242M9.88 9.88a3 3 0 104.24 4.24M3 3l18 18"></path>
                        `;
                    } else {
                        // Ikon Mata Normal
                        eyeIcon.innerHTML = `
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        `;
                    }
                });
            }
        });
    </script>

</body>

</html>
