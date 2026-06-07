@extends('layout.app')

@section('content')

    @if (session('success'))
        <div
            class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-600 rounded-xl text-sm font-bold flex items-center gap-2 shadow-sm animate-fade-in-down">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    @if (auth()->user()->role == 'anggota')
        @php
            $myData = null;
            foreach ($rekapData as $rd) {
                if ($rd->nim == (auth()->user()->nim ?? auth()->user()->username)) {
                    $myData = $rd;
                    break;
                }
            }

            // LOGIKA SMART PARSER: Memisahkan Poin Pelanggaran dan Apresiasi
            $totalPelanggaranManual = 0;
            $totalApresiasiManual = 0;

            if ($myData) {
                $ketText = $myData->keterangan ?? '';

                // Cari angka yang diawali + atau - (Contoh: +5, -3, = -2, dll)
                if (preg_match_all('/([+-])\s*(\d+)/', $ketText, $matches)) {
                    for ($i = 0; $i < count($matches[0]); $i++) {
                        $sign = $matches[1][$i];
                        $val = (int) $matches[2][$i];
                        if ($sign == '+') {
                            $totalPelanggaranManual += $val;
                        } else {
                            $totalApresiasiManual += $val;
                        }
                    }
                }

                if ($totalPelanggaranManual == 0 && $totalApresiasiManual == 0 && $myData->poin_manual != 0) {
                    if ($myData->poin_manual > 0) {
                        $totalPelanggaranManual = $myData->poin_manual;
                    } else {
                        $totalApresiasiManual = abs($myData->poin_manual);
                    }
                }
            }
        @endphp

        <div class="mb-6 mt-2">
            <h1 class="text-2xl font-bold text-gray-800">Rapor Keaktifan Saya</h1>
            <p class="text-gray-500 text-sm">Pantau akumulasi poin dan riwayat kegiatan Anda di GenBI Sultra.</p>
        </div>

        @if ($myData)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <div
                    class="bg-gradient-to-br from-blue-600 to-primary-blue rounded-3xl p-6 shadow-lg shadow-blue-500/30 text-white relative overflow-hidden group">
                    <div
                        class="absolute -right-6 -top-6 w-32 h-32 bg-white opacity-10 rounded-full group-hover:scale-150 transition-transform duration-700">
                    </div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <span
                                class="bg-white/20 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest backdrop-blur-sm">Total
                                Poin</span>
                            <svg class="w-8 h-8 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                                </path>
                            </svg>
                        </div>
                        <h2 class="text-6xl font-black mb-1 drop-shadow-md">{{ $myData->total_poin }}</h2>
                        <p class="text-sm font-medium text-blue-100">Akumulasi Poin Anda Saat Ini</p>
                    </div>
                </div>

                @php
                    $spColors = [
                        'Aman' => 'from-emerald-500 to-green-500 shadow-emerald-500/30 text-white',
                        'SP 1' => 'from-yellow-400 to-amber-500 shadow-yellow-500/30 text-white',
                        'SP 2' => 'from-orange-500 to-red-500 shadow-orange-500/30 text-white',
                        'SP 3' => 'from-red-600 to-red-800 shadow-red-500/30 text-white',
                    ];
                    $bgStatus = $spColors[$myData->sp] ?? 'from-gray-400 to-gray-500';
                @endphp
                <div class="bg-gradient-to-br {{ $bgStatus }} rounded-3xl p-6 shadow-lg relative overflow-hidden group">
                    <div
                        class="absolute -right-6 -top-6 w-32 h-32 bg-white opacity-10 rounded-full group-hover:scale-150 transition-transform duration-700">
                    </div>
                    <div class="relative z-10 flex flex-col h-full justify-between">
                        <div class="flex items-center justify-between mb-2">
                            <span
                                class="bg-white/20 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest backdrop-blur-sm">Status
                                SP</span>
                            <svg class="w-8 h-8 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-4xl font-black mb-1 uppercase tracking-wider drop-shadow-md">{{ $myData->sp }}
                            </h2>
                            <p class="text-sm font-medium opacity-90">
                                {{ $myData->sp == 'Aman' ? 'Kinerja Anda sangat baik, pertahankan!' : 'Perhatian! Poin Anda telah mencapai ambang batas peringatan.' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-6 shadow-soft border border-gray-100 flex flex-col justify-center">
                    <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4">Rincian Sumber Poin</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-2.5 rounded-2xl bg-red-50 border border-red-100">
                            <div class="flex items-center gap-3">
                                <div class="bg-red-500 text-white p-1.5 rounded-lg"><svg class="w-3.5 h-3.5" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg></div>
                                <span class="text-xs font-bold text-red-900">Poin Absensi</span>
                            </div>
                            <span class="text-sm font-black text-red-600">+{{ $myData->poin_absensi }}</span>
                        </div>
                        <div
                            class="flex items-center justify-between p-2.5 rounded-2xl bg-orange-50 border border-orange-100">
                            <div class="flex items-center gap-3">
                                <div class="bg-orange-500 text-white p-1.5 rounded-lg"><svg class="w-3.5 h-3.5"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                        </path>
                                    </svg></div>
                                <span class="text-xs font-bold text-orange-900">Poin Pelanggaran</span>
                            </div>
                            <span class="text-sm font-black text-orange-600">+{{ $totalPelanggaranManual }}</span>
                        </div>
                        <div
                            class="flex items-center justify-between p-2.5 rounded-2xl bg-emerald-50 border border-emerald-100">
                            <div class="flex items-center gap-3">
                                <div class="bg-emerald-500 text-white p-1.5 rounded-lg"><svg class="w-3.5 h-3.5"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg></div>
                                <span class="text-xs font-bold text-emerald-900">Poin Apresiasi</span>
                            </div>
                            <span class="text-sm font-black text-emerald-600">-{{ $totalApresiasiManual }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 md:p-8 shadow-soft border border-gray-100">
                <div class="flex items-center gap-3 mb-6 border-b border-gray-100 pb-4">
                    <div class="bg-primary-blue text-white p-2.5 rounded-xl shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-extrabold text-gray-800">Riwayat & Catatan Poin</h3>
                        <p class="text-xs font-medium text-gray-400 mt-0.5">Daftar kegiatan, teguran, atau apresiasi dari
                            pengurus.</p>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 shadow-inner">
                    @php
                        $items = explode('|', $myData->keterangan ?? '');
                    @endphp

                    @if (!empty($myData->keterangan) && trim($myData->keterangan) !== '-' && count($items) > 0)
                        <ul class="space-y-4 text-sm font-medium text-gray-700">
                            @foreach ($items as $item)
                                @php
                                    $bersihItem = trim($item);
                                    $bersihItem = preg_replace('/(Kegiatan Lain\s*:\s*)+/i', '', $bersihItem);
                                @endphp
                                @if ($bersihItem != '' && $bersihItem != '-' && !str_contains($bersihItem, 'Absensi ()'))
                                    <li class="flex items-start gap-3 relative pl-2">
                                        <span
                                            class="absolute left-0 top-1.5 w-2 h-2 rounded-full {{ str_contains($bersihItem, '-') ? 'bg-emerald-500 shadow-emerald-500/50' : 'bg-blue-500 shadow-blue-500/50' }} flex-shrink-0 shadow-sm"></span>
                                        <span class="pl-4 leading-relaxed">{{ $bersihItem }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    @else
                        <div class="flex flex-col items-center justify-center py-8 text-gray-400">
                            <svg class="w-12 h-12 mb-3 opacity-30" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <p class="text-sm font-bold uppercase tracking-widest">Belum ada catatan aktivitas poin.</p>
                            <p class="text-xs mt-1">Anda memiliki rekam jejak yang bersih!</p>
                        </div>
                    @endif
                </div>
            </div>
        @else
            <div class="bg-white rounded-3xl p-10 shadow-soft text-center border border-gray-100">
                <p class="text-gray-500 font-medium">Data poin Anda belum tersedia atau NIM tidak ditemukan.</p>
            </div>
        @endif
    @else
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Monitoring Poin Keaktifan</h1>
            <p class="text-gray-500 text-sm">Pantau poin absensi & kegiatan. Total poin menentukan Surat Peringatan (SP).
            </p>
        </div>

        <div class="bg-white rounded-3xl p-6 shadow-soft border border-gray-50 relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                <h2 class="text-lg font-extrabold text-gray-800 w-full md:w-auto">Daftar Rekapitulasi Poin GenBI</h2>

                <form action="{{ url()->current() }}" method="GET" class="relative w-full md:w-64" id="searchForm">
                    @if (request('per_page'))
                        <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                    @endif
                    <input type="text" name="search" id="searchInput" value="{{ request('search') }}"
                        placeholder="Cari NIM / Nama..." oninput="handleSearch(this)"
                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-2 pl-10 focus:outline-none focus:border-primary-blue focus:ring-2 focus:ring-primary-blue/20 text-sm bg-gray-50 focus:bg-white transition-all font-medium">
                    <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </form>
            </div>

            <div class="overflow-x-auto border border-gray-100 rounded-2xl mb-4 shadow-sm">
                <table class="w-full text-left border-collapse min-w-max">
                    <thead>
                        <tr class="bg-gray-50/80 text-gray-600 border-b border-gray-100">
                            <th class="py-4 px-5 font-extrabold text-xs uppercase tracking-wider w-12 text-center">No</th>
                            <th class="py-4 px-5 font-extrabold text-xs uppercase tracking-wider">NIM</th>
                            <th class="py-4 px-5 font-extrabold text-xs uppercase tracking-wider">Nama Lengkap</th>
                            <th class="py-4 px-5 font-extrabold text-xs uppercase tracking-wider text-center">Poin Absensi
                            </th>
                            <th class="py-4 px-5 font-extrabold text-xs uppercase tracking-wider text-center">Poin Tambahan
                            </th>
                            <th class="py-4 px-5 font-extrabold text-xs uppercase tracking-wider text-center">Total Poin
                            </th>
                            <th class="py-4 px-5 font-extrabold text-xs uppercase tracking-wider text-center">Status SP
                            </th>
                            <th class="py-4 px-5 font-extrabold text-xs uppercase tracking-wider text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm divide-y divide-gray-50">
                        @forelse ($rekapData as $data)
                            <tr class="hover:bg-blue-50/40 transition-colors duration-200">
                                <td class="py-3 px-5 text-center text-gray-400 font-medium">{{ $loop->iteration }}</td>
                                <td class="py-3 px-5 font-mono text-xs text-gray-500">{{ $data->nim ?? '-' }}</td>
                                <td class="py-3 px-5 font-bold text-gray-800">{{ $data->nama }}</td>
                                <td class="py-3 px-5 text-center text-red-500 font-black">+{{ $data->poin_absensi }}</td>
                                <td class="py-3 px-5 text-center text-blue-500 font-black">
                                    {{ $data->poin_manual > 0 ? '+' . $data->poin_manual : $data->poin_manual }}
                                </td>
                                <td class="py-3 px-5 text-center font-black text-xl text-gray-800">{{ $data->total_poin }}
                                </td>
                                <td class="py-3 px-5 text-center">
                                    <span
                                        class="px-3 py-1.5 rounded-full text-xs font-black uppercase tracking-widest
                                        {{ $data->sp == 'Aman' ? 'bg-green-100 text-green-600' : '' }}
                                        {{ $data->sp == 'SP 1' ? 'bg-yellow-100 text-yellow-600' : '' }}
                                        {{ $data->sp == 'SP 2' ? 'bg-orange-100 text-orange-600' : '' }}
                                        {{ $data->sp == 'SP 3' ? 'bg-red-100 text-red-600' : '' }}">
                                        {{ $data->sp }}
                                    </span>
                                </td>

                                <td class="py-3 px-5 text-center">
                                    <div class="flex justify-center items-center gap-2">
                                        <button
                                            onclick="bukaModalKeterangan('{{ $data->nim }}', '{{ addslashes($data->nama) }}', '{{ addslashes($data->keterangan ?? '-') }}', '{{ $data->sp }}', '{{ $data->total_poin }}')"
                                            class="flex items-center gap-1.5 bg-gradient-to-r from-emerald-500 to-green-500 hover:from-emerald-600 hover:to-green-600 text-white px-3 py-2 rounded-xl text-xs font-bold shadow-md shadow-emerald-500/30 transition-transform hover:-translate-y-0.5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Detail
                                        </button>

                                        @if (auth()->user()->role != 'anggota')
                                            <button
                                                onclick="bukaModalPoin('{{ $data->nim }}', '{{ addslashes($data->nama) }}')"
                                                class="flex items-center gap-1.5 bg-gradient-to-r from-blue-600 to-primary-blue hover:from-blue-700 hover:to-blue-600 text-white px-3 py-2 rounded-xl text-xs font-bold shadow-md shadow-blue-500/30 transition-transform hover:-translate-y-0.5">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                                Poin
                                            </button>

                                            <button type="button"
                                                onclick="bukaModalBatalPoin('{{ $data->nim }}', '{{ addslashes($data->nama) }}', '{{ addslashes($data->keterangan ?? '-') }}')"
                                                title="Batalkan Poin"
                                                class="flex items-center gap-1.5 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-3 py-2 rounded-xl text-xs font-bold shadow-md shadow-red-500/30 transition-transform hover:-translate-y-0.5">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                                </svg>
                                                Batal
                                            </button>
                                            <div id="modalBatalPoin"
                                                class="fixed inset-0 z-[60] hidden bg-gray-900/70 backdrop-blur-sm items-center justify-center p-4 transition-all">
                                                <div
                                                    class="bg-white rounded-3xl shadow-2xl w-full max-w-md flex flex-col overflow-hidden animate-modal max-h-[80vh]">
                                                    <div
                                                        class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                                                        <h3 class="text-lg font-extrabold text-gray-800 leading-tight">
                                                            Batalkan Poin Spesifik<br>
                                                            <span id="batalNamaMhs"
                                                                class="text-red-600 text-xs font-bold bg-red-50 px-2 py-0.5 rounded-lg mt-1 inline-block"></span>
                                                        </h3>
                                                        <button onclick="tutupModalBatalPoin()"
                                                            class="text-gray-400 hover:text-red-500 hover:bg-red-50 p-2 rounded-xl transition">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                            </svg>
                                                        </button>
                                                    </div>

                                                    <div class="p-6 overflow-y-auto space-y-3 flex-1 hide-scrollbar">
                                                        <p
                                                            class="text-[11px] font-black text-gray-400 uppercase tracking-widest mb-1">
                                                            Pilih item poin yang ingin dihapus:</p>
                                                        <div id="daftarPoinBatal" class="space-y-2.5">
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="px-6 py-4 border-t border-gray-100 flex justify-end bg-gray-50/50">
                                                        <button type="button" onclick="tutupModalBatalPoin()"
                                                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-xl font-bold transition text-xs">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-12 text-center text-gray-400 font-medium">
                                    <svg class="w-12 h-12 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                        </path>
                                    </svg>
                                    Belum ada data pengguna yang terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div id="modalKeterangan"
            class="fixed inset-0 z-[60] hidden bg-gray-900/70 backdrop-blur-sm items-center justify-center p-4 transition-all">
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg p-6 relative z-[70] animate-modal">
                <div class="flex justify-between items-center mb-5 border-b border-gray-100 pb-4">
                    <h3 class="text-xl font-black text-gray-800 leading-tight">Detail Rekap Poin<br>
                        <span id="detailNamaMhs"
                            class="text-emerald-600 text-sm font-bold bg-emerald-50 px-2 py-0.5 rounded-lg mt-1 inline-block"></span>
                    </h3>
                    <button onclick="tutupModalKeterangan()"
                        class="text-gray-400 hover:text-red-500 hover:bg-red-50 p-2 rounded-xl transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="space-y-4">
                    <div class="flex items-center justify-between bg-blue-50 p-4 rounded-2xl border border-blue-100">
                        <div>
                            <p class="text-xs font-bold text-blue-500 uppercase tracking-widest">Total Poin</p>
                            <p id="detailTotalPoin" class="text-2xl font-black text-blue-700"></p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs font-bold text-blue-500 uppercase tracking-widest">Status Saat Ini</p>
                            <span id="detailStatusSP"
                                class="px-3 py-1 rounded-full text-xs font-black uppercase tracking-widest mt-1 inline-block"></span>
                        </div>
                    </div>

                    <div id="boxBacaKeterangan">
                        <label class="block text-xs font-black text-gray-500 uppercase mb-2">Riwayat & Catatan Poin</label>
                        <div
                            class="bg-gray-50 rounded-2xl p-5 border border-gray-100 max-h-60 overflow-y-auto hide-scrollbar shadow-inner">
                            <ul id="detailTeksKeterangan" class="text-sm text-gray-700 leading-relaxed space-y-3"></ul>
                        </div>
                    </div>

                    @if (auth()->user()->role != 'anggota')
                        <form id="formEditKeterangan" action="{{ route('poin.edit_keterangan') }}" method="POST"
                            class="hidden">
                            @csrf
                            <input type="hidden" name="nim" id="detailNimEdit">
                            <label class="block text-xs font-black text-blue-600 uppercase mb-2">Edit Teks
                                Keterangan</label>
                            <textarea name="keterangan" id="detailTextareaEdit" rows="5"
                                class="w-full border-2 border-blue-200 rounded-xl px-4 py-3 text-sm focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 bg-white transition-all font-medium text-gray-700 shadow-inner"></textarea>

                            <div class="flex justify-end gap-2 mt-3">
                                <button type="button" onclick="batalEditKet()"
                                    class="px-5 py-2.5 text-xs font-bold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition">Batal</button>
                                <button type="submit"
                                    class="px-6 py-2.5 text-xs font-bold text-white bg-gradient-to-r from-blue-600 to-primary-blue rounded-xl shadow-md shadow-blue-500/30 hover:-translate-y-0.5 transition">Simpan
                                    Keterangan</button>
                            </div>
                        </form>
                    @endif
                </div>

                <div class="pt-4 flex justify-between items-center mt-6 border-t border-gray-100"
                    id="footerModalKeterangan">
                    @if (auth()->user()->role != 'anggota')
                        <button type="button" onclick="mulaiEditKet()"
                            class="text-amber-600 hover:text-white hover:bg-amber-500 font-bold text-sm px-4 py-2.5 rounded-xl bg-amber-50 transition-colors flex items-center gap-2 shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                            Edit Keterangan
                        </button>
                    @else
                        <div></div>
                    @endif
                    <button type="button" onclick="tutupModalKeterangan()"
                        class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-2.5 rounded-xl font-bold transition text-sm">Tutup</button>
                </div>
            </div>
        </div>

        @if (auth()->user()->role != 'anggota')
            <div id="modalPoin"
                class="fixed inset-0 z-[60] hidden bg-gray-900/70 backdrop-blur-sm items-center justify-center p-4 transition-all">
                <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg p-6 relative z-[70] animate-modal">
                    <div class="flex justify-between items-center mb-5 border-b border-gray-100 pb-4">
                        <h3 class="text-xl font-black text-gray-800 leading-tight">Edit Poin Kegiatan<br>
                            <span id="namaMhsPoin"
                                class="text-primary-blue text-sm font-bold bg-blue-50 px-2 py-0.5 rounded-lg mt-1 inline-block"></span>
                        </h3>
                        <button onclick="tutupModalPoin()"
                            class="text-gray-400 hover:text-red-500 hover:bg-red-50 p-2 rounded-xl transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <form action="{{ route('poin.update') }}" method="POST" class="space-y-5">
                        @csrf
                        <input type="hidden" name="nim" id="inputNimPoin">
                        <div>
                            <label class="block text-xs font-black text-gray-500 uppercase mb-2">Pilih Jenis Pelanggaran /
                                Apresiasi</label>
                            <div class="relative">
                                <select id="pilihanAturan" onchange="setNilaiPoin()" required
                                    class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 bg-gray-50 cursor-pointer font-semibold text-gray-700 appearance-none transition-all">
                                    <option value="">-- Silakan Pilih Kategori --</option>
                                    <optgroup label="  Pelanggaran (+ Poin)">
                                        @php $pelanggaranArr = explode("\n", str_replace("\r", "", $info->pelanggaran ?? "")); @endphp
                                        @foreach ($pelanggaranArr as $p)
                                            @if (trim($p) != '')
                                                @php
                                                    $split = explode(':', $p);
                                                    $label = trim($split[0]);
                                                    $lowerLabel = strtolower(trim($label));

                                                    // PERBAIKAN: Memperluas filter agar mendeteksi variasi kata Alpa, Izin, Tidak Hadir, (A), dan (I)
                                                    $isAbsensi =
                                                        str_contains($lowerLabel, 'alpa') ||
                                                        str_contains($lowerLabel, 'izin') ||
                                                        str_contains($lowerLabel, 'tidak hadir') ||
                                                        str_contains($lowerLabel, '(a)') ||
                                                        str_contains($lowerLabel, '(i)');
                                                @endphp
                                                @if (!$isAbsensi)
                                                    @php
                                                        preg_match('/-?\d+/', $split[1] ?? '', $matches);
                                                        $val = isset($matches[0]) ? (int) $matches[0] : 0;
                                                    @endphp
                                                    <option value="{{ $val }}|{{ $label }}">
                                                        {{ $label }} ({{ $val > 0 ? '+' . $val : $val }} Poin)
                                                    </option>
                                                @endif
                                            @endif
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="🔵 Aturan QRIS (+ Poin)">
                                        @php $qrisArr = explode("\n", str_replace("\r", "", $info->qris ?? "")); @endphp
                                        @foreach ($qrisArr as $q)
                                            @if (trim($q) != '')
                                                @php
                                                    $split = explode(':', $q);
                                                    $label = trim($split[0]);
                                                    preg_match('/-?\d+/', $split[1] ?? '', $matches);
                                                    $val = isset($matches[0]) ? (int) $matches[0] : 0;
                                                @endphp
                                                <option value="{{ $val }}|{{ $label }}">
                                                    {{ $label }} ({{ $val > 0 ? '+' . $val : $val }} Poin)</option>
                                            @endif
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="🟢 Apresiasi (- Poin)">
                                        @php $apresiasiArr = explode("\n", str_replace("\r", "", $info->apresiasi ?? "")); @endphp
                                        @foreach ($apresiasiArr as $a)
                                            @if (trim($a) != '')
                                                @php
                                                    $split = explode(':', $a);
                                                    $label = trim($split[0]);
                                                    preg_match('/-?\d+/', $split[1] ?? '', $matches);
                                                    $val = isset($matches[0]) ? (int) $matches[0] : 0;
                                                @endphp
                                                <option value="{{ $val }}|{{ $label }}">
                                                    {{ $label }} ({{ $val > 0 ? '+' . $val : $val }} Poin)</option>
                                            @endif
                                        @endforeach
                                    </optgroup>
                                </select>
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-4">
                            <div class="col-span-1">
                                <label class="block text-xs font-black text-gray-500 uppercase mb-2">Nilai Poin</label>
                                <input type="number" name="nilai_poin" id="inputNilai" required readonly
                                    class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 bg-gray-100 text-center font-black text-lg text-primary-blue shadow-inner pointer-events-none">
                            </div>
                            <div class="col-span-2">
                                <label class="block text-xs font-black text-gray-500 uppercase mb-2">Keterangan
                                    Tambahan</label>
                                <input type="text" name="keterangan" id="inputKeterangan" required
                                    class="w-full border-2 border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 rounded-xl px-4 py-3 text-sm font-semibold text-gray-700 transition-all">
                            </div>
                        </div>

                        <div class="pt-4 flex justify-end gap-3 border-t border-gray-100 mt-6">
                            <button type="button" onclick="tutupModalPoin()"
                                class="px-5 py-2.5 text-gray-600 font-bold bg-gray-100 hover:bg-gray-200 rounded-xl text-sm transition">Batal</button>
                            <button type="submit"
                                class="bg-gradient-to-r from-blue-600 to-primary-blue hover:from-blue-700 hover:to-blue-600 text-white px-8 py-2.5 rounded-xl text-sm font-bold shadow-md shadow-blue-500/30 transition hover:-translate-y-0.5">Simpan
                                Poin</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

        <script>
            // --- FITUR BARU: LOGIKA PENCARIAN OTOMATIS ---
            let typingTimer;
            const doneTypingInterval = 500;

            function handleSearch(inputElement) {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(function() {
                    document.getElementById('searchForm').submit();
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

            let rawKeteranganGlobal = "";

            function bukaModalKeterangan(nim, nama, keterangan, sp, totalPoin) {
                document.getElementById('detailNamaMhs').innerText = nama;
                document.getElementById('detailTotalPoin').innerText = totalPoin;

                const badgeSP = document.getElementById('detailStatusSP');
                badgeSP.innerText = sp;
                badgeSP.className = "px-3 py-1.5 rounded-full text-xs font-black uppercase tracking-widest mt-1 inline-block ";

                if (sp === 'Aman') badgeSP.className += 'bg-green-100 text-green-600';
                else if (sp === 'SP 1') badgeSP.className += 'bg-yellow-100 text-yellow-600';
                else if (sp === 'SP 2') badgeSP.className += 'bg-orange-100 text-orange-600';
                else if (sp === 'SP 3') badgeSP.className += 'bg-red-100 text-red-600';

                // Bersihkan dan siapkan teks untuk diedit
                let cleanedKeteranganArray = [];
                if (!keterangan || keterangan === "-" || keterangan.trim() === "") {
                    rawKeteranganGlobal = "";
                } else {
                    const splitKet = keterangan.includes('|') ? keterangan.split("|") : [keterangan];
                    splitKet.forEach(item => {
                        let textItem = item.trim();
                        textItem = textItem.replace(/(Kegiatan Lain\s*:\s*)+/gi, "");
                        if (textItem !== "" && textItem !== "Absensi ()") {
                            cleanedKeteranganArray.push(textItem);
                        }
                    });
                    rawKeteranganGlobal = cleanedKeteranganArray.join(' | ');
                }

                const formEdit = document.getElementById('formEditKeterangan');
                const boxBaca = document.getElementById('boxBacaKeterangan');
                const footerInfo = document.getElementById('footerModalKeterangan');

                if (formEdit) {
                    // Isi nilai ke dalam form
                    document.getElementById('detailNimEdit').value = nim;
                    document.getElementById('detailTextareaEdit').value = rawKeteranganGlobal;

                    // Langsung aktifkan form edit dan sembunyikan mode baca lama
                    formEdit.classList.remove('hidden');
                    boxBaca.classList.add('hidden');

                    if (footerInfo) {
                        footerInfo.classList.add('hidden');
                    }
                }

                const modal = document.getElementById('modalKeterangan');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.style.overflow = 'hidden';
            }

            function mulaiEditKet() {
                // Fungsi ini dibiarkan kosong karena form edit sudah langsung terbuka
            }

            function batalEditKet() {
                // PERBAIKAN: Jika klik batal, langsung tutup keseluruhan popup
                tutupModalKeterangan();
            }

            function tutupModalKeterangan() {
                const modal = document.getElementById('modalKeterangan');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.style.overflow = 'auto';
            }

            function bukaModalPoin(nim, nama) {
                document.getElementById('inputNimPoin').value = nim;
                document.getElementById('namaMhsPoin').innerText = nama;
                document.getElementById('pilihanAturan').value = "";
                document.getElementById('inputNilai').value = "";
                document.getElementById('inputKeterangan').value = "";
                const modal = document.getElementById('modalPoin');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.style.overflow = 'hidden';
            }

            function tutupModalPoin() {
                const modal = document.getElementById('modalPoin');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.style.overflow = 'auto';
            }

            function setNilaiPoin() {
                const dropdown = document.getElementById('pilihanAturan');
                const dataPilihan = dropdown.value;
                if (dataPilihan) {
                    const pecah = dataPilihan.split('|');
                    const poinValue = parseInt(pecah[0]);
                    const ketText = pecah.slice(1).join('|');
                    document.getElementById('inputNilai').value = poinValue;
                    const sign = poinValue > 0 ? '+' : '';
                    document.getElementById('inputKeterangan').value = ketText + " = " + sign + poinValue + " Poin";
                } else {
                    document.getElementById('inputNilai').value = "";
                    document.getElementById('inputKeterangan').value = "";
                }
            }
            // --- LOGIKA MODAL PEMBATALAN SELEKTIF ---
            // --- LOGIKA MODAL PEMBATALAN SELEKTIF (VERSI AJAX / TANPA KEDIP) ---
            let hasPoinChanged = false; // Flag penanda jika ada data yang terhapus

            function bukaModalBatalPoin(nim, nama, keterangan) {
                document.getElementById('batalNamaMhs').innerText = nama;
                const container = document.getElementById('daftarPoinBatal');
                container.innerHTML = "";

                if (!keterangan || keterangan === "-" || keterangan.trim() === "") {
                    container.innerHTML =
                        "<p class='italic text-gray-400 text-xs text-center py-6'>Belum ada catatan aktivitas poin manual.</p>";
                } else {
                    const splitKet = keterangan.includes('|') ? keterangan.split("|") : [keterangan];
                    let validItemsCount = 0;

                    splitKet.forEach((item, index) => {
                        let textItem = item.trim();
                        if (textItem !== "" && textItem !== "-" && !textItem.includes("Absensi ()")) {
                            validItemsCount++;

                            let isPlus = textItem.includes('+');
                            let divItem = document.createElement('div');
                            divItem.className =
                                "flex items-center justify-between p-3 bg-white border border-gray-100 rounded-2xl shadow-sm hover:border-red-300 transition-all gap-3";

                            // KUNCI PERBAIKAN: Form lama dihapus, diganti jadi tombol pemicu JavaScript
                            divItem.innerHTML = `
                                <div class="flex items-center gap-2 max-w-[70%]">
                                    <span class="w-2 h-2 rounded-full ${isPlus ? 'bg-red-500 animate-pulse' : 'bg-emerald-500'} flex-shrink-0"></span>
                                    <span class="text-xs font-bold text-gray-700 leading-relaxed">${textItem}</span>
                                </div>
                                <button type="button" onclick="hapusItemPoinAjax('${nim}', '${nama}', ${index})" class="px-3 py-1.5 bg-red-50 hover:bg-red-500 text-red-600 hover:text-white rounded-xl text-[11px] font-black transition-all shadow-sm">
                                    Hapus
                                </button>
                            `;
                            container.appendChild(divItem);
                        }
                    });

                    if (validItemsCount === 0) {
                        container.innerHTML =
                            "<p class='italic text-gray-400 text-xs text-center py-6'>Belum ada catatan aktivitas poin manual.</p>";
                    }
                }

                const modal = document.getElementById('modalBatalPoin');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.style.overflow = 'hidden';
            }

            // --- FUNGSI BARU: Hapus Data ke Database di Belakang Layar ---
            function hapusItemPoinAjax(nim, nama, index) {
                if (!confirm('Apakah Anda yakin ingin membatalkan item poin ini?')) return;

                // Ambil token keamanan Laravel secara otomatis
                const csrfToken = document.querySelector('input[name="_token"]').value;

                fetch(`{{ url('/poin') }}/${nim}/batal`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json' // Minta Laravel mengembalikan data JSON, bukan memuat halaman
                        },
                        body: JSON.stringify({
                            item_index: index
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            hasPoinChanged = true;
                            // Perbarui isi popup secara instan tanpa berkedip sedikitpun!
                            bukaModalBatalPoin(nim, nama, data.new_keterangan);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan koneksi saat menghapus.');
                    });
            }

            function tutupModalBatalPoin() {
                const modal = document.getElementById('modalBatalPoin');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.style.overflow = 'auto';

                // Jika selama popup terbuka ada poin yang sempat dihapus, refresh tabel utama HANYA SAAT TOMBOL TUTUP DITEKAN
                if (hasPoinChanged) {
                    window.location.reload();
                }
            }

            // ==============================================================
            // KODE OTOMATIS: BUKA KEMBALI POPUP SETELAH HALAMAN REFRESH
            // ==============================================================
            @if (session('open_modal_batal_nim'))
                @foreach ($rekapData as $rd)
                    @if ($rd->nim == session('open_modal_batal_nim'))
                        document.addEventListener("DOMContentLoaded", function() {
                            bukaModalBatalPoin('{{ $rd->nim }}', '{{ addslashes($rd->nama) }}',
                                '{{ addslashes($rd->keterangan ?? '-') }}');
                        });
                    @endif
                @endforeach
            @endif
        </script>
    @endif

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
            animation: fadeInDown 0.5s ease-out forwards;
        }

        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
@endsection
