@extends('layout.app')

@section('content')
    <div class="mb-8 animate-fade-in-down">
        <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">Manajemen Kegiatan</h1>
        <p class="text-gray-500 text-sm mt-1">Kelola jadwal, tempat, dan rekapitulasi kegiatan organisasi.</p>
    </div>

    @if (session('success'))
        <div
            class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-600 rounded-2xl text-sm font-bold flex items-center gap-3 shadow-sm animate-fade-in-down">
            <div class="bg-emerald-500 text-white p-1 rounded-full">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-3xl p-6 md:p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-50 relative z-20">

        <div class="flex flex-col lg:flex-row justify-between items-center mb-6 text-sm text-gray-600 gap-4">

            <form action="{{ route('kegiatan') }}" method="GET" class="flex items-center gap-2">
                @if (request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif
                @if (request('devisi'))
                    <input type="hidden" name="devisi" value="{{ request('devisi') }}">
                @endif

                <span class="font-medium">Tampilkan</span>
                <select name="per_page" onchange="this.form.submit()"
                    class="border border-gray-200 rounded-lg px-3 py-1.5 focus:outline-none focus:border-primary-blue focus:ring-2 focus:ring-primary-blue/20 bg-gray-50 hover:bg-white transition font-bold text-gray-700 cursor-pointer">
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                </select>
                <span class="font-medium">entri</span>
            </form>

            <div class="flex flex-col md:flex-row items-center gap-3 w-full lg:w-auto">
                <form action="{{ route('kegiatan') }}" method="GET"
                    class="flex flex-col md:flex-row items-center gap-3 w-full" id="searchForm">
                    @if (request('per_page'))
                        <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                    @endif

                    <select name="devisi" onchange="this.form.submit()"
                        class="w-full md:w-auto border border-gray-200 rounded-xl px-4 py-2.5 focus:outline-none focus:border-primary-blue focus:ring-2 focus:ring-primary-blue/20 bg-gray-50 hover:bg-white transition font-bold text-gray-700 cursor-pointer">
                        <option value="">-- Semua Devisi --</option>
                        <option value="Semua Devisi" {{ request('devisi') == 'Semua Devisi' ? 'selected' : '' }}>Semua
                            Devisi (Kegiatan Bersama)</option>
                        @foreach ($devisis as $dev)
                            @continue(in_array(strtolower($dev->nama_devisi), ['pengurus inti', 'presidium inti']))
                            <option value="{{ $dev->nama_devisi }}"
                                {{ request('devisi') == $dev->nama_devisi ? 'selected' : '' }}>{{ $dev->nama_devisi }}
                            </option>
                        @endforeach
                    </select>

                    <div class="relative w-full md:w-64">
                        <input type="text" name="search" id="searchInput" value="{{ request('search') }}"
                            placeholder="Cari kegiatan..." oninput="handleSearch(this)"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 pl-10 focus:outline-none focus:border-primary-blue focus:ring-2 focus:ring-primary-blue/20 text-sm bg-gray-50 focus:bg-white transition-all">
                        <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </form>

                <button onclick="toggleModal('modalTambahKegiatan')"
                    class="w-full md:w-auto bg-gradient-to-r from-blue-600 to-primary-blue hover:from-blue-700 hover:to-blue-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-all shadow-md shadow-blue-500/30 flex items-center justify-center gap-2 hover:-translate-y-0.5 flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Kegiatan
                </button>
            </div>
        </div>

        <div class="overflow-x-auto rounded-2xl border border-gray-100">
            <table class="w-full text-left border-collapse min-w-max">
                <thead>
                    <tr class="bg-gray-50/80 border-b border-gray-100">
                        <th
                            class="py-4 px-5 font-black text-[11px] text-gray-500 uppercase tracking-widest text-center w-12">
                            No</th>
                        <th class="py-4 px-5 font-black text-[11px] text-gray-500 uppercase tracking-widest">Nama Kegiatan
                        </th>
                        <th class="py-4 px-5 font-black text-[11px] text-gray-500 uppercase tracking-widest">Devisi</th>
                        <th class="py-4 px-5 font-black text-[11px] text-gray-500 uppercase tracking-widest">Waktu
                            Pelaksanaan</th>
                        <th class="py-4 px-5 font-black text-[11px] text-gray-500 uppercase tracking-widest">Lokasi / Tempat
                        </th>
                        <th class="py-4 px-5 font-black text-[11px] text-gray-500 uppercase tracking-widest text-center">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-100">
                    @forelse($kegiatans as $key => $kegiatan)
                        <tr class="hover:bg-blue-50/40 transition-colors duration-200 group">

                            <td class="py-4 px-5 text-center text-gray-400 font-bold">
                                {{ ($kegiatans->currentPage() - 1) * $kegiatans->perPage() + $loop->iteration }}
                            </td>

                            <td class="py-4 px-5">
                                <p
                                    class="font-extrabold text-gray-800 text-sm group-hover:text-primary-blue transition-colors">
                                    {{ $kegiatan->nama_kegiatan }}
                                </p>
                            </td>

                            <td class="py-4 px-5">
                                @php
                                    $devColor = 'bg-gray-100 text-gray-600';
                                    if (strtolower($kegiatan->devisi) == 'semua devisi') {
                                        $devColor = 'bg-gray-800 text-white';
                                    } else {
                                        $matchedDev = $devisis->firstWhere('nama_devisi', $kegiatan->devisi);
                                        if ($matchedDev) {
                                            $color = $matchedDev->warna; // Mengambil warna dari database
                                            $devColor = "bg-{$color}-100 text-{$color}-700 border border-{$color}-200";
                                        }
                                    }
                                @endphp
                                <span
                                    class="px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest inline-block {{ $devColor }}">
                                    {{ $kegiatan->devisi }}
                                </span>
                            </td>

                            <td class="py-4 px-5">
                                <div class="flex flex-col">
                                    <span class="font-bold text-gray-700">
                                        {{ \Carbon\Carbon::parse($kegiatan->tanggal)->locale('id')->translatedFormat('l, d F Y') }}
                                    </span>
                                    <span class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5 text-amber-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Pukul {{ $kegiatan->waktu }}
                                    </span>
                                </div>
                            </td>

                            <td class="py-4 px-5 text-gray-600 font-medium">
                                <div class="flex items-center gap-2">
                                    <div class="p-1.5 bg-red-50 text-red-500 rounded-lg">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    {{ $kegiatan->tempat }}
                                </div>
                            </td>

                            <td class="py-4 px-5 text-center">
                                <div class="flex justify-center items-center gap-2">
                                    <button onclick="toggleModal('modalEditKegiatan{{ $kegiatan->id }}')"
                                        class="p-2 text-blue-600 bg-blue-50 hover:bg-blue-600 hover:text-white rounded-lg transition-all">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="2">
                                            <path
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                    <form action="{{ route('kegiatan.destroy', $kegiatan->id) }}" method="POST"
                                        onsubmit="return confirm('Hapus kegiatan ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="p-2 text-red-500 bg-red-50 hover:bg-red-500 hover:text-white rounded-lg transition-all">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-16 text-center text-gray-400">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <div class="bg-gray-50 p-4 rounded-full mb-3">
                                        <svg class="w-10 h-10 opacity-40 text-gray-500" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-bold text-gray-600">
                                        @if (request('search') || request('devisi'))
                                            Data kegiatan tidak ditemukan.
                                        @else
                                            Belum ada kegiatan terdaftar.
                                        @endif
                                    </p>
                                    @if (request('search') || request('devisi'))
                                        <a href="{{ route('kegiatan') }}"
                                            class="text-xs text-primary-blue hover:underline mt-2">Hapus filter
                                            pencarian</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 pt-6 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="w-full overflow-x-auto hide-scrollbar">
                {{ $kegiatans->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    <div id="modalTambahKegiatan"
        class="fixed inset-0 z-50 hidden bg-gray-900/70 backdrop-blur-sm items-center justify-center p-4 transition-all">
        <div
            class="bg-white rounded-3xl shadow-2xl w-full max-w-md flex flex-col overflow-hidden animate-modal max-h-[90vh]">
            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h3 class="text-lg font-extrabold text-gray-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Kegiatan Baru
                </h3>
                <button onclick="toggleModal('modalTambahKegiatan')"
                    class="text-gray-400 hover:text-red-500 hover:bg-red-50 p-2 rounded-xl transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <form action="{{ route('kegiatan.store') }}" method="POST" class="p-6 space-y-4 overflow-y-auto">
                @csrf
                <div>
                    <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-1.5">Nama
                        Kegiatan</label>
                    <input type="text" name="nama_kegiatan" placeholder="Contoh: Rapat Evaluasi Bulanan" required
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary-blue focus:border-primary-blue transition-all bg-gray-50 focus:bg-white font-medium text-gray-800">
                </div>
                <div>
                    <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-1.5">Devisi
                        Pelaksana</label>
                    <select name="devisi" required
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all bg-gray-50 focus:bg-white font-medium text-gray-800 cursor-pointer">
                        <option value="Semua Devisi" class="font-bold text-blue-600"
                            {{ isset($kegiatan) && $kegiatan->devisi == 'Semua Devisi' ? 'selected' : '' }}>Semua Devisi
                            (Kegiatan Bersama)</option>
                        @foreach ($devisis as $dev)
                            <option value="{{ $dev->nama_devisi }}"
                                {{ isset($kegiatan) && $kegiatan->devisi == $dev->nama_devisi ? 'selected' : '' }}>
                                {{ $dev->nama_devisi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label
                            class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-1.5">Tanggal</label>
                        <input type="date" name="tanggal" required
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary-blue focus:border-primary-blue transition-all bg-gray-50 focus:bg-white font-medium text-gray-800">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-1.5">Waktu
                            (Jam)</label>
                        <input type="time" name="waktu" required
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary-blue focus:border-primary-blue transition-all bg-gray-50 focus:bg-white font-medium text-gray-800">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-1.5">Tempat /
                        Lokasi</label>
                    <input type="text" name="tempat" placeholder="Contoh: Sekretariat GenBI / Zoom" required
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary-blue focus:border-primary-blue transition-all bg-gray-50 focus:bg-white font-medium text-gray-800">
                </div>

                <div class="flex justify-end gap-3 pt-4 mt-2 border-t border-gray-100">
                    <button type="button" onclick="toggleModal('modalTambahKegiatan')"
                        class="px-5 py-3 text-gray-500 font-bold bg-gray-100 hover:bg-gray-200 rounded-xl text-sm transition">Batal</button>
                    <button type="submit"
                        class="bg-gradient-to-r from-blue-600 to-primary-blue hover:from-blue-700 hover:to-blue-600 text-white px-8 py-3 rounded-xl text-sm font-bold shadow-md shadow-blue-500/30 transition hover:-translate-y-0.5">Simpan
                        Data</button>
                </div>
            </form>
        </div>
    </div>

    @foreach ($kegiatans as $kegiatan)
        <div id="modalEditKegiatan{{ $kegiatan->id }}"
            class="fixed inset-0 z-50 hidden bg-gray-900/70 backdrop-blur-sm items-center justify-center p-4 transition-all">
            <div
                class="bg-white rounded-3xl shadow-2xl w-full max-w-md flex flex-col overflow-hidden animate-modal max-h-[90vh]">
                <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <h3 class="text-lg font-extrabold text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        Edit Data Kegiatan
                    </h3>
                    <button onclick="toggleModal('modalEditKegiatan{{ $kegiatan->id }}')"
                        class="text-gray-400 hover:text-red-500 hover:bg-red-50 p-2 rounded-xl transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form action="{{ route('kegiatan.update', $kegiatan->id) }}" method="POST"
                    class="p-6 space-y-4 overflow-y-auto">
                    @csrf @method('PUT')
                    <div>
                        <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-1.5">Nama
                            Kegiatan</label>
                        <input type="text" name="nama_kegiatan" value="{{ $kegiatan->nama_kegiatan }}" required
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all bg-gray-50 focus:bg-white font-medium text-gray-800">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-1.5">Devisi
                            Pelaksana</label>
                        <select name="devisi" required
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all bg-gray-50 focus:bg-white font-medium text-gray-800 cursor-pointer">
                            <option value="Semua Devisi" class="font-bold text-blue-600"
                                {{ isset($kegiatan) && $kegiatan->devisi == 'Semua Devisi' ? 'selected' : '' }}>Semua
                                Devisi (Kegiatan Bersama)</option>
                            @foreach ($devisis as $dev)
                                <option value="{{ $dev->nama_devisi }}"
                                    {{ isset($kegiatan) && $kegiatan->devisi == $dev->nama_devisi ? 'selected' : '' }}>
                                    {{ $dev->nama_devisi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label
                                class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-1.5">Tanggal</label>
                            <input type="date" name="tanggal" value="{{ $kegiatan->tanggal }}" required
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all bg-gray-50 focus:bg-white font-medium text-gray-800">
                        </div>
                        <div>
                            <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-1.5">Waktu
                                (Jam)
                            </label>
                            <input type="time" name="waktu" value="{{ $kegiatan->waktu }}" required
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all bg-gray-50 focus:bg-white font-medium text-gray-800">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-1.5">Tempat /
                            Lokasi</label>
                        <input type="text" name="tempat" value="{{ $kegiatan->tempat }}" required
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all bg-gray-50 focus:bg-white font-medium text-gray-800">
                    </div>

                    <div class="flex justify-end gap-3 pt-4 mt-2 border-t border-gray-100">
                        <button type="button" onclick="toggleModal('modalEditKegiatan{{ $kegiatan->id }}')"
                            class="px-5 py-3 text-gray-500 font-bold bg-gray-100 hover:bg-gray-200 rounded-xl text-sm transition">Batal</button>
                        <button type="submit"
                            class="bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white px-8 py-3 rounded-xl text-sm font-bold shadow-md shadow-emerald-500/30 transition hover:-translate-y-0.5">Update
                            Data</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    <style>
        @keyframes modalPop {
            0% {
                opacity: 0;
                transform: scale(0.95);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes fadeInDown {
            0% {
                opacity: 0;
                transform: translateY(-15px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-modal {
            animation: modalPop 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .animate-fade-in-down {
            animation: fadeInDown 0.4s ease-out forwards;
        }

        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    <script>
        function toggleModal(id) {
            const m = document.getElementById(id);
            if (m) {
                if (m.classList.contains('hidden')) {
                    document.body.style.overflow = 'hidden';
                    m.classList.remove('hidden');
                    m.classList.add('flex');
                } else {
                    document.body.style.overflow = 'auto';
                    m.classList.add('hidden');
                    m.classList.remove('flex');
                }
            }
        }

        let typingTimer;
        const doneTypingInterval = 500;

        function handleSearch(inputElement) {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(function() {
                inputElement.form.submit();
            }, doneTypingInterval);
        }

        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById('searchInput');
            if (searchInput && searchInput.value) {
                searchInput.focus();
                const val = searchInput.value;
                searchInput.value = '';
                searchInput.value = val;
            }
        });
    </script>
@endsection
