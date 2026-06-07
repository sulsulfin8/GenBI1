@extends('layout.app')

@section('content')
    <div class="mb-8 animate-fade-in-down flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <div class="flex items-center gap-2.5">
                <div
                    class="bg-gradient-to-tr from-blue-600 to-blue-500 p-2 rounded-2xl text-white shadow-md shadow-blue-500/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                </div>
                <h1 class="text-3xl font-black text-gray-800 tracking-tight">
                    @if (auth()->user()->role == 'bendahara')
                        Laporan Anggaran Kegiatan
                    @else
                        Pusat Cetak Laporan
                    @endif
                </h1>
            </div>
            <p class="text-gray-400 text-sm mt-1.5 font-medium pl-11">Unduh, kelola, dan cetak arsip administrasi digital
                dalam format PDF dan Word secara instan.</p>
        </div>
    </div>

    <div
        class="bg-white rounded-3xl p-6 md:p-8 shadow-[0_12px_40px_rgba(0,0,0,0.03)] border border-gray-100/70 relative z-20">

        <div class="bg-gray-50/70 rounded-2xl p-5 border border-gray-100 mb-8">
            <form action="{{ route('laporan') }}" method="GET"
                class="flex flex-wrap lg:flex-nowrap items-center gap-4 text-sm w-full">

                <div class="flex flex-col gap-1.5 w-full md:w-auto md:flex-1 min-w-[200px]">
                    <label class="text-xs font-black text-gray-400 uppercase tracking-widest pl-1">Jenis Arsip</label>
                    <div class="relative">
                        <select name="jenis" onchange="this.form.submit()"
                            class="w-full border-2 border-gray-200/80 rounded-xl pl-10 pr-4 py-2.5 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 bg-white font-extrabold text-gray-700 cursor-pointer appearance-none transition-all shadow-sm">
                            <option value="Rancang Anggaran" {{ $jenis == 'Rancang Anggaran' ? 'selected' : '' }}>💰 Rancang
                                Anggaran</option>
                            <option value="Absensi" {{ $jenis == 'Absensi' ? 'selected' : '' }}>📝 Absensi Kehadiran
                            </option>
                            <option value="Poin Keaktifan" {{ $jenis == 'Poin Keaktifan' ? 'selected' : '' }}>🏆 Poin
                                Keaktifan</option>
                        </select>
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </div>
                        <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-1.5 w-full md:w-auto md:flex-1 min-w-[160px]">
                    <label class="text-xs font-black text-gray-400 uppercase tracking-widest pl-1">Bulan</label>
                    <div class="relative">
                        <select name="bulan" onchange="this.form.submit()"
                            class="w-full border-2 border-gray-200/80 rounded-xl pl-10 pr-4 py-2.5 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 bg-white font-bold text-gray-700 cursor-pointer appearance-none transition-all shadow-sm">
                            <option value="">-- Semua Bulan --</option>
                            @foreach (range(1, 12) as $m)
                                <option value="{{ sprintf('%02d', $m) }}"
                                    {{ ($bulan ?? '') == sprintf('%02d', $m) ? 'selected' : '' }}>
                                    {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </div>
                        <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-1.5 w-full md:w-auto md:flex-1 min-w-[160px]">
                    <label class="text-xs font-black text-gray-400 uppercase tracking-widest pl-1">Tahun Akademik</label>
                    <div class="relative">
                        <select name="tahun" onchange="this.form.submit()"
                            class="w-full border-2 border-gray-200/80 rounded-xl pl-10 pr-4 py-2.5 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 bg-white font-bold text-gray-700 cursor-pointer appearance-none transition-all shadow-sm">
                            <option value="">-- Semua Tahun --</option>
                            @foreach (range(date('Y') - 2, date('Y') + 1) as $y)
                                <option value="{{ $y }}" {{ ($tahun ?? '') == $y ? 'selected' : '' }}>
                                    {{ $y }}</option>
                            @endforeach
                        </select>
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </div>
                        <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-1.5 w-full lg:w-72">
                    <label class="text-xs font-black text-gray-400 uppercase tracking-widest pl-1">Kata Kunci</label>
                    <div class="relative">
                        <input type="text" name="search" value="{{ $search }}"
                            placeholder="Cari kegiatan/devisi..."
                            class="w-full border-2 border-gray-200/80 rounded-xl pl-10 pr-4 py-2.5 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 text-sm bg-white font-medium text-gray-700 transition-all shadow-sm">
                        <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="overflow-x-auto border border-gray-100 rounded-2xl shadow-sm bg-white">
            <table class="w-full text-left border-collapse min-w-max">
                <thead>
                    <tr class="bg-gray-50/80 text-gray-400 border-b border-gray-100">
                        <th class="py-4 px-5 font-black text-[11px] uppercase tracking-widest w-16 text-center">No</th>
                        <th class="py-4 px-5 font-black text-[11px] uppercase tracking-widest">Judul Dokumen Laporan</th>
                        <th class="py-4 px-5 font-black text-[11px] uppercase tracking-widest">Penanggung Jawab</th>
                        <th class="py-4 px-5 font-black text-[11px] uppercase tracking-widest w-40">Kategori Arsip</th>
                        <th class="py-4 px-5 font-black text-[11px] uppercase tracking-widest text-center w-60">Opsi Cetak
                        </th>
                    </tr>
                </thead>

                <tbody class="text-gray-600 text-sm divide-y divide-gray-50">
                    @forelse($laporans as $laporan)
                        <tr class="hover:bg-blue-50/40 transition-all duration-300 group hover:translate-x-1">
                            <td
                                class="py-4 px-5 text-center text-gray-400 font-bold group-hover:text-blue-600 transition-colors">
                                {{ $loop->iteration }}
                            </td>
                            <td class="py-4 px-5">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="p-2 bg-gray-100 rounded-xl text-gray-500 group-hover:bg-blue-100 group-hover:text-blue-600 transition-all shadow-inner">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <span
                                        class="font-extrabold text-gray-800 group-hover:text-blue-900 transition-colors tracking-tight">{{ $laporan->judul_laporan }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-5 font-semibold text-gray-600">{{ $laporan->devisi }}</td>
                            <td class="py-4 px-5">
                                @if ($laporan->jenis_laporan == 'Rancang Anggaran')
                                    <span
                                        class="px-3 py-1.5 bg-emerald-50 text-emerald-600 border border-emerald-100 rounded-xl text-xs font-black uppercase tracking-wider flex items-center justify-center w-max gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                        Anggaran
                                    </span>
                                @elseif($laporan->jenis_laporan == 'Absensi')
                                    <span
                                        class="px-3 py-1.5 bg-blue-50 text-blue-600 border border-blue-100 rounded-xl text-xs font-black uppercase tracking-wider flex items-center justify-center w-max gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span> Absensi
                                    </span>
                                @else
                                    <span
                                        class="px-3 py-1.5 bg-purple-50 text-purple-600 border border-purple-100 rounded-xl text-xs font-black uppercase tracking-wider flex items-center justify-center w-max gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-purple-500 animate-pulse"></span>
                                        Keaktifan
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-5 text-center">
                                <div class="flex justify-center items-center gap-2.5">

                                    @if ($laporan->jenis_laporan == 'Absensi')
                                        <a href="{{ route('laporan.absensi', $laporan->id) }}" target="_blank"
                                            class="bg-white border-2 border-blue-100 text-blue-600 hover:bg-blue-600 hover:text-white px-3.5 py-2 rounded-xl text-xs font-bold transition-all duration-300 flex items-center gap-1.5 shadow-sm hover:shadow-md hover:shadow-blue-500/10 hover:-translate-y-0.5">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Lihat
                                        </a>

                                        <a href="{{ route('laporan.absensi', ['id' => $laporan->id, 'download' => 1]) }}"
                                            class="bg-gradient-to-r from-emerald-600 to-green-500 hover:from-emerald-700 hover:to-green-600 text-white px-4 py-2 rounded-xl text-xs font-black transition-all duration-300 flex items-center gap-1.5 shadow-md shadow-emerald-500/10 hover:shadow-lg hover:shadow-emerald-500/20 hover:-translate-y-0.5">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4">
                                                </path>
                                            </svg>
                                            Cetak Word
                                        </a>
                                    @elseif ($laporan->jenis_laporan == 'Poin Keaktifan')
                                        <a href="{{ route('laporan.poin', ['bulan' => request('bulan'), 'tahun' => request('tahun')]) }}"
                                            target="_blank"
                                            class="bg-white border-2 border-blue-100 text-blue-600 hover:bg-blue-600 hover:text-white px-3.5 py-2 rounded-xl text-xs font-bold transition-all duration-300 flex items-center gap-1.5 shadow-sm hover:shadow-md hover:shadow-blue-500/10 hover:-translate-y-0.5">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Lihat
                                        </a>

                                        <a href="{{ route('laporan.poin', ['download' => 'pdf', 'bulan' => request('bulan'), 'tahun' => request('tahun')]) }}"
                                            class="bg-gradient-to-r from-red-600 to-rose-500 hover:from-red-700 hover:to-rose-600 text-white px-4 py-2 rounded-xl text-xs font-black transition-all duration-300 flex items-center gap-1.5 shadow-md shadow-red-500/10 hover:shadow-lg hover:shadow-red-500/20 hover:-translate-y-0.5">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4">
                                                </path>
                                            </svg>
                                            Cetak PDF
                                        </a>
                                    @else
                                        <a href="{{ route('laporan.cetakWord', ['devisi' => urlencode($laporan->devisi)]) }}"
                                            target="_blank"
                                            class="bg-white border-2 border-blue-100 text-blue-600 hover:bg-blue-600 hover:text-white px-3.5 py-2 rounded-xl text-xs font-bold transition-all duration-300 flex items-center gap-1.5 shadow-sm hover:shadow-md hover:shadow-blue-500/10 hover:-translate-y-0.5">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Pratinjau
                                        </a>

                                        <a href="{{ route('laporan.cetakWord', ['devisi' => urlencode($laporan->devisi), 'download' => 1]) }}"
                                            class="bg-gradient-to-r from-emerald-600 to-green-500 hover:from-emerald-700 hover:to-green-600 text-white px-4 py-2 rounded-xl text-xs font-black transition-all duration-300 flex items-center gap-1.5 shadow-md shadow-emerald-500/10 hover:shadow-lg hover:shadow-emerald-500/20 hover:-translate-y-0.5">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4">
                                                </path>
                                            </svg>
                                            Cetak Word
                                        </a>
                                    @endif

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-16 text-center bg-gray-50/40">
                                <div class="flex flex-col items-center justify-center text-gray-400 max-w-sm mx-auto">
                                    <div class="bg-gray-100 p-4 rounded-3xl mb-3 shadow-inner border border-gray-200/50">
                                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4a2 2 0 012-2m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                            </path>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-black text-gray-700 tracking-tight">Data Arsip Laporan Kosong
                                    </p>
                                    <p class="text-xs text-gray-400 mt-1 font-medium">Tidak ada data laporan yang
                                        diterbitkan atau cocok dengan filter pencarian pada periode ini.</p>
                                    @if (request('search') || request('bulan') || request('tahun'))
                                        <a href="{{ route('laporan', ['jenis' => $jenis]) }}"
                                            class="mt-4 px-4 py-2 bg-white border border-gray-200 hover:border-blue-500 rounded-xl text-xs font-bold text-blue-600 transition-all shadow-sm">
                                            Reset Filter Waktu
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <style>
        @keyframes fadeInDown {
            0% {
                opacity: 0;
                transform: translateY(-12px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-down {
            animation: fadeInDown 0.4s ease-out forwards;
        }
    </style>
@endsection
