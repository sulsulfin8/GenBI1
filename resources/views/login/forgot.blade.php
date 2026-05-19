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

            <h1 class="text-4xl font-extrabold tracking-tight mb-4">Pemulihan Akun</h1>
            <p class="text-lg text-blue-100 font-light max-w-md mx-auto leading-relaxed">
                Sistem keamanan ganda kami memastikan hanya Anda yang dapat mengatur ulang kata sandi akun GenBI Anda.
            </p>

            <div class="mt-10 flex justify-center gap-3">
                <span class="w-3 h-1.5 bg-white/40 rounded-full"></span>
                <span class="w-10 h-1.5 bg-white rounded-full opacity-100 shadow-glow"></span>
                <span class="w-3 h-1.5 bg-white/40 rounded-full"></span>
            </div>
        </div>
    </div>

    <div
        class="w-full lg:w-1/2 flex items-center justify-center bg-white relative animate-slide-up shadow-[-10px_0_30px_rgba(0,0,0,0.05)] z-20 overflow-y-auto">

        <div class="absolute inset-0 z-0 opacity-[0.02]"
            style="background-image: radial-gradient(#2563eb 1.5px, transparent 1.5px); background-size: 24px 24px;">
        </div>

        <div class="w-full max-w-md p-8 sm:p-12 relative z-10 my-auto">

            <a href="{{ route('login') }}"
                class="inline-flex items-center gap-2 text-sm font-bold text-gray-400 hover:text-primary-blue transition-colors mb-8 group">
                <div class="bg-gray-50 p-2 rounded-xl group-hover:bg-blue-50 transition-colors">
                    <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </div>
                Kembali ke Login
            </a>

            <div class="mb-8">
                <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Lupa Sandi? <span
                        class="inline-block ml-1">🔐</span></h2>
                <p class="text-gray-500 mt-2 text-sm font-medium">Pilih tipe akun dan masukkan data yang sesuai untuk
                    membuat sandi baru.</p>
            </div>

            @if (session('error'))
                <div
                    class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-xl text-sm font-bold flex items-start gap-3 shadow-sm">
                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif
            @if ($errors->any())
                <div
                    class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-xl text-sm font-bold flex flex-col gap-1 shadow-sm">
                    @foreach ($errors->all() as $error)
                        <div class="flex items-center gap-2">
                            <div class="w-1.5 h-1.5 rounded-full bg-red-500"></div> {{ $error }}
                        </div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('password.reset') }}" method="POST" class="space-y-5">
                @csrf

                <div class="flex p-1.5 bg-gray-100 rounded-2xl mb-6">
                    <label class="flex-1 text-center cursor-pointer relative">
                        <input type="radio" name="tipe" value="pengurus" checked class="peer sr-only"
                            onchange="toggleForm()">
                        <div
                            class="py-2.5 rounded-xl text-sm font-bold text-gray-500 peer-checked:bg-white peer-checked:text-primary-blue peer-checked:shadow-sm transition-all duration-300">
                            Pengurus
                        </div>
                    </label>
                    <label class="flex-1 text-center cursor-pointer relative">
                        <input type="radio" name="tipe" value="anggota" class="peer sr-only"
                            onchange="toggleForm()">
                        <div
                            class="py-2.5 rounded-xl text-sm font-bold text-gray-500 peer-checked:bg-white peer-checked:text-primary-blue peer-checked:shadow-sm transition-all duration-300">
                            Anggota
                        </div>
                    </label>
                </div>

                <div>
                    <label id="label-login" class="block text-sm font-bold text-gray-700 mb-1.5">Email Terdaftar</label>
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
                        <input type="email" id="input-login" name="login" required
                            placeholder="Masukkan email Anda..."
                            class="w-full bg-gray-50 border border-gray-200 rounded-2xl py-3.5 pl-11 pr-4 focus:outline-none focus:border-primary-blue focus:ring-4 focus:ring-primary-blue/15 text-sm transition-all duration-300 font-semibold text-gray-800 focus:bg-white placeholder-gray-400">
                    </div>
                </div>

                <div id="form-anggota" class="hidden space-y-5 pt-4">
                    <div class="flex items-start gap-3 p-3 bg-orange-50 border border-orange-100 rounded-xl">
                        <svg class="w-5 h-5 text-orange-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                        <p class="text-xs font-semibold text-orange-800 leading-relaxed">
                            Validasi Keamanan Ganda: Masukkan NIM dan Jurusan sesuai dengan profil terdaftar Anda.
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1.5">NIM</label>
                            <input type="text" id="input-nim" name="nim" placeholder="22123..."
                                class="w-full bg-gray-50 border border-gray-200 rounded-2xl py-3.5 px-4 focus:outline-none focus:border-primary-blue focus:ring-4 focus:ring-primary-blue/15 text-sm transition-all duration-300 font-semibold text-gray-800 focus:bg-white placeholder-gray-400">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1.5">Jurusan</label>
                            <input type="text" id="input-jurusan" name="jurusan" placeholder="Sistem Info..."
                                class="w-full bg-gray-50 border border-gray-200 rounded-2xl py-3.5 px-4 focus:outline-none focus:border-primary-blue focus:ring-4 focus:ring-primary-blue/15 text-sm transition-all duration-300 font-semibold text-gray-800 focus:bg-white placeholder-gray-400">
                        </div>
                    </div>
                </div>

                <div class="pt-2">
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Sandi Baru</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400 group-focus-within:text-primary-blue transition-colors duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                                </path>
                            </svg>
                        </div>
                        <input type="password" name="password" required placeholder="Minimal 6 karakter"
                            class="w-full bg-gray-50 border border-gray-200 rounded-2xl py-3.5 pl-11 pr-4 focus:outline-none focus:border-primary-blue focus:ring-4 focus:ring-primary-blue/15 text-sm transition-all duration-300 font-semibold text-gray-800 focus:bg-white placeholder-gray-400">
                    </div>
                </div>

                <button type="submit"
                    class="w-full relative overflow-hidden group bg-primary-blue hover:bg-primary-dark text-white rounded-2xl py-4 font-bold text-sm tracking-wide shadow-xl shadow-blue-500/30 transition-all duration-300 transform hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-blue-500/50 mt-4">
                    <span class="relative z-10 flex items-center justify-center gap-2">
                        Simpan Sandi Baru
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </span>
                </button>
            </form>

        </div>
    </div>

    <script>
        function toggleForm() {
            const tipe = document.querySelector('input[name="tipe"]:checked').value;
            const formAnggota = document.getElementById('form-anggota');
            const inputLogin = document.getElementById('input-login');
            const labelLogin = document.getElementById('label-login');
            const iconLogin = document.getElementById('icon-login');

            if (tipe === 'pengurus') {
                formAnggota.classList.add('hidden');

                labelLogin.innerText = "Email Terdaftar";
                inputLogin.placeholder = "Masukkan email Anda...";
                inputLogin.type = "email";

                // Icon Mail
                iconLogin.innerHTML =
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>';

                document.getElementById('input-nim').required = false;
                document.getElementById('input-jurusan').required = false;
            } else {
                formAnggota.classList.remove('hidden');

                labelLogin.innerText = "Nama Lengkap Terdaftar";
                inputLogin.placeholder = "Masukkan nama lengkap...";
                inputLogin.type = "text";

                // Icon User
                iconLogin.innerHTML =
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>';

                document.getElementById('input-nim').required = true;
                document.getElementById('input-jurusan').required = true;
            }
        }
    </script>
</body>

</html>
