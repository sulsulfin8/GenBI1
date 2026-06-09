<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM GenBI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-blue': '#2563eb', // Warna biru utama
                        'bg-main': '#f0f5ff', // Background utama konten (kebiruan)
                        'text-gray': '#a3aed1',
                        'success-green': '#00c48c'
                    },
                    boxShadow: {
                        'soft': '0 4px 20px 0 rgba(0,0,0,0.03)',
                        'blue-glow': '0 10px 15px -3px rgba(37, 99, 235, 0.3)'
                    }
                }
            }
        }
    </script>
    <style>
        /* Animasi transisi smooth untuk pergeseran */
        .sidebar-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* PERBAIKAN: Menggeser penuh ke kiri keluar dari layar agar tidak menyisakan space aneh */
        .sidebar-collapsed {
            margin-left: -16rem !important;
            /* Menggeser sejauh lebar sidebar (w-64 = 16rem) */
            opacity: 0;
            pointer-events: none;
            /* Mencegah menu diklik tidak sengaja saat tersembunyi */
        }

        /* Untuk scrollbar area utama */
        .main-content-scroll::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        .main-content-scroll::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .main-content-scroll::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .main-content-scroll::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>

<body class="bg-bg-main font-sans flex min-h-screen text-gray-800 overflow-hidden">

    <aside id="mainSidebar"
        class="w-64 min-w-[16rem] bg-gradient-to-b from-blue-700 via-blue-800 to-blue-900 flex flex-col justify-between z-10 shadow-[4px_0_24px_rgba(0,0,0,0.08)] sidebar-transition flex-shrink-0 border-r border-white/5 relative overflow-hidden">

        <!-- Ornamen Dekorasi Halus di Latar Belakang Sidebar -->
        <div
            class="absolute top-0 left-0 w-full h-64 bg-white opacity-5 rounded-full blur-3xl -translate-y-1/2 -translate-x-1/2 pointer-events-none">
        </div>

        <div class="overflow-y-auto overflow-x-hidden hide-scrollbar relative z-10 mt-2">
            <div class="p-8 text-2xl font-black flex items-center gap-3 text-white tracking-wide">
                <img src="{{ asset('logo_kiri.png') }}" alt="Logo GenBI"
                    class="w-11 h-11 bg-white/95 rounded-full p-1.5 shadow-md object-contain flex-shrink-0 border border-white/20">
                <span class="whitespace-nowrap drop-shadow-md">GenBI</span>
            </div>

            <div class="px-8 mb-4">
                <p class="text-[10px] text-blue-200/60 uppercase tracking-[0.25em] font-black">Menu Utama</p>
            </div>

            <nav class="space-y-1.5 flex flex-col px-4 pb-4">
                @php
                    $activeMenu =
                        'flex items-center px-4 py-3.5 bg-white text-blue-700 rounded-2xl shadow-lg shadow-black/10 font-extrabold transition-all duration-300 transform scale-[1.02] whitespace-nowrap border border-white/20';
                    $inactiveMenu =
                        'flex items-center px-4 py-3.5 text-blue-100/70 hover:bg-white/10 hover:text-white rounded-2xl transition-all duration-300 hover:translate-x-1.5 font-semibold whitespace-nowrap border border-transparent hover:border-white/5';
                @endphp

                <a href="{{ route('dashboard') }}"
                    class="{{ request()->routeIs('dashboard') ? $activeMenu : $inactiveMenu }}">
                    <svg class="w-5 h-5 mr-4 flex-shrink-0 transition-transform duration-300 group-hover:scale-110"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    Dashboard
                </a>

                @if (in_array(auth()->user()->role, ['admin', 'sekretaris']))
                    <a href="{{ route('users.index') }}"
                        class="{{ request()->routeIs('users.*') ? $activeMenu : $inactiveMenu }}">
                        <svg class="w-5 h-5 mr-4 flex-shrink-0 transition-transform duration-300 group-hover:scale-110"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                        Kelola User
                    </a>
                @endif

                @if (in_array(auth()->user()->role, ['admin', 'sekretaris', 'bendahara']))
                    <a href="{{ route('kegiatan') }}"
                        class="{{ request()->routeIs('kegiatan') ? $activeMenu : $inactiveMenu }}">
                        <svg class="w-5 h-5 mr-4 flex-shrink-0 transition-transform duration-300 group-hover:scale-110"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        Kegiatan
                    </a>
                @endif

                @if (in_array(auth()->user()->role, ['admin', 'sekretaris']))
                    <a href="{{ route('absensi') }}"
                        class="{{ request()->routeIs('absensi') ? $activeMenu : $inactiveMenu }}">
                        <svg class="w-5 h-5 mr-4 flex-shrink-0 transition-transform duration-300 group-hover:scale-110"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Absensi
                    </a>
                @endif

                @if (in_array(auth()->user()->role, ['admin', 'sekretaris', 'anggota']))
                    <a href="{{ route('poin') }}"
                        class="{{ request()->routeIs('poin') ? $activeMenu : $inactiveMenu }}">
                        <svg class="w-5 h-5 mr-4 flex-shrink-0 transition-transform duration-300 group-hover:scale-110"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        Poin Keaktifan
                    </a>
                @endif

                @if (in_array(auth()->user()->role, ['admin', 'bendahara']))
                    <a href="{{ route('anggaran') }}"
                        class="{{ request()->routeIs('anggaran') ? $activeMenu : $inactiveMenu }}">
                        <svg class="w-5 h-5 mr-4 flex-shrink-0 transition-transform duration-300 group-hover:scale-110"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        Rancangan Anggaran
                    </a>
                @endif

                @if (in_array(auth()->user()->role, ['admin', 'sekretaris', 'bendahara']))
                    <a href="{{ route('laporan') }}"
                        class="{{ request()->routeIs('laporan') ? $activeMenu : $inactiveMenu }}">
                        <svg class="w-5 h-5 mr-4 flex-shrink-0 transition-transform duration-300 group-hover:scale-110"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                            </path>
                        </svg>
                        Laporan
                    </a>
                @endif
            </nav>
        </div>

        <div class="p-4 mb-4 mt-auto relative z-10">
            <div class="h-px w-full bg-gradient-to-r from-transparent via-white/20 to-transparent mb-4"></div>
            <a href="{{ route('logout') }}"
                class="flex items-center px-4 py-3 text-red-200 bg-red-500/10 border border-red-500/20 hover:bg-red-500 hover:text-white hover:shadow-lg hover:shadow-red-500/30 rounded-2xl transition-all duration-300 font-bold whitespace-nowrap hover:translate-x-1">
                <svg class="w-5 h-5 mr-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                    </path>
                </svg>
                Logout
            </a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-hidden bg-bg-main relative sidebar-transition">
        <header
            class="bg-white/70 backdrop-blur-md px-6 md:px-10 py-3 flex items-center justify-between border-b border-white/50 shadow-sm sticky top-0 z-40 h-[72px] transition-all duration-300">

            <div class="flex items-center">
                <button id="sidebarToggleBtn"
                    class="p-2.5 rounded-xl text-gray-500 hover:bg-white hover:text-primary-blue hover:shadow-sm transition-all focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path id="toggleIconPath" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M4 6h16M4 12h16M4 18h7"></path>
                    </svg>
                </button>
            </div>

            <div class="flex items-center gap-4 md:gap-6">

                @if (auth()->user()->role == 'anggota')
                    @php
                        $nim = auth()->user()->nim ?? auth()->user()->username;
                        $notifikasis = [];
                        $unreadCount = 0;
                        if (\Illuminate\Support\Facades\Schema::hasTable('notifikasis')) {
                            $notifikasis = \Illuminate\Support\Facades\DB::table('notifikasis')
                                ->where('nim', $nim)
                                ->orderBy('created_at', 'desc')
                                ->take(15)
                                ->get();
                            $unreadCount = \Illuminate\Support\Facades\DB::table('notifikasis')
                                ->where('nim', $nim)
                                ->where('is_read', false)
                                ->count();
                        }
                    @endphp
                    <div class="relative group z-[100]">
                        <button
                            class="relative bg-white p-2.5 rounded-full shadow-sm text-gray-400 hover:text-primary-blue transition cursor-pointer">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                </path>
                            </svg>

                            @if ($unreadCount > 0)
                                <span class="absolute top-2 right-2 flex h-2.5 w-2.5">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                    <span
                                        class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500 border-2 border-white"></span>
                                </span>
                            @endif
                        </button>

                        <div
                            class="absolute right-0 mt-2 w-80 bg-white rounded-2xl shadow-[0_10px_40px_-10px_rgba(0,0,0,0.1)] border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top-right group-hover:scale-100 scale-95 overflow-hidden flex flex-col">

                            <div
                                class="p-4 border-b border-gray-50 flex justify-between items-center bg-gray-50/80 flex-shrink-0">
                                <h3 class="font-extrabold text-gray-800 text-sm">Notifikasi</h3>
                                @if ($unreadCount > 0)
                                    <form action="{{ route('notifikasi.read') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="text-[11px] text-primary-blue hover:text-blue-700 font-bold bg-blue-50 px-2 py-1 rounded-md transition">Tandai
                                            Dibaca</button>
                                    </form>
                                @endif
                            </div>

                            <div class="max-h-72 overflow-y-auto flex flex-col custom-scrollbar">
                                @forelse($notifikasis as $notif)
                                    <div
                                        class="p-4 border-b border-gray-50 flex gap-3 transition {{ $notif->is_read ? 'opacity-60 bg-white hover:bg-gray-50' : 'bg-blue-50/30 hover:bg-blue-50/50' }}">
                                        <div class="mt-1 flex-shrink-0">
                                            <div
                                                class="w-2.5 h-2.5 rounded-full {{ $notif->jenis == 'info' ? 'bg-blue-500' : 'bg-amber-500' }}">
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-xs text-gray-700 leading-relaxed font-semibold break-words">
                                                {{ $notif->pesan }}</p>
                                            <p
                                                class="text-[10px] font-bold text-gray-400 mt-1.5 uppercase tracking-wide">
                                                {{ \Carbon\Carbon::parse($notif->created_at)->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="p-8 text-center">
                                        <svg class="w-10 h-10 mx-auto text-gray-200 mb-3" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                            </path>
                                        </svg>
                                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Belum Ada
                                            Notifikasi</p>
                                    </div>
                                @endforelse
                            </div>

                            @if (count($notifikasis) > 0)
                                <div class="p-2 bg-gray-50 text-center border-t border-gray-100 flex-shrink-0">
                                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Scroll
                                        untuk melihat riwayat lama</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <a href="{{ route('profile') }}"
                    class="flex items-center gap-3 cursor-pointer hover:bg-gray-50/80 p-1.5 md:p-2 rounded-2xl transition">
                    @if (auth()->user()->photo)
                        <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="User"
                            class="w-9 h-9 md:w-10 md:h-10 rounded-full border-2 border-white shadow-sm object-cover object-top">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=e0e7ff&color=2563eb"
                            alt="User"
                            class="w-9 h-9 md:w-10 md:h-10 rounded-full border-2 border-white shadow-sm object-cover object-top">
                    @endif
                    <div class="text-sm hidden sm:block pr-2">
                        <p class="font-bold text-gray-700 leading-tight">{{ explode(' ', auth()->user()->name)[0] }}
                        </p>
                        <p class="text-[11px] font-bold text-primary-blue capitalize">{{ auth()->user()->role }}</p>
                    </div>
                </a>
            </div>
        </header>

        <div class="px-6 md:px-10 py-6 md:pb-10 overflow-y-auto flex-1 main-content-scroll bg-bg-main relative">
            @yield('content')
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('mainSidebar');
            const toggleBtn = document.getElementById('sidebarToggleBtn');
            const iconPath = document.getElementById('toggleIconPath');

            // Cek di local storage biar permanen pas pindah halaman
            const isCollapsed = localStorage.getItem('sidebar_collapsed') === 'true';

            if (isCollapsed) {
                sidebar.classList.add('sidebar-collapsed');
                iconPath.setAttribute('d', 'M4 6h16M4 12h16M4 18h16'); // Ikon garis tiga full
            }

            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('sidebar-collapsed');
                const isNowCollapsed = sidebar.classList.contains('sidebar-collapsed');
                localStorage.setItem('sidebar_collapsed', isNowCollapsed);

                // Animasi Ikon Hamburger
                if (isNowCollapsed) {
                    iconPath.setAttribute('d', 'M4 6h16M4 12h16M4 18h16');
                } else {
                    iconPath.setAttribute('d', 'M4 6h16M4 12h16M4 18h7');
                }
            });
        });
    </script>
</body>

</html>
