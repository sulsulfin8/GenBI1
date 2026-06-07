@extends('layout.app')

@section('content')
    <div class="mb-8 animate-fade-in-down">
        <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">Manajemen Absensi</h1>
        <p class="text-gray-500 text-sm mt-1">Pilih kegiatan dan catat kehadiran anggota GenBI secara massal.</p>
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

    @if ($errors->any())
        <div
            class="mb-6 p-4 bg-red-50 border border-red-200 text-red-600 rounded-2xl text-sm font-bold flex flex-col gap-2 shadow-sm animate-fade-in-down">
            <div class="flex items-center gap-3">
                <div class="bg-red-500 text-white p-1 rounded-full">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </div>
                Penyimpanan Gagal! Perhatikan hal berikut:
            </div>
            <ul class="list-disc list-inside ml-8 font-medium">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-3xl p-6 md:p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-50 relative z-20">

        <form action="{{ url()->current() }}" method="GET" id="filterForm"
            class="flex flex-col lg:flex-row justify-end items-center mb-6 text-sm text-gray-600 gap-4">

            <div class="flex flex-col md:flex-row items-center gap-3 w-full lg:w-auto">

                @if (request('kegiatan_id'))
                    @php
                        $selectedKeg = $kegiatans->where('id', request('kegiatan_id'))->first();
                        $isDoneNow = in_array($selectedKeg->nama_kegiatan ?? '', $sudahAbsen);
                    @endphp
                    <div
                        class="px-4 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest flex items-center gap-2 flex-shrink-0 {{ $isDoneNow ? 'bg-emerald-100 text-emerald-700 border border-emerald-200' : 'bg-amber-100 text-amber-700 border border-amber-200' }}">
                        <span class="relative flex h-2 w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full {{ $isDoneNow ? 'bg-emerald-400' : 'bg-amber-400' }} opacity-75"></span>
                            <span
                                class="relative inline-flex rounded-full h-2 w-2 {{ $isDoneNow ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                        </span>
                        Status: {{ $isDoneNow ? 'Sudah Di-Absen' : 'Belum Ada Absensi' }}
                    </div>
                @endif

                <div class="relative w-full md:w-72" id="customDropdownContainer">
                    <select name="kegiatan_id" id="master_kegiatan" class="hidden">
                        <option value="" data-nama="">-- 1. Pilih Kegiatan --</option>
                        @foreach ($kegiatans as $kegiatan)
                            @php $isDone = in_array($kegiatan->nama_kegiatan, $sudahAbsen); @endphp
                            <option value="{{ $kegiatan->id }}" data-nama="{{ $kegiatan->nama_kegiatan }}"
                                {{ request('kegiatan_id') == $kegiatan->id ? 'selected' : '' }}>
                                {{ $isDone ? '✅' : '🔴' }} {{ $kegiatan->nama_kegiatan }}
                            </option>
                        @endforeach
                    </select>

                    <button type="button" id="dropdownButton"
                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-2.5 focus:outline-none focus:border-primary-blue focus:ring-2 focus:ring-primary-blue/20 bg-gray-50 hover:bg-white transition font-bold text-primary-blue flex justify-between items-center text-left">
                        <span id="dropdownSelectedText" class="truncate">-- 1. Pilih Kegiatan --</span>
                        <svg class="h-5 w-5 text-gray-400 flex-shrink-0 transition-transform duration-200" id="dropdownIcon"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div id="dropdownMenu"
                        class="absolute z-50 w-full mt-2 bg-white border border-gray-100 rounded-2xl shadow-[0_10px_40px_rgb(0,0,0,0.1)] hidden flex-col overflow-hidden origin-top transition-all scale-95 opacity-0">
                        <div class="p-3 border-b border-gray-50 bg-gray-50/50">
                            <div class="relative">
                                <input type="text" id="dropdownSearch" placeholder="Cari kegiatan..."
                                    class="w-full pl-9 pr-3 py-2 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary-blue/20 focus:border-primary-blue transition-all">
                                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>

                        <ul id="dropdownOptions" class="max-h-60 overflow-y-auto p-2 space-y-1 custom-scrollbar">
                            <li class="px-3 py-2.5 rounded-xl cursor-pointer text-sm font-bold text-gray-500 hover:bg-gray-100 transition-colors dropdown-option"
                                data-value="">
                                -- 1. Pilih Kegiatan --
                            </li>
                            @foreach ($kegiatans as $kegiatan)
                                @php $isDone = in_array($kegiatan->nama_kegiatan, $sudahAbsen); @endphp
                                <li class="px-3 py-2.5 rounded-xl cursor-pointer text-sm font-bold transition-colors dropdown-option flex items-center gap-2 {{ $isDone ? 'text-emerald-600 hover:bg-emerald-50' : 'text-red-500 hover:bg-red-50' }}"
                                    data-value="{{ $kegiatan->id }}" data-nama="{{ $kegiatan->nama_kegiatan }}">
                                    <span>{{ $isDone ? '✅' : '🔴' }}</span>
                                    <span class="truncate">{{ $kegiatan->nama_kegiatan }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="relative w-full md:w-64">
                    <input type="text" name="search" id="searchInput" value="{{ request('search') }}"
                        placeholder="2. Cari NIM/Nama..." oninput="handleSearch(this)"
                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-2.5 pl-10 focus:outline-none focus:border-primary-blue focus:ring-2 focus:ring-primary-blue/20 text-sm bg-gray-50 focus:bg-white transition-all font-medium text-gray-700">
                    <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </form>

        <form action="{{ route('absensi.store') }}" method="POST">
            @csrf
            <div class="overflow-x-auto rounded-2xl border border-gray-100">
                <table class="w-full text-left border-collapse min-w-max">
                    <thead>
                        <tr class="bg-gray-50/80 border-b border-gray-100">
                            <th
                                class="py-4 px-5 font-black text-[11px] text-gray-500 uppercase tracking-widest text-center w-12">
                                No</th>
                            <th class="py-4 px-5 font-black text-[11px] text-gray-500 uppercase tracking-widest">Mahasiswa
                            </th>
                            <th class="py-4 px-5 font-black text-[11px] text-gray-500 uppercase tracking-widest">Devisi &
                                Jurusan</th>
                            <th class="py-4 px-5 font-black text-[11px] text-gray-500 uppercase tracking-widest">Kegiatan
                            </th>
                            <th
                                class="py-4 px-5 font-black text-[11px] text-gray-500 uppercase tracking-widest text-center">
                                Status Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100">
                        @forelse($users as $user)
                            <tr class="hover:bg-blue-50/40 transition-colors duration-200 group">
                                <td class="py-4 px-5 text-center text-gray-400 font-bold">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="py-4 px-5">
                                    <div class="flex items-center gap-4">
                                        @php
                                            $colors = [
                                                'bg-blue-100 text-blue-600',
                                                'bg-emerald-100 text-emerald-600',
                                                'bg-amber-100 text-amber-600',
                                                'bg-purple-100 text-purple-600',
                                                'bg-rose-100 text-rose-600',
                                            ];
                                            $colorClass =
                                                $colors[ord(strtoupper(substr($user->name, 0, 1))) % count($colors)];
                                        @endphp
                                        <div
                                            class="w-10 h-10 rounded-full {{ $colorClass }} flex items-center justify-center font-black text-sm shadow-sm flex-shrink-0 border border-white">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p
                                                class="font-extrabold text-gray-800 text-sm group-hover:text-primary-blue transition-colors">
                                                {{ $user->name }}</p>
                                            <p class="font-mono text-xs text-gray-500 mt-0.5">
                                                {{ $user->nim ?? 'NIM Kosong' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-5">
                                    <input type="hidden" name="absensi[{{ $user->id }}][nim]"
                                        value="{{ $user->nim }}">
                                    <input type="hidden" name="absensi[{{ $user->id }}][nama_lengkap]"
                                        value="{{ $user->name }}">
                                    <input type="hidden" name="absensi[{{ $user->id }}][jurusan]"
                                        value="{{ $user->jurusan }}">

                                    @if ($user->role == 'admin')
                                        <input type="hidden" name="absensi[{{ $user->id }}][devisi]"
                                            value="Ketua Umum">
                                        <p class="font-bold text-blue-600 text-sm">Ketua Umum</p>
                                    @elseif($user->role == 'sekretaris')
                                        <input type="hidden" name="absensi[{{ $user->id }}][devisi]"
                                            value="Sekretaris Umum">
                                        <p class="font-bold text-emerald-600 text-sm">Sekretaris Umum</p>
                                    @elseif($user->role == 'bendahara')
                                        <input type="hidden" name="absensi[{{ $user->id }}][devisi]"
                                            value="Bendahara Umum">
                                        <p class="font-bold text-amber-600 text-sm">Bendahara Umum</p>
                                    @else
                                        <input type="hidden" name="absensi[{{ $user->id }}][devisi]"
                                            value="{{ $user->devisi }}">
                                        <p class="font-bold text-gray-700 text-sm">
                                            {{ $user->devisi ?? 'Belum ada devisi' }}</p>
                                    @endif
                                    <p class="text-xs text-gray-500 mt-0.5">{{ $user->jurusan ?? '-' }}</p>
                                </td>
                                <td class="py-4 px-5">
                                    <input type="hidden" name="absensi[{{ $user->id }}][kegiatan_nama]"
                                        class="input-kegiatan-nama">
                                    <div class="flex items-center gap-2 teks-kegiatan-container text-gray-400">
                                        <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="teks-kegiatan italic text-xs">Menunggu kegiatan...</span>
                                    </div>
                                </td>
                                <td class="py-4 px-5">
                                    <div class="flex justify-center items-center">
                                        @php
                                            $statusDb = 'H';
                                            if (isset($absensiRecord) && isset($absensiRecord[$user->nim])) {
                                                $statusDb = $absensiRecord[$user->nim]->status;
                                            }
                                        @endphp
                                        <div
                                            class="flex items-center gap-1.5 bg-gray-100 p-1.5 rounded-xl border border-gray-200 shadow-inner">
                                            <label class="cursor-pointer relative">
                                                <input type="radio" name="absensi[{{ $user->id }}][status]"
                                                    value="H" class="peer sr-only" required
                                                    {{ $statusDb == 'H' ? 'checked' : '' }}>
                                                <span
                                                    class="w-8 h-8 flex items-center justify-center rounded-lg text-sm font-black text-gray-400 peer-checked:bg-emerald-500 peer-checked:text-white peer-checked:shadow-md hover:bg-gray-200 transition-all duration-200">H</span>
                                            </label>
                                            <label class="cursor-pointer relative">
                                                <input type="radio" name="absensi[{{ $user->id }}][status]"
                                                    value="I" class="peer sr-only" required
                                                    {{ $statusDb == 'I' ? 'checked' : '' }}>
                                                <span
                                                    class="w-8 h-8 flex items-center justify-center rounded-lg text-sm font-black text-gray-400 peer-checked:bg-amber-400 peer-checked:text-white peer-checked:shadow-md hover:bg-gray-200 transition-all duration-200">I</span>
                                            </label>
                                            <label class="cursor-pointer relative">
                                                <input type="radio" name="absensi[{{ $user->id }}][status]"
                                                    value="S" class="peer sr-only" required
                                                    {{ $statusDb == 'S' ? 'checked' : '' }}>
                                                <span
                                                    class="w-8 h-8 flex items-center justify-center rounded-lg text-sm font-black text-gray-400 peer-checked:bg-blue-400 peer-checked:text-white peer-checked:shadow-md hover:bg-gray-200 transition-all duration-200">S</span>
                                            </label>
                                            <label class="cursor-pointer relative">
                                                <input type="radio" name="absensi[{{ $user->id }}][status]"
                                                    value="A" class="peer sr-only" required
                                                    {{ $statusDb == 'A' ? 'checked' : '' }}>
                                                <span
                                                    class="w-8 h-8 flex items-center justify-center rounded-lg text-sm font-black text-gray-400 peer-checked:bg-red-500 peer-checked:text-white peer-checked:shadow-md hover:bg-gray-200 transition-all duration-200">A</span>
                                            </label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-16 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-400">
                                        <div class="bg-gray-50 p-4 rounded-full mb-3">
                                            <svg class="w-10 h-10 opacity-40 text-gray-500" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                                </path>
                                            </svg>
                                        </div>
                                        <p class="text-sm font-bold text-gray-600">Tidak ada data anggota ditemukan.</p>
                                        @if (request('search'))
                                            <a href="{{ url()->current() }}"
                                                class="text-xs text-primary-blue hover:underline mt-2">Hapus pencarian</a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6 pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit"
                    class="w-full md:w-auto bg-gradient-to-r from-blue-600 to-primary-blue hover:from-blue-700 hover:to-blue-600 text-white px-10 py-3.5 rounded-2xl font-black text-sm transition-all duration-300 shadow-xl shadow-blue-500/30 flex items-center justify-center gap-3 hover:-translate-y-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Absensi
                </button>
            </div>
        </form>
    </div>

    <style>
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

        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>

    <script>
        let typingTimer;
        const doneTypingInterval = 500;

        function handleSearch(inputElement) {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(function() {
                document.getElementById('filterForm').submit();
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
            initCustomDropdown();
            syncSemuaKegiatan();
        });

        function initCustomDropdown() {
            const container = document.getElementById('customDropdownContainer');
            if (!container) return;

            const button = document.getElementById('dropdownButton');
            const menu = document.getElementById('dropdownMenu');
            const search = document.getElementById('dropdownSearch');
            const options = document.querySelectorAll('.dropdown-option');
            const select = document.getElementById('master_kegiatan');
            const selectedText = document.getElementById('dropdownSelectedText');
            const icon = document.getElementById('dropdownIcon');

            const initSelected = select.querySelector('option:checked');
            if (initSelected && initSelected.value !== "") {
                selectedText.innerHTML = initSelected.innerHTML;
                selectedText.className = initSelected.className + " truncate";
            }

            button.addEventListener('click', function(e) {
                e.stopPropagation();
                const isHidden = menu.classList.contains('hidden');

                if (isHidden) {
                    menu.classList.remove('hidden');
                    setTimeout(() => {
                        menu.classList.remove('scale-95', 'opacity-0');
                        menu.classList.add('scale-100', 'opacity-100');
                    }, 10);
                    icon.classList.add('rotate-180');
                    search.focus();
                } else {
                    tutupDropdown();
                }
            });

            function tutupDropdown() {
                menu.classList.remove('scale-100', 'opacity-100');
                menu.classList.add('scale-95', 'opacity-0');
                icon.classList.remove('rotate-180');
                setTimeout(() => {
                    menu.classList.add('hidden');
                }, 200);
            }

            search.addEventListener('input', function() {
                const val = this.value.toLowerCase();
                options.forEach(opt => {
                    if (opt.innerText.toLowerCase().includes(val)) {
                        opt.classList.remove('hidden');
                    } else {
                        opt.classList.add('hidden');
                    }
                });
            });

            options.forEach(opt => {
                opt.addEventListener('click', function() {
                    const val = this.getAttribute('data-value');
                    select.value = val;
                    selectedText.innerHTML = this.innerHTML;
                    selectedText.className = "truncate";
                    if (this.classList.contains('text-emerald-600')) selectedText.classList.add(
                        'text-emerald-600');
                    if (this.classList.contains('text-red-500')) selectedText.classList.add('text-red-500');

                    tutupDropdown();
                    document.getElementById('filterForm').submit();
                });
            });

            document.addEventListener('click', function(e) {
                if (!container.contains(e.target) && !menu.classList.contains('hidden')) {
                    tutupDropdown();
                }
            });
        }

        function syncSemuaKegiatan() {
            const select = document.getElementById('master_kegiatan');
            if (!select) return;

            const selectedOption = select.querySelector('option:checked');
            const selectedText = selectedOption && selectedOption.value !== "" ? selectedOption.getAttribute('data-nama') :
                "";
            const semuaInputNama = document.querySelectorAll('.input-kegiatan-nama');
            const semuaTeksContainer = document.querySelectorAll('.teks-kegiatan-container');

            semuaInputNama.forEach(function(input, index) {
                const container = semuaTeksContainer[index];
                if (selectedText !== "") {
                    input.value = selectedText;
                    container.classList.remove('text-gray-400');
                    container.classList.add('text-blue-600', 'bg-blue-50', 'px-3', 'py-1.5', 'rounded-lg', 'w-max',
                        'font-bold');
                    container.innerHTML =
                        `<svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg><span class="teks-kegiatan text-xs">${selectedText}</span>`;
                } else {
                    input.value = "";
                    container.classList.add('text-gray-400');
                    container.classList.remove('text-blue-600', 'bg-blue-50', 'px-3', 'py-1.5', 'rounded-lg',
                        'w-max', 'font-bold');
                    container.innerHTML =
                        `<svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg><span class="teks-kegiatan italic text-xs">Menunggu kegiatan...</span>`;
                }
            });
        }
    </script>
@endsection
