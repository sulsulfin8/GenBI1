@extends('layout.app')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            @if (auth()->user()->role == 'bendahara')
                Laporan Rancang Anggaran Kegiatan
            @else
                Cetak Laporan
            @endif
        </h1>
        <p class="text-gray-500 text-sm">Lihat, kelola, dan cetak laporan keseluruhan sistem kegiatan mahasiswa.</p>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-soft border border-gray-50">

        <div class="flex flex-col md:flex-row justify-between items-center mb-4 text-sm text-gray-600 gap-4">
            <form action="{{ route('laporan') }}" method="GET" class="flex items-center gap-3 w-full md:w-auto">

                @if (auth()->user()->role != 'bendahara')
                    <div class="flex items-center gap-2">
                        <span class="hidden lg:inline text-gray-500">Jenis:</span>
                        <select name="jenis" onchange="this.form.submit()"
                            class="border border-gray-300 rounded-lg px-3 py-1.5 focus:outline-none focus:border-primary-blue focus:ring-1 focus:ring-primary-blue bg-white font-medium text-gray-700 min-w-[160px]">
                            <option value="Rancang Anggaran" {{ $jenis == 'Rancang Anggaran' ? 'selected' : '' }}>Laporan
                                Rancang Anggaran</option>
                            <option value="Absensi" {{ $jenis == 'Absensi' ? 'selected' : '' }}>Laporan Absensi</option>
                            <option value="Poin Keaktifan" {{ $jenis == 'Poin Keaktifan' ? 'selected' : '' }}>Laporan Poin
                                Keaktifan</option>
                        </select>
                    </div>
                @else
                    <input type="hidden" name="jenis" value="Rancang Anggaran">
                @endif

                <div class="flex items-center gap-2">
                    <span>Cari:</span>
                    <input type="text" name="search" value="{{ $search }}" placeholder="Cari judul/lokasi..."
                        class="border border-gray-300 rounded-lg px-3 py-1.5 focus:outline-none focus:border-primary-blue focus:ring-1 focus:ring-primary-blue text-sm w-40 md:w-56">
                    <button type="submit" class="hidden">Cari</button>
                </div>
            </form>
        </div>
        <div class="overflow-x-auto border border-gray-100 rounded-xl mb-4">
            <table class="w-full text-left border-collapse min-w-max">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 border-b border-gray-200">
                        <th class="py-3 px-4 font-semibold text-sm w-12 text-center">No</th>
                        <th class="py-3 px-4 font-semibold text-sm">Judul Laporan</th>
                        <th class="py-3 px-4 font-semibold text-sm">Devisi</th>
                        <th class="py-3 px-4 font-semibold text-sm">Jenis Laporan</th>
                        <th class="py-3 px-4 font-semibold text-sm">Tanggal Laporan</th>
                        <th class="py-3 px-4 font-semibold text-sm text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="text-gray-600 text-sm">
                    @forelse($laporans as $laporan)
                        <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition">
                            <td class="py-3 px-4 text-center">{{ $loop->iteration }}</td>
                            <td class="py-3 px-4 font-medium text-gray-800">{{ $laporan->judul_laporan }}</td>
                            <td class="py-3 px-4">{{ $laporan->devisi }}</td>
                            <td class="py-3 px-4"><span
                                    class="px-2 py-1 bg-blue-50 text-blue-600 rounded-lg text-xs">{{ $laporan->jenis_laporan }}</span>
                            </td>
                            <td class="py-3 px-4">{{ $laporan->tanggal_laporan }}</td>
                            <td class="py-3 px-4 text-center">
                                <div class="flex justify-center items-center gap-2">

                                    @if ($laporan->jenis_laporan == 'Absensi')
                                        <a href="{{ route('laporan.absensi', $laporan->id) }}" target="_blank"
                                            class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-xs font-bold transition flex items-center gap-1 shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Lihat
                                        </a>

                                        <a href="{{ route('laporan.absensi', ['id' => $laporan->id, 'download' => 1]) }}"
                                            class="bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded-lg text-xs font-bold transition flex items-center gap-1 shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4">
                                                </path>
                                            </svg>
                                            Download
                                        </a>
                                    @elseif ($laporan->jenis_laporan == 'Poin Keaktifan')
                                        <a href="{{ route('laporan.poin') }}" target="_blank"
                                            class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-xs font-bold transition flex items-center gap-1 shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Lihat
                                        </a>

                                        <a href="{{ route('laporan.poin', ['download' => 'pdf']) }}"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg text-xs font-bold transition flex items-center gap-1 shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4">
                                                </path>
                                            </svg>
                                            Download PDF
                                        </a>
                                    @else
                                        <a href="{{ route('laporan.cetakWord', ['devisi' => urlencode($laporan->devisi)]) }}"
                                            target="_blank"
                                            class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-xs font-bold transition flex items-center gap-1 shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Lihat
                                        </a>

                                        <a href="{{ route('laporan.cetakWord', ['devisi' => urlencode($laporan->devisi), 'download' => 1]) }}"
                                            class="bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded-lg text-xs font-bold transition flex items-center gap-1 shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4">
                                                </path>
                                            </svg>
                                            Download Word
                                        </a>
                                    @endif

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-10 text-center text-gray-500 bg-gray-50/50">
                                Tidak ada data laporan yang tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
