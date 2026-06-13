@extends('layout.app')

@section('content')
    @php
        // Mengatur Default Nilai Beasiswa agar saat data kosong, teks bawaan tetap muncul
        $defaultKriteria =
            "Mahasiswa aktif dan terdata pada PDDikti.\nTelah menyelesaikan min. 40 SKS (berada di semester 4 s/d semester 6) pada Prodi yang ditentukan.\nMemiliki IPK minimal 3.00 (skala 4.00).\nUsia maksimal 23 tahun (belum genap 24 tahun) saat menerima beasiswa.\nMembuat Resume Pribadi (CV).\nMembuat Surat Motivasi (termasuk rencana karir setelah lulus).\nTidak sedang menerima beasiswa/ikatan dinas dari instansi lain.\nMemiliki pengalaman aktivitas sosial yang bermanfaat bagi masyarakat.\nBerasal dari keluarga berlatar belakang ekonomi pra sejahtera (kurang mampu).\nTidak melanggar norma kampus, sosial, serta bebas pidana & narkoba.\nBersedia berperan aktif dalam komunitas GenBI dan tunduk pada seluruh syarat ketentuan program beasiswa Bank Indonesia.";

        $defaultDokumen =
            "Biodata Mahasiswa (sesuai lampiran).\nSalinan KTP atau KTM yang masih berlaku.\nSalinan Kartu Keluarga (KK).\nLembar Kartu Hasil Studi (KHS) 3 semester terakhir.\nSurat Keterangan Aktif Kuliah.\nResume Pribadi (CV).\nMotivation Letter (dalam Bahasa Indonesia).\nSurat Rekomendasi dari 1 tokoh (akademik/non-akademik).\nSurat Keterangan tidak sedang menerima beasiswa instansi lain.\nSurat Keterangan Keluarga Tidak Mampu (dari kelurahan/kecamatan).\nSurat Pernyataan kesanggupan aktif di komunitas GenBI.\nSalinan buku rekening bank (bagian depan dalam) atas nama mahasiswa.";

        $valKriteria = !empty($info->kriteria_beasiswa) ? $info->kriteria_beasiswa : $defaultKriteria;
        $valDokumen = !empty($info->dokumen_beasiswa) ? $info->dokumen_beasiswa : $defaultDokumen;
    @endphp

    <div class="flex items-center gap-3 mb-6 animate-fade-in-down">
        <div class="bg-primary-blue text-white p-2.5 rounded-xl shadow-blue-glow flex-shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                </path>
            </svg>
        </div>
        <div>
            <h1 class="text-2xl font-extrabold text-gray-800 tracking-tight leading-none">Dashboard</h1>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div onclick="toggleModal('modalInfoGenbi')"
            class="relative overflow-hidden bg-gradient-to-br from-blue-500 to-blue-700 rounded-3xl p-6 shadow-lg shadow-blue-500/30 cursor-pointer hover:-translate-y-2 hover:shadow-2xl hover:shadow-blue-500/40 transition-all duration-300 group">
            <div
                class="absolute -right-6 -top-6 w-24 h-24 bg-white opacity-10 rounded-full group-hover:scale-150 transition-transform duration-700">
            </div>
            <div class="relative flex items-center gap-5">
                <div
                    class="bg-white/20 p-4 rounded-2xl text-white backdrop-blur-sm group-hover:rotate-12 transition-transform duration-300 border border-white/20 shadow-inner">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-blue-100 text-xs font-bold mb-1 tracking-wider uppercase">Informasi</p>
                    <h3 class="text-2xl font-black text-white tracking-wide">Tentang GenBI</h3>
                </div>
            </div>
        </div>

        <div onclick="toggleModal('modalInfoPoin')"
            class="relative overflow-hidden bg-gradient-to-br from-blue-500 to-blue-700 rounded-3xl p-6 shadow-lg shadow-blue-500/30 cursor-pointer hover:-translate-y-2 hover:shadow-2xl hover:shadow-blue-500/40 transition-all duration-300 group">
            <div
                class="absolute -right-6 -top-6 w-24 h-24 bg-white opacity-10 rounded-full group-hover:scale-150 transition-transform duration-700">
            </div>
            <div class="relative flex items-center gap-5">
                <div
                    class="bg-white/20 p-4 rounded-2xl text-white backdrop-blur-sm group-hover:-rotate-12 transition-transform duration-300 border border-white/20 shadow-inner">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-blue-100 text-xs font-bold mb-1 tracking-wider uppercase">Status Poin</p>
                    <h3 class="text-2xl font-black text-white tracking-wide">Aturan Poin</h3>
                </div>
            </div>
        </div>

        <div onclick="toggleModal('modalInfoBeasiswa')"
            class="relative overflow-hidden bg-gradient-to-br from-blue-500 to-blue-700 rounded-3xl p-6 shadow-lg shadow-blue-500/30 cursor-pointer hover:-translate-y-2 hover:shadow-2xl hover:shadow-blue-500/40 transition-all duration-300 group">
            <div
                class="absolute -right-6 -top-6 w-24 h-24 bg-white opacity-10 rounded-full group-hover:scale-150 transition-transform duration-700">
            </div>
            <div class="relative flex items-center gap-5">
                <div
                    class="bg-white/20 p-4 rounded-2xl text-white backdrop-blur-sm group-hover:rotate-12 transition-transform duration-300 border border-white/20 shadow-inner">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-blue-100 text-xs font-bold mb-1 tracking-wider uppercase">Pendaftaran</p>
                    <h3 class="text-2xl font-black text-white tracking-wide">Syarat & Dokumen</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- AREA GALERI DOKUMENTASI -->
    <div class="bg-white p-6 rounded-2xl shadow-soft border border-gray-50 mb-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                <svg class="w-5 h-5 text-primary-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
                Dokumentasi Kegiatan GenBI USN Kolaka
            </h3>
            @if (auth()->check() && in_array(auth()->user()->role, ['admin', 'sekretaris']))
                <div class="flex gap-2">
                    <button onclick="toggleModal('modalKelolaDokumentasi')"
                        class="bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white px-4 py-2 rounded-xl text-sm font-bold transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 15.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                            </path>
                        </svg> Kelola Foto
                    </button>
                    <button onclick="toggleModal('modalUploadDokumentasi')"
                        class="bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white px-4 py-2 rounded-xl text-sm font-bold transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg> Tambah Foto
                    </button>
                </div>
            @endif
        </div>

        <div id="carouselGaleriDisplay"
            class="relative w-full h-[350px] md:h-[450px] rounded-2xl overflow-hidden group shadow-inner bg-gray-900 z-0">
            @if (isset($galeri) && count($galeri) > 0)
                @foreach ($galeri as $index => $foto)
                    <div
                        class="carousel-item absolute inset-0 transition-opacity duration-1000 ease-in-out {{ $index == 0 ? 'opacity-100 font-visible-slide' : 'opacity-0' }}">
                        <img src="{{ asset('dokumentasi/' . $foto) }}"
                            class="absolute inset-0 w-full h-full object-cover blur-xl opacity-60 scale-110 pointer-events-none"
                            alt="blur">
                        <img src="{{ asset('dokumentasi/' . $foto) }}" alt="Dokumentasi"
                            class="relative z-10 w-full h-full object-contain drop-shadow-2xl">
                    </div>
                @endforeach
            @else
                <div
                    class="carousel-item absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-100 font-visible-slide">
                    <img src="{{ asset('bahan1/1.jpg') }}"
                        class="absolute inset-0 w-full h-full object-cover blur-xl opacity-60 scale-110 pointer-events-none"
                        alt="blur">
                    <img src="{{ asset('bahan1/1.jpg') }}" alt="Default"
                        class="relative z-10 w-full h-full object-contain drop-shadow-2xl">
                </div>
            @endif
            <div
                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent pointer-events-none z-10">
            </div>
            <div class="absolute bottom-6 left-6 md:bottom-8 md:left-8 text-white z-20">
                <span
                    class="bg-primary-blue text-xs font-bold px-3 py-1 rounded-full uppercase tracking-widest mb-3 inline-block">Galeri</span>
                <h4 class="text-2xl md:text-3xl font-extrabold shadow-sm">Momen Kebersamaan</h4>
                <p class="text-sm md:text-base opacity-90 mt-1 max-w-xl">Dokumentasi kegiatan GenBI Sulawesi Tenggara
                    Komisariat USN Kolaka.</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-[2rem] p-6 md:p-8 shadow-soft border border-gray-100 mb-8 relative z-20 overflow-x-auto">
        <h2
            class="text-xl font-black text-gray-800 mb-10 text-center uppercase tracking-widest border-b border-gray-50 pb-5">
            Struktur Organisasi GenBI</h2>
        <div class="min-w-[950px] flex flex-col items-center mt-4">
            <div class="flex justify-center relative z-10 w-full">
                <div
                    class="bg-white p-4 rounded-3xl border-t-8 border-blue-600 shadow-xl flex items-center justify-center gap-4 w-72">
                    <div
                        class="w-14 h-14 rounded-full overflow-hidden border-2 border-blue-100 shadow-sm bg-gray-50 flex-shrink-0">
                        <img src="{{ isset($ketua) && $ketua->photo ? asset('storage/' . $ketua->photo) : asset('img/default.png') }}"
                            class="w-full h-full object-cover object-top">
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-blue-600 uppercase tracking-widest">Ketua Komisariat</p>
                        <h3 class="text-sm font-black text-gray-800 leading-tight mt-0.5">
                            {{ $ketua->name ?? 'Belum Ditentukan' }}</h3>
                    </div>
                </div>
            </div>
            <div class="flex justify-center w-full">
                <div class="w-0.5 h-10 bg-gray-300"></div>
            </div>
            <div class="relative flex w-full max-w-2xl mx-auto z-10">
                <div class="absolute top-0 left-[25%] right-[25%] h-0.5 bg-gray-300"></div>
                <div class="absolute top-0 left-1/2 -translate-x-1/2 w-0.5 h-[calc(100%+2.5rem)] bg-gray-300 -z-10"></div>
                <div class="w-1/2 flex flex-col items-center">
                    <div class="w-0.5 h-6 bg-gray-300"></div>
                    <div
                        class="bg-white p-3 rounded-2xl border-t-4 border-emerald-500 shadow-lg flex items-center justify-center gap-3 w-64 hover:-translate-y-1 transition-transform">
                        <div
                            class="w-10 h-10 rounded-full overflow-hidden border-2 border-emerald-100 bg-gray-50 flex-shrink-0">
                            <img src="{{ isset($sekretaris) && $sekretaris->photo ? asset('storage/' . $sekretaris->photo) : asset('img/default.png') }}"
                                class="w-full h-full object-cover object-top">
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-emerald-600 uppercase tracking-widest">Sekretaris Umum</p>
                            <h3 class="text-xs font-black text-gray-800 leading-tight mt-0.5">
                                {{ $sekretaris->name ?? 'Belum Ditentukan' }}</h3>
                        </div>
                    </div>
                </div>
                <div class="w-1/2 flex flex-col items-center">
                    <div class="w-0.5 h-6 bg-gray-300"></div>
                    <div
                        class="bg-white p-3 rounded-2xl border-t-4 border-amber-500 shadow-lg flex items-center justify-center gap-3 w-64 hover:-translate-y-1 transition-transform">
                        <div
                            class="w-10 h-10 rounded-full overflow-hidden border-2 border-amber-100 bg-gray-50 flex-shrink-0">
                            <img src="{{ isset($bendahara) && $bendahara->photo ? asset('storage/' . $bendahara->photo) : asset('img/default.png') }}"
                                class="w-full h-full object-cover object-top">
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-amber-600 uppercase tracking-widest">Bendahara Umum</p>
                            <h3 class="text-xs font-black text-gray-800 leading-tight mt-0.5">
                                {{ $bendahara->name ?? 'Belum Ditentukan' }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center w-full h-10"></div>
            <div class="relative w-full flex mt-0 z-10 px-2">
                <div class="absolute top-0 left-[10%] right-[10%] h-0.5 bg-gray-300"></div>

                @foreach ($daftarDevisi as $dev)
                    @php
                        // Abaikan Pengurus Inti & Semua Devisi karena posisinya ada di bagian atas (Ketua/Sekum/Bendum)
                        if (in_array(strtolower($dev->nama_devisi), ['pengurus inti', 'semua devisi'])) {
                            continue;
                        }

                        // Konfigurasi data divisi dari database
                        $dbName = $dev->nama_devisi;
                        $kadepValue = 'Ketua Devisi ' . $dbName;
                        $color = $dev->warna ?? 'blue';
                        $label = $dbName;

                        // Tarik data Ketua dan Anggota secara otomatis
                        $dataKadep = $semuaKadep[$kadepValue] ?? null;
                        $anggotaListMentah = isset($anggotaDevisi) ? $anggotaDevisi->get($dbName, []) : [];
                        $anggotaList = collect($anggotaListMentah)->filter(function ($user) {
                            return empty($user->jabatan) || !str_contains($user->jabatan, 'Ketua Devisi');
                        });
                    @endphp

                    <div class="flex-1 min-w-[160px] flex flex-col items-center px-1.5 relative group">
                        <!-- Garis Penghubung Atas -->
                        <div class="w-0.5 h-6 bg-gray-300"></div>

                        <!-- KOTAK KETUA DIVISI -->
                        <div
                            class="w-full bg-white p-3 rounded-2xl border-t-4 border-{{ $color }}-500 shadow-md text-center z-10 relative hover:-translate-y-1 transition-transform">
                            <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-1">Ketua Devisi</p>
                            <h4 class="text-[10px] font-extrabold text-{{ $color }}-700 leading-tight mb-2 truncate px-1"
                                title="{{ $label }}">
                                {{ $label }}
                            </h4>

                            <div
                                class="w-12 h-12 rounded-full overflow-hidden border-2 border-{{ $color }}-100 mx-auto mb-2 shadow-sm bg-gray-50">
                                <img src="{{ $dataKadep && $dataKadep->photo ? asset('storage/' . $dataKadep->photo) : asset('img/default.png') }}"
                                    class="w-full h-full object-cover object-top">
                            </div>

                            <p class="text-[10px] font-black text-gray-800 truncate px-1"
                                title="{{ $dataKadep->name ?? 'Belum Ada' }}">
                                {{ $dataKadep->name ?? 'Belum Ada' }}
                            </p>
                        </div>

                        <!-- Garis Penghubung Bawah -->
                        <div class="w-0.5 h-6 bg-gray-300"></div>

                        <!-- KOTAK ANGGOTA DIVISI -->
                        <div
                            class="w-full bg-white border border-gray-100 rounded-2xl p-3 shadow-sm flex-1 flex flex-col hover:border-{{ $color }}-200 transition-colors relative z-10">
                            <div class="text-center border-b border-gray-50 pb-1.5 mb-2">
                                <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest">Anggota Devisi</p>
                            </div>

                            <ul class="text-[10px] font-medium text-gray-600 space-y-2 flex-1 text-left px-1">
                                @forelse($anggotaList as $anggota)
                                    <li class="flex items-start gap-1.5 group/item">
                                        <span
                                            class="w-1 h-1 rounded-full bg-{{ $color }}-400 mt-1.5 flex-shrink-0 group-hover/item:scale-150 transition-transform"></span>
                                        <span
                                            class="leading-tight group-hover/item:text-{{ $color }}-600 transition-colors">{{ $anggota->name }}</span>
                                    </li>
                                @empty
                                    <li class="text-gray-400 italic text-center mt-3 text-[9px]">- Belum ada anggota -</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- AREA DIVISI INFO (DINAMIS DARI DATABASE) -->
            <div class="bg-white rounded-2xl p-6 md:p-8 shadow-soft border border-gray-50 mb-6">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                    <div>
                        <h3 class="font-extrabold text-gray-800 text-xl flex items-center gap-3">
                            <div class="bg-blue-100 text-blue-600 p-2 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                            </div>
                            Mengenal Divisi GenBI USN Kolaka
                        </h3>
                        <p class="text-gray-500 text-sm mt-2 ml-11">Struktur kepengurusan dan fokus ruang lingkup kerja
                            setiap
                            divisi.</p>
                    </div>
                    @if (auth()->check() && in_array(auth()->user()->role, ['admin', 'sekretaris']))
                        <button onclick="toggleModal('modalTambahDevisi')"
                            class="bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white px-4 py-2.5 rounded-xl text-sm font-bold transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                            Tambah Divisi
                        </button>
                    @endif
                </div>

                @php
                    // Memastikan Tailwind membuat kelas warna dengan benar
                    $colorMap = [
                        'gray' => [
                            'bg' => 'bg-gray-800',
                            'text' => 'text-gray-800',
                            'border' => 'border-gray-200',
                            'lightBg' => 'from-gray-50 to-gray-100/50',
                            'shadow' => 'shadow-gray-400/50',
                            'textDesc' => 'text-gray-600',
                        ],
                        'blue' => [
                            'bg' => 'bg-blue-500',
                            'text' => 'text-blue-900',
                            'border' => 'border-blue-200',
                            'lightBg' => 'from-blue-50 to-blue-100/50',
                            'shadow' => 'shadow-blue-500/40',
                            'textDesc' => 'text-blue-800/80',
                        ],
                        'emerald' => [
                            'bg' => 'bg-emerald-500',
                            'text' => 'text-emerald-900',
                            'border' => 'border-emerald-200',
                            'lightBg' => 'from-emerald-50 to-emerald-100/50',
                            'shadow' => 'shadow-emerald-500/40',
                            'textDesc' => 'text-emerald-800/80',
                        ],
                        'purple' => [
                            'bg' => 'bg-purple-500',
                            'text' => 'text-purple-900',
                            'border' => 'border-purple-200',
                            'lightBg' => 'from-purple-50 to-purple-100/50',
                            'shadow' => 'shadow-purple-500/40',
                            'textDesc' => 'text-purple-800/80',
                        ],
                        'orange' => [
                            'bg' => 'bg-orange-500',
                            'text' => 'text-orange-900',
                            'border' => 'border-orange-200',
                            'lightBg' => 'from-orange-50 to-orange-100/50',
                            'shadow' => 'shadow-orange-500/40',
                            'textDesc' => 'text-orange-800/80',
                        ],
                        'teal' => [
                            'bg' => 'bg-teal-500',
                            'text' => 'text-teal-900',
                            'border' => 'border-teal-200',
                            'lightBg' => 'from-teal-50 to-teal-100/50',
                            'shadow' => 'shadow-teal-500/40',
                            'textDesc' => 'text-teal-800/80',
                        ],
                        'rose' => [
                            'bg' => 'bg-rose-500',
                            'text' => 'text-rose-900',
                            'border' => 'border-rose-200',
                            'lightBg' => 'from-rose-50 to-rose-100/50',
                            'shadow' => 'shadow-rose-500/40',
                            'textDesc' => 'text-rose-800/80',
                        ],
                    ];
                    // Ikon bawaan jika tidak ada gambar ikon (gambar Tas Kerja)
                    $genericIcon =
                        'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z';
                @endphp

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($daftarDevisi as $dev)
                        @php
                            $theme = $colorMap[$dev->warna] ?? $colorMap['blue'];
                            $svgPath = $dev->ikon ?? $genericIcon;
                        @endphp
                        <div
                            class="bg-gradient-to-br {{ $theme['lightBg'] }} border {{ $theme['border'] }} rounded-2xl p-6 hover:-translate-y-1 hover:shadow-lg transition-all duration-300 group relative">

                            @if (auth()->check() && in_array(auth()->user()->role, ['admin', 'sekretaris']))
                                <div
                                    class="absolute top-4 right-4 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button
                                        onclick="bukaEditDevisi({{ $dev->id }}, '{{ addslashes($dev->nama_devisi) }}', '{{ addslashes($dev->deskripsi) }}', '{{ $dev->warna }}')"
                                        class="p-1.5 bg-white rounded-lg text-blue-500 hover:bg-blue-50 shadow-sm transition-colors border border-gray-100"
                                        title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                            </path>
                                        </svg>
                                    </button>
                                    <form action="{{ route('dashboard.destroy_devisi', $dev->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus Divisi ini secara permanen?')"
                                        class="inline-block">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="p-1.5 bg-white rounded-lg text-red-500 hover:bg-red-50 shadow-sm transition-colors border border-gray-100"
                                            title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            @endif

                            <div
                                class="w-12 h-12 {{ $theme['bg'] }} text-white rounded-xl flex items-center justify-center mb-5 shadow-md {{ $theme['shadow'] }} group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    @if (str_contains($svgPath, '<path'))
                                        {!! $svgPath !!}
                                    @else
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="{{ $svgPath }}"></path>
                                    @endif
                                </svg>
                            </div>
                            <h4 class="font-black {{ $theme['text'] }} text-lg mb-2">{{ $dev->nama_devisi }}</h4>
                            <p class="text-sm {{ $theme['textDesc'] }} leading-relaxed">{{ $dev->deskripsi }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            @if (auth()->check() && in_array(auth()->user()->role, ['admin', 'sekretaris']))

                <div id="modalKelolaDokumentasi"
                    class="fixed inset-0 z-[60] hidden bg-gray-900/70 backdrop-blur-sm items-center justify-center p-4 transition-all">
                    <div
                        class="bg-white rounded-3xl shadow-2xl w-full max-w-4xl p-6 relative animate-modal max-h-[90vh] flex flex-col">
                        <div class="flex justify-between items-center mb-5 border-b border-gray-100 pb-4">
                            <div>
                                <h3 class="text-xl font-black text-gray-800 leading-tight">Kelola Galeri Dokumentasi</h3>
                                <p class="text-xs text-gray-500 mt-1">Klik foto untuk memilih beberapa gambar, lalu hapus
                                    sekaligus.</p>
                            </div>
                            <button type="button" onclick="toggleModal('modalKelolaDokumentasi')"
                                class="text-gray-400 hover:text-red-500 hover:bg-red-50 p-2 rounded-xl transition"><svg
                                    class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg></button>
                        </div>
                        <form action="{{ route('dashboard.hapus_dokumentasi') }}" method="POST" id="formHapusMasal"
                            class="flex flex-col flex-1 min-h-0">
                            @csrf
                            <div id="gridFotoKelola"
                                class="overflow-y-auto flex-1 pr-2 hide-scrollbar bg-gray-50/50 rounded-2xl p-4 border border-gray-100">
                                @if (isset($galeri) && count($galeri) > 0)
                                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                        @foreach ($galeri as $foto)
                                            <label
                                                class="relative group rounded-2xl overflow-hidden shadow-sm border border-gray-200 bg-white aspect-square cursor-pointer block">
                                                <img src="{{ asset('dokumentasi/' . $foto) }}"
                                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110 peer-checked:opacity-50">
                                                <input type="checkbox" name="filenames[]" value="{{ $foto }}"
                                                    class="peer sr-only" onchange="updateHapusButton()">
                                                <div
                                                    class="absolute inset-0 bg-blue-900/30 opacity-0 peer-checked:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[2px]">
                                                    <div
                                                        class="bg-blue-500 text-white p-2.5 rounded-full shadow-lg transform scale-50 peer-checked:scale-100 transition-transform duration-300">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="3" d="M5 13l4 4L19 7"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="flex flex-col items-center justify-center py-12 text-gray-400">
                                        <svg class="w-16 h-16 mb-3 opacity-30" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <p class="text-sm font-bold uppercase tracking-widest">Galeri masih kosong</p>
                                    </div>
                                @endif
                            </div>
                            <div class="pt-4 mt-4 border-t border-gray-100 flex justify-between items-center">
                                <p class="text-sm font-bold text-gray-500">Terpilih: <span id="terpilihCount"
                                        class="text-blue-600 text-lg">0</span> Foto</p>
                                <div class="flex gap-3">
                                    <button type="button" onclick="toggleModal('modalKelolaDokumentasi')"
                                        class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-2.5 rounded-xl font-bold transition text-sm">Batal</button>
                                    <button type="submit" id="btnHapusMasal" disabled
                                        class="bg-red-500 hover:bg-red-600 disabled:opacity-50 disabled:cursor-not-allowed text-white px-6 py-2.5 rounded-xl font-bold transition flex items-center gap-2 text-sm shadow-md shadow-red-500/30"><svg
                                            class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg> Hapus</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                @if (auth()->check() && in_array(auth()->user()->role, ['admin', 'sekretaris']))
                    <!-- Modal Tambah Divisi -->
                    <div id="modalTambahDevisi"
                        class="fixed inset-0 z-[60] hidden bg-gray-900/70 backdrop-blur-sm items-center justify-center p-4 transition-all">
                        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg p-6 relative animate-modal">
                            <div class="flex justify-between items-center mb-5 border-b border-gray-100 pb-4">
                                <h3 class="text-xl font-black text-gray-800 leading-tight">Tambah Divisi Baru</h3>
                                <button type="button" onclick="toggleModal('modalTambahDevisi')"
                                    class="text-gray-400 hover:text-red-500 hover:bg-red-50 p-2 rounded-xl transition"><svg
                                        class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg></button>
                            </div>
                            <form action="{{ route('dashboard.store_devisi') }}" method="POST" class="space-y-4">
                                @csrf
                                <div>
                                    <label class="block text-xs font-black text-gray-500 uppercase mb-2">Nama
                                        Divisi</label>
                                    <input type="text" name="nama_devisi" required
                                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 bg-gray-50 focus:bg-white transition-all">
                                </div>
                                <div>
                                    <label class="block text-xs font-black text-gray-500 uppercase mb-2">Deskripsi & Ruang
                                        Lingkup</label>
                                    <textarea name="deskripsi" rows="3" required
                                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 bg-gray-50 focus:bg-white transition-all"></textarea>
                                </div>
                                <div>
                                    <label class="block text-xs font-black text-gray-500 uppercase mb-2">Tema Warna</label>
                                    <select name="warna" required
                                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 bg-gray-50 focus:bg-white transition-all cursor-pointer font-bold">
                                        <option value="blue">Biru (Blue)</option>
                                        <option value="emerald">Hijau Zamrud (Emerald)</option>
                                        <option value="purple">Ungu (Purple)</option>
                                        <option value="orange">Oranye (Orange)</option>
                                        <option value="teal">Hijau Toska (Teal)</option>
                                        <option value="rose">Merah Muda (Rose)</option>
                                        <option value="gray">Abu-abu (Gray)</option>
                                    </select>
                                </div>
                                <div class="pt-4 flex justify-end gap-3 border-t border-gray-100 mt-6">
                                    <button type="button" onclick="toggleModal('modalTambahDevisi')"
                                        class="px-5 py-2.5 text-gray-600 font-bold bg-gray-100 hover:bg-gray-200 rounded-xl text-sm transition">Batal</button>
                                    <button type="submit"
                                        class="bg-gradient-to-r from-blue-600 to-primary-blue hover:from-blue-700 hover:to-blue-600 text-white px-8 py-2.5 rounded-xl text-sm font-bold shadow-md shadow-blue-500/30 transition hover:-translate-y-0.5">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Modal Edit Divisi -->
                    <div id="modalEditDevisi"
                        class="fixed inset-0 z-[60] hidden bg-gray-900/70 backdrop-blur-sm items-center justify-center p-4 transition-all">
                        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg p-6 relative animate-modal">
                            <div class="flex justify-between items-center mb-5 border-b border-gray-100 pb-4">
                                <h3 class="text-xl font-black text-gray-800 leading-tight">Edit Data Divisi</h3>
                                <button type="button" onclick="toggleModal('modalEditDevisi')"
                                    class="text-gray-400 hover:text-red-500 hover:bg-red-50 p-2 rounded-xl transition"><svg
                                        class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg></button>
                            </div>
                            <form id="formEditDevisiAction" action="" method="POST" class="space-y-4">
                                @csrf @method('PUT')
                                <div>
                                    <label class="block text-xs font-black text-gray-500 uppercase mb-2">Nama
                                        Divisi</label>
                                    <input type="text" name="nama_devisi" id="edit_nama_devisi" required
                                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 bg-gray-50 focus:bg-white transition-all">
                                </div>
                                <div>
                                    <label class="block text-xs font-black text-gray-500 uppercase mb-2">Deskripsi & Ruang
                                        Lingkup</label>
                                    <textarea name="deskripsi" id="edit_deskripsi" rows="3" required
                                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 bg-gray-50 focus:bg-white transition-all"></textarea>
                                </div>
                                <div>
                                    <label class="block text-xs font-black text-gray-500 uppercase mb-2">Tema Warna</label>
                                    <select name="warna" id="edit_warna" required
                                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 bg-gray-50 focus:bg-white transition-all cursor-pointer font-bold">
                                        <option value="blue">Biru (Blue)</option>
                                        <option value="emerald">Hijau Zamrud (Emerald)</option>
                                        <option value="purple">Ungu (Purple)</option>
                                        <option value="orange">Oranye (Orange)</option>
                                        <option value="teal">Hijau Toska (Teal)</option>
                                        <option value="rose">Merah Muda (Rose)</option>
                                        <option value="gray">Abu-abu (Gray)</option>
                                    </select>
                                </div>
                                <div class="pt-4 flex justify-end gap-3 border-t border-gray-100 mt-6">
                                    <button type="button" onclick="toggleModal('modalEditDevisi')"
                                        class="px-5 py-2.5 text-gray-600 font-bold bg-gray-100 hover:bg-gray-200 rounded-xl text-sm transition">Batal</button>
                                    <button type="submit"
                                        class="bg-gradient-to-r from-blue-600 to-primary-blue hover:from-blue-700 hover:to-blue-600 text-white px-8 py-2.5 rounded-xl text-sm font-bold shadow-md shadow-blue-500/30 transition hover:-translate-y-0.5">Simpan
                                        Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif

                <div id="modalUploadDokumentasi"
                    class="fixed inset-0 z-[60] hidden bg-gray-900/70 backdrop-blur-sm items-center justify-center p-4 transition-all">
                    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md p-6 relative animate-modal">
                        <div class="flex justify-between items-center mb-5 border-b border-gray-100 pb-4">
                            <h3 class="text-xl font-black text-gray-800 leading-tight">Tambah Dokumentasi</h3>
                            <button type="button" onclick="toggleModal('modalUploadDokumentasi')"
                                class="text-gray-400 hover:text-red-500 hover:bg-red-50 p-2 rounded-xl transition"><svg
                                    class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg></button>
                        </div>
                        <form action="{{ route('dashboard.upload_dokumentasi') }}" method="POST"
                            enctype="multipart/form-data" class="space-y-5">
                            @csrf
                            <div>
                                <label class="block text-xs font-black text-gray-500 uppercase mb-2">Pilih Foto
                                    Kegiatan</label>
                                <input type="file" name="foto" required accept="image/*"
                                    class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 bg-gray-50 cursor-pointer">
                                <p class="text-xs text-gray-400 mt-2 font-medium">Format yang didukung: JPG, JPEG, PNG.
                                    Maksimal
                                    10MB.</p>
                            </div>
                            <div class="pt-4 flex justify-end gap-3 border-t border-gray-100 mt-6">
                                <button type="button" onclick="toggleModal('modalUploadDokumentasi')"
                                    class="px-5 py-2.5 text-gray-600 font-bold bg-gray-100 hover:bg-gray-200 rounded-xl text-sm transition">Batal</button>
                                <button type="submit"
                                    class="bg-gradient-to-r from-blue-600 to-primary-blue hover:from-blue-700 hover:to-blue-600 text-white px-8 py-2.5 rounded-xl text-sm font-bold shadow-md shadow-blue-500/30 transition hover:-translate-y-0.5">Upload
                                    Foto</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div id="modalEditGenbi"
                    class="fixed inset-0 z-[60] hidden bg-gray-900/70 backdrop-blur-sm items-center justify-center p-4 sm:p-6 transition-all">
                    <div
                        class="bg-white rounded-3xl shadow-2xl w-full max-w-3xl flex flex-col overflow-hidden animate-modal max-h-[95vh] relative">
                        <div
                            class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50 flex-shrink-0 z-20">
                            <h3 class="text-lg font-extrabold text-gray-800">Edit Informasi GenBI</h3>
                            <button type="button" onclick="toggleModal('modalEditGenbi')"
                                class="text-gray-400 hover:text-red-500 hover:bg-red-50 p-2 rounded-xl transition"><svg
                                    class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg></button>
                        </div>
                        <form id="formEditGenbi" action="{{ route('dashboard.update_info') }}" method="POST"
                            class="p-6 space-y-6 overflow-y-auto hide-scrollbar flex-1 z-10">
                            @csrf
                            <div>
                                <label class="block text-sm font-bold text-gray-700 uppercase mb-2">Visi</label>
                                <textarea name="visi" rows="3" required
                                    class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-4 focus:ring-blue-500/20 focus:border-blue-400 bg-gray-50 focus:bg-white transition-all">{{ $info->visi ?? '' }}</textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 uppercase mb-2">Misi (Pisahkan tiap
                                    misi dengan
                                    baris baru)</label>
                                <textarea name="misi" rows="6" required
                                    class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-4 focus:ring-blue-500/20 focus:border-blue-400 bg-gray-50 focus:bg-white transition-all">{{ $info->misi ?? '' }}</textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 uppercase mb-2">Komitmen &
                                    Harapan</label>
                                <textarea name="komitmen" rows="4" required
                                    class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-4 focus:ring-blue-500/20 focus:border-blue-400 bg-gray-50 focus:bg-white transition-all">{{ $info->komitmen ?? '' }}</textarea>
                            </div>
                            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 mt-6">
                                <button type="button" onclick="toggleModal('modalEditGenbi')"
                                    class="px-5 py-2.5 text-gray-600 font-bold bg-gray-100 hover:bg-gray-200 rounded-xl text-sm transition">Batal</button>
                                <button type="submit"
                                    class="bg-gradient-to-r from-blue-600 to-primary-blue hover:from-blue-700 hover:to-blue-600 text-white px-8 py-2.5 rounded-xl text-sm font-bold shadow-md shadow-blue-500/30 transition hover:-translate-y-0.5">Simpan
                                    Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div id="modalEditPoin"
                    class="fixed inset-0 z-[60] hidden bg-gray-900/70 backdrop-blur-sm items-center justify-center p-4 sm:p-6 transition-all">
                    <div
                        class="bg-white rounded-3xl shadow-2xl w-full max-w-4xl flex flex-col overflow-hidden animate-modal max-h-[95vh] relative">
                        <div
                            class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50 flex-shrink-0 z-20">
                            <h3 class="text-lg font-extrabold text-gray-800">Edit Aturan Poin</h3>
                            <button type="button" onclick="toggleModal('modalEditPoin')"
                                class="text-gray-400 hover:text-red-500 hover:bg-red-50 p-2 rounded-xl transition"><svg
                                    class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg></button>
                        </div>
                        <form id="formEditPoin" action="{{ route('dashboard.update_poin') }}" method="POST"
                            class="p-6 space-y-6 overflow-y-auto hide-scrollbar flex-1 z-10">
                            @csrf
                            <div class="bg-blue-50 p-4 rounded-xl border border-blue-100 mb-4 flex gap-3 items-start">
                                <svg class="w-6 h-6 text-blue-600 mt-0.5 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-sm text-blue-800 font-medium leading-relaxed"><b>Panduan:</b> Gunakan format
                                    <code>Nama Aturan: Nilai Poin</code>. Pisahkan setiap aturan dengan baris baru (Enter).
                                </p>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 uppercase mb-2">Pelanggaran &
                                        Penambahan
                                        Poin</label>
                                    <textarea name="pelanggaran" rows="6"
                                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-4 focus:ring-blue-500/20 focus:border-blue-400 bg-gray-50 focus:bg-white transition-all">{{ $info->pelanggaran ?? '' }}</textarea>
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 uppercase mb-2">Aturan QRIS (Target
                                        Bulanan)</label>
                                    <textarea name="qris" rows="6"
                                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-4 focus:ring-blue-500/20 focus:border-blue-400 bg-gray-50 focus:bg-white transition-all">{{ $info->qris ?? '' }}</textarea>
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 uppercase mb-2">Apresiasi &
                                        Pengurangan
                                        Poin</label>
                                    <textarea name="apresiasi" rows="4"
                                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-4 focus:ring-blue-500/20 focus:border-blue-400 bg-gray-50 focus:bg-white transition-all">{{ $info->apresiasi ?? "Rajin: -3 Poin\nAktif: -2 Poin" }}</textarea>
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 uppercase mb-2">Ambang Batas
                                        Peringatan
                                        (SP)</label>
                                    <textarea name="sp" rows="4"
                                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-4 focus:ring-blue-500/20 focus:border-blue-400 bg-gray-50 focus:bg-white transition-all">{{ $info->sp ?? "SP 1 (Komisariat): 25\nSP 2 (Wilayah): 50\nSP 3 (Pembina): >50" }}</textarea>
                                </div>
                            </div>
                            <div class="flex justify-end gap-3 pt-6 border-t border-gray-100 mt-6">
                                <button type="button" onclick="toggleModal('modalEditPoin')"
                                    class="px-5 py-2.5 text-gray-600 font-bold bg-gray-100 hover:bg-gray-200 rounded-xl text-sm transition">Batal</button>
                                <button type="submit"
                                    class="bg-gradient-to-r from-blue-600 to-primary-blue hover:from-blue-700 hover:to-blue-600 text-white px-8 py-2.5 rounded-xl text-sm font-bold shadow-md shadow-blue-500/30 transition hover:-translate-y-0.5">Simpan
                                    Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div id="modalEditBeasiswa"
                    class="fixed inset-0 z-[60] hidden bg-gray-900/70 backdrop-blur-sm items-center justify-center p-4 sm:p-6 transition-all">
                    <div
                        class="bg-white rounded-[2rem] shadow-2xl w-full max-w-5xl flex flex-col overflow-hidden animate-modal max-h-[95vh] relative">
                        <div
                            class="bg-white px-6 sm:px-8 py-5 border-b border-gray-100 flex items-center justify-between relative overflow-hidden flex-shrink-0 z-20">
                            <div
                                class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-full blur-2xl -translate-y-1/2 translate-x-1/3 pointer-events-none">
                            </div>
                            <div class="relative z-10 flex items-center gap-3">
                                <div
                                    class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center shadow-inner border border-blue-100/50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-black text-gray-800 tracking-tight">Edit Syarat & Dokumen Beasiswa
                                </h3>
                            </div>
                            <button type="button" onclick="toggleModal('modalEditBeasiswa')"
                                class="relative z-10 text-gray-400 hover:text-red-500 bg-gray-50 hover:bg-red-50 p-2 rounded-xl transition-colors border border-gray-100 shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <form id="formEditBeasiswa" action="{{ route('dashboard.update_info') }}" method="POST"
                            class="flex flex-col flex-1 overflow-hidden z-10 bg-slate-50/50">
                            @csrf
                            <div class="p-6 sm:p-8 space-y-6 overflow-y-auto hide-scrollbar flex-1">
                                <div
                                    class="bg-blue-50/80 p-4 rounded-2xl border border-blue-100/80 shadow-sm flex gap-4 items-start flex-shrink-0">
                                    <div class="bg-blue-100 text-blue-600 p-1.5 rounded-lg flex-shrink-0 mt-0.5">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-sm text-blue-900 font-medium leading-relaxed">
                                        <b class="text-blue-700">Panduan:</b> Tidak perlu repot menekan "Enter" berulang
                                        kali.
                                        Cukup klik tombol <b>"+ Tambah"</b> untuk membuat kotak poin baru secara spesifik.
                                        Nomor
                                        urut akan dibuat otomatis oleh sistem.
                                    </p>
                                </div>
                                <textarea name="kriteria_beasiswa" id="hidden_kriteria" class="hidden">{{ $valKriteria }}</textarea>
                                <textarea name="dokumen_beasiswa" id="hidden_dokumen" class="hidden">{{ $valDokumen }}</textarea>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 h-max">
                                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-200">
                                        <div class="flex items-center justify-between mb-4 border-b border-gray-100 pb-3">
                                            <div class="flex items-center gap-3">
                                                <span
                                                    class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center font-black text-sm">A</span>
                                                <label
                                                    class="block text-sm font-black text-gray-800 uppercase tracking-tight">Kriteria
                                                    Mahasiswa</label>
                                            </div>
                                            <button type="button" onclick="addDynamicItem('kriteria')"
                                                class="text-xs font-bold text-blue-600 hover:text-white bg-blue-50 hover:bg-blue-600 px-3 py-1.5 rounded-lg transition-colors shadow-sm">
                                                + Tambah
                                            </button>
                                        </div>
                                        <div id="container_kriteria" class="space-y-3 pb-2"></div>
                                    </div>
                                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-200">
                                        <div class="flex items-center justify-between mb-4 border-b border-gray-100 pb-3">
                                            <div class="flex items-center gap-3">
                                                <span
                                                    class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center font-black text-sm">B</span>
                                                <label
                                                    class="block text-sm font-black text-gray-800 uppercase tracking-tight">Dokumen
                                                    Pendukung</label>
                                            </div>
                                            <button type="button" onclick="addDynamicItem('dokumen')"
                                                class="text-xs font-bold text-blue-600 hover:text-white bg-blue-50 hover:bg-blue-600 px-3 py-1.5 rounded-lg transition-colors shadow-sm">
                                                + Tambah
                                            </button>
                                        </div>
                                        <div id="container_dokumen" class="space-y-3 pb-2"></div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="px-6 sm:px-8 py-5 border-t border-gray-100 flex justify-end gap-3 items-center bg-white flex-shrink-0 z-20">
                                <button type="button" onclick="toggleModal('modalEditBeasiswa')"
                                    class="px-6 py-2.5 text-gray-600 font-bold bg-gray-50 border border-gray-200 hover:bg-gray-100 hover:text-gray-800 rounded-xl text-sm transition-all shadow-sm">Batal</button>
                                <button type="submit"
                                    class="bg-gradient-to-r from-blue-600 to-primary-blue hover:from-blue-700 hover:to-blue-600 text-white px-8 py-2.5 rounded-xl text-sm font-bold shadow-md shadow-blue-500/30 transition hover:-translate-y-0.5">Simpan
                                    Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif

            <div id="modalInfoGenbi"
                class="fixed inset-0 z-50 hidden bg-gray-900/70 backdrop-blur-sm items-center justify-center p-4 sm:p-6 transition-all">
                <div
                    class="bg-white rounded-3xl shadow-2xl w-full max-w-5xl flex flex-col overflow-hidden animate-modal max-h-[95vh] relative">
                    <div
                        class="bg-gradient-to-br from-blue-600 via-primary-blue to-blue-800 pt-8 pb-10 px-6 text-center relative z-30 flex-shrink-0 shadow-md">
                        <button type="button" onclick="toggleModal('modalInfoGenbi')"
                            class="absolute top-4 right-4 z-20 bg-white/20 hover:bg-white/40 p-2.5 rounded-full shadow-sm transition backdrop-blur-md"><svg
                                class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg></button>
                        <div class="absolute inset-0 opacity-10"><svg class="w-full h-full" viewBox="0 0 100 100"
                                preserveAspectRatio="none">
                                <path fill="white" d="M0 100 C 20 0 50 0 100 100 Z"></path>
                            </svg></div>
                        <h2 class="text-3xl font-extrabold text-white tracking-wide relative z-10 drop-shadow-md">GENBI
                            SULTRA</h2>
                        <p
                            class="text-blue-100 font-bold tracking-widest uppercase text-sm mt-2 bg-black/10 px-4 py-1 rounded-full inline-block relative z-10">
                            Komisariat USN Kolaka</p>
                        <div class="absolute -bottom-7 left-1/2 transform -translate-x-1/2 z-30">
                            <div
                                class="bg-white p-1 rounded-full shadow-sm border border-gray-100 flex items-center justify-center">
                                <div
                                    class="w-14 h-14 bg-gray-50 rounded-full flex items-center justify-center overflow-hidden">
                                    <img src="{{ asset('logo_kiri.png') }}" alt="Logo GenBI"
                                        class="w-10 h-10 object-contain">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-y-auto hide-scrollbar flex-1 relative z-10 bg-gray-50/50 p-6 sm:p-8 pt-10">
                        <div class="text-center mb-10 mt-2">
                            <p class="text-gray-600 text-sm md:text-base leading-relaxed max-w-2xl mx-auto">
                                GenBi Sultra Komisariat Universitas Sembilanbelas November Kolaka merupakan Komunitas yang
                                beranggotakan mahasiswa/i penerima beasiswa Bank Indonesia. Berfokus pada <span
                                    class="font-bold text-primary-blue">pengembangan diri, kegiatan sosial, dan
                                    pemberdayaan
                                    masyarakat</span> untuk memperkuat eksistensi serta kontribusi organisasi dalam lingkup
                                kampus
                                dan masyarakat sekitar.
                            </p>
                        </div>
                        <div class="mb-10">
                            <div class="text-center mb-6"><span
                                    class="bg-yellow-100 text-yellow-700 text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-wider">Sasaran
                                    Pembentukan</span></div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                                <div
                                    class="bg-gradient-to-br from-blue-50 to-white p-6 rounded-2xl border border-blue-100 shadow-sm hover:-translate-y-2 hover:shadow-xl transition duration-300">
                                    <div
                                        class="w-12 h-12 bg-blue-500 text-white rounded-2xl flex items-center justify-center mb-4 shadow-blue-500/30 shadow-lg transform -rotate-3">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                                            </path>
                                        </svg>
                                    </div>
                                    <h4 class="font-extrabold text-blue-900 mb-2 text-lg">Frontliner</h4>
                                    <p class="text-sm text-blue-700/80 leading-relaxed">Membantu mengkomunikasikan
                                        kebijakan Bank
                                        Indonesia kepada komunitas mahasiswa dan masyarakat luas.</p>
                                </div>
                                <div
                                    class="bg-gradient-to-br from-emerald-50 to-white p-6 rounded-2xl border border-emerald-100 shadow-sm hover:-translate-y-2 hover:shadow-xl transition duration-300">
                                    <div
                                        class="w-12 h-12 bg-emerald-500 text-white rounded-2xl flex items-center justify-center mb-4 shadow-emerald-500/30 shadow-lg transform rotate-3">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                            </path>
                                        </svg>
                                    </div>
                                    <h4 class="font-extrabold text-emerald-900 mb-2 text-lg">Agent of Change</h4>
                                    <p class="text-sm text-emerald-700/80 leading-relaxed">Berperan sebagai <span
                                            class="italic">role model</span> (teladan) yang membawa perubahan positif bagi
                                        kalangan
                                        pelajar dan masyarakat sekitar.</p>
                                </div>
                                <div
                                    class="bg-gradient-to-br from-purple-50 to-white p-6 rounded-2xl border border-purple-100 shadow-sm hover:-translate-y-2 hover:shadow-xl transition duration-300">
                                    <div
                                        class="w-12 h-12 bg-purple-500 text-white rounded-2xl flex items-center justify-center mb-4 shadow-purple-500/30 shadow-lg transform -rotate-3">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                                            </path>
                                        </svg>
                                    </div>
                                    <h4 class="font-extrabold text-purple-900 mb-2 text-lg">Future Leader</h4>
                                    <p class="text-sm text-purple-700/80 leading-relaxed">Diharapkan mampu memimpin dan
                                        menjadi
                                        tokoh masa depan yang unggul di berbagai bidang.</p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="bg-white rounded-3xl p-6 sm:p-8 border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.06)] relative overflow-hidden group">
                            <div
                                class="absolute -right-10 -bottom-10 w-40 h-40 bg-primary-blue opacity-[0.03] rounded-full group-hover:scale-150 transition duration-700">
                            </div>
                            <h4 class="font-black text-xl text-gray-800 mb-3 flex items-center gap-3">
                                <div class="bg-red-100 text-red-500 p-2 rounded-xl"><svg class="w-5 h-5"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                            clip-rule="evenodd"></path>
                                    </svg></div> Komitmen & Harapan
                            </h4>
                            <p class="text-sm text-gray-600 leading-relaxed text-justify relative z-10">
                                {{ $info->komitmen ?? '' }}</p>
                        </div>
                        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div
                                class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-3xl p-8 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group">
                                <div
                                    class="w-14 h-14 bg-blue-500 rounded-2xl flex items-center justify-center mb-6 shadow-md shadow-blue-500/30 group-hover:scale-110 transition-transform">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                </div>
                                <h4 class="text-2xl font-black text-blue-900 mb-4 tracking-tight">VISI</h4>
                                <p class="text-blue-900/80 text-sm leading-relaxed text-justify font-medium">
                                    "{{ $info->visi ?? '' }}"</p>
                            </div>
                            <div
                                class="bg-gradient-to-br from-emerald-50 to-emerald-100 border border-emerald-200 rounded-3xl p-8 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group">
                                <div
                                    class="w-14 h-14 bg-emerald-500 rounded-2xl flex items-center justify-center mb-6 shadow-md shadow-emerald-500/30 group-hover:scale-110 transition-transform">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m3-4h1m-1 4h1m-5 8h8">
                                        </path>
                                    </svg>
                                </div>
                                <h4 class="text-2xl font-black text-emerald-900 mb-5 tracking-tight">MISI</h4>
                                <ul class="space-y-4">
                                    @php
                                        $misiArray = explode("\n", str_replace("\r", '', $info->misi ?? ''));
                                        $counter = 1;
                                    @endphp
                                    @foreach ($misiArray as $misiItem)
                                        @if (trim($misiItem) != '')
                                            <li class="flex gap-4 items-start">
                                                <div
                                                    class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center font-extrabold text-sm shadow-sm">
                                                    {{ $counter++ }}</div>
                                                <p
                                                    class="text-emerald-900/80 text-sm leading-relaxed pt-1 text-justify font-medium">
                                                    {{ preg_replace('/^\d+[\.\)]\s*/', '', trim($misiItem)) }}</p>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div
                        class="p-4 bg-white border-t border-gray-100 flex justify-end gap-3 items-center z-20 flex-shrink-0 rounded-b-3xl">
                        @if (auth()->check() && in_array(auth()->user()->role, ['admin', 'sekretaris']))
                            <button type="button" onclick="toggleModal('modalEditGenbi')"
                                class="bg-amber-500 hover:bg-amber-600 text-white px-6 py-2.5 rounded-xl font-bold transition text-sm shadow-sm hover:shadow-lg flex items-center gap-2"><svg
                                    class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg> Edit Visi & Misi</button>
                        @endif
                        <button type="button" onclick="toggleModal('modalInfoGenbi')"
                            class="bg-primary-blue hover:bg-blue-700 text-white px-8 py-2.5 rounded-xl font-bold transition text-sm shadow-sm hover:shadow-lg">Kembali</button>
                    </div>
                </div>
            </div>

            <div id="modalInfoPoin"
                class="fixed inset-0 z-50 hidden bg-gray-900/70 backdrop-blur-sm items-center justify-center p-4 sm:p-6 transition-all">
                <div
                    class="bg-white rounded-3xl shadow-2xl w-full max-w-4xl flex flex-col overflow-hidden animate-modal max-h-[95vh] relative">
                    <div
                        class="bg-gradient-to-br from-blue-600 via-primary-blue to-blue-800 pt-8 pb-10 px-6 text-center relative z-30 flex-shrink-0 shadow-md">
                        <button type="button" onclick="toggleModal('modalInfoPoin')"
                            class="absolute top-4 right-4 z-20 bg-white/20 hover:bg-white/40 p-2.5 rounded-full shadow-sm transition backdrop-blur-md"><svg
                                class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg></button>
                        <div class="absolute inset-0 opacity-10"><svg class="w-full h-full" viewBox="0 0 100 100"
                                preserveAspectRatio="none">
                                <path fill="white" d="M0 100 C 20 0 50 0 100 100 Z"></path>
                            </svg></div>
                        <h2 class="text-3xl font-extrabold text-white tracking-wide relative z-10 drop-shadow-md">ATURAN
                            POIN
                            KEAKTIFAN</h2>
                        <p
                            class="text-blue-100 font-bold tracking-widest uppercase text-sm mt-2 bg-black/10 px-4 py-1 rounded-full inline-block relative z-10">
                            Sistem Reward & Punishment</p>
                        <div class="absolute -bottom-7 left-1/2 transform -translate-x-1/2 z-30">
                            <div
                                class="bg-white p-1 rounded-full shadow-sm border border-gray-100 flex items-center justify-center">
                                <div
                                    class="w-14 h-14 bg-gray-50 rounded-full flex items-center justify-center overflow-hidden">
                                    <img src="{{ asset('logo_kiri.png') }}" alt="Logo GenBI"
                                        class="w-10 h-10 object-contain">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-y-auto hide-scrollbar flex-1 relative z-10 bg-gray-50/50 p-6 sm:p-8 pt-10">
                        <div
                            class="bg-amber-50 border border-amber-100 p-4 rounded-2xl flex items-center gap-4 mb-8 shadow-sm mt-2">
                            <div class="bg-amber-100 p-2 rounded-xl"><svg class="w-6 h-6 text-amber-600 flex-shrink-0"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                    </path>
                                </svg></div>
                            <p class="text-sm text-amber-800 font-bold uppercase tracking-wide">Semua Izin Kegiatan Harus
                                Melalui
                                SEKERTARIS UMUM!</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-4">
                                <h4
                                    class="text-red-600 font-black uppercase text-xs tracking-widest flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-red-500"></span> Pelanggaran & Penambahan Poin
                                </h4>
                                <div
                                    class="bg-white border border-red-100 rounded-2xl p-5 space-y-4 shadow-[0_8px_30px_rgb(0,0,0,0.06)]">
                                    @php $pelanggaranArray = explode("\n", str_replace("\r", "", $info->pelanggaran ?? "")); @endphp
                                    @foreach ($pelanggaranArray as $item)
                                        @if (trim($item) != '')
                                            @php
                                                $parts = explode(':', $item);
                                                $name = $parts[0] ?? $item;
                                                $score = $parts[1] ?? '';
                                            @endphp
                                            <div
                                                class="flex justify-between items-center text-sm border-b border-red-50 pb-3 gap-3">
                                                <span class="text-gray-600 leading-tight">{{ trim($name) }}</span>
                                                @if (trim($score) != '')
                                                    <span
                                                        class="bg-red-50 text-red-600 font-bold px-3 py-1 rounded-lg whitespace-nowrap flex-shrink-0">{{ trim($score) }}</span>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                    <div class="bg-red-50 p-4 rounded-xl border border-red-200 mt-2">
                                        <p
                                            class="text-xs text-red-700 font-bold uppercase leading-relaxed italic text-center">
                                            Sakit/Kerja tdk berkontribusi min 40 hari = LANGSUNG SP 3</p>
                                    </div>
                                </div>
                                <div class="bg-white border border-blue-100 rounded-2xl p-4 space-y-4 shadow-sm mt-4">
                                    <h5 class="text-[10px] font-bold text-blue-500 uppercase tracking-widest">Aturan QRIS
                                        (Target
                                        Bulanan)</h5>
                                    @php $qrisArray = explode("\n", str_replace("\r", "", $info->qris ?? "")); @endphp
                                    @foreach ($qrisArray as $item)
                                        @if (trim($item) != '')
                                            @php
                                                $parts = explode(':', $item);
                                                $name = $parts[0] ?? $item;
                                                $score = $parts[1] ?? '';
                                            @endphp
                                            <div
                                                class="flex justify-between items-center text-sm border-b border-blue-50 pb-3 gap-3">
                                                <span class="text-gray-600 leading-tight">{{ trim($name) }}</span>
                                                @if (trim($score) != '')
                                                    <span
                                                        class="bg-blue-50 text-blue-600 font-bold px-3 py-1 rounded-lg whitespace-nowrap flex-shrink-0">{{ trim($score) }}</span>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="space-y-6">
                                <div class="space-y-4">
                                    <h4
                                        class="text-green-600 font-black uppercase text-xs tracking-widest flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-green-500"></span> Apresiasi & Pengurangan
                                        Poin
                                    </h4>
                                    <div class="grid grid-cols-2 gap-3">
                                        @php $apresiasiArray = explode("\n", str_replace("\r", "", $info->apresiasi ?? "Rajin: -3 Poin\nAktif: -2 Poin")); @endphp
                                        @foreach ($apresiasiArray as $item)
                                            @if (trim($item) != '')
                                                @php
                                                    $parts = explode(':', $item);
                                                    $name = $parts[0] ?? $item;
                                                    $score = $parts[1] ?? '';
                                                    $scoreNum = trim(str_ireplace('Poin', '', $score));
                                                @endphp
                                                <div
                                                    class="bg-white border border-green-100 rounded-2xl p-5 text-center shadow-[0_8px_30px_rgb(0,0,0,0.06)] flex flex-col justify-center items-center">
                                                    <p class="text-xs text-gray-500 mb-1 font-bold uppercase">
                                                        {{ trim($name) }}
                                                    </p>
                                                    <p class="text-2xl font-black text-green-600">{{ $scoreNum }}
                                                        <span class="text-sm font-medium">Poin</span>
                                                    </p>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <h4
                                        class="text-purple-600 font-black uppercase text-xs tracking-widest flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Ambang Batas Surat Peringatan (SP)
                                    </h4>
                                    <div class="space-y-3">
                                        @php
                                            $spArray = explode(
                                                "\n",
                                                str_replace(
                                                    "\r",
                                                    '',
                                                    $info->sp ??
                                                        "SP 1 (Komisariat): 25\nSP 2 (Wilayah): 50\nSP 3 (Pembina): >50",
                                                ),
                                            );
                                            $spColors = [
                                                'from-yellow-500 to-yellow-600 shadow-yellow-200',
                                                'from-orange-500 to-orange-600 shadow-orange-200',
                                                'from-red-600 to-red-700 shadow-red-200',
                                                'from-purple-600 to-purple-800 shadow-purple-200',
                                            ];
                                            $spNumerals = ['I', 'II', 'III', 'IV', 'V'];
                                        @endphp
                                        @foreach ($spArray as $index => $item)
                                            @if (trim($item) != '')
                                                @php
                                                    $parts = explode(':', $item);
                                                    $name = $parts[0] ?? $item;
                                                    $score = $parts[1] ?? '';
                                                    $color = $spColors[$index % count($spColors)];
                                                    $numeral = $spNumerals[$index % count($spNumerals)];
                                                @endphp
                                                <div
                                                    class="bg-gradient-to-r {{ $color }} p-4 rounded-2xl text-white shadow-md">
                                                    <div class="flex justify-between items-center gap-3">
                                                        <div>
                                                            <p class="text-xs opacity-90 font-bold uppercase">Surat
                                                                Peringatan
                                                                {{ $numeral }}</p>
                                                            <p class="text-lg font-black leading-tight">
                                                                {{ trim($name) }}</p>
                                                        </div>
                                                        <div class="text-3xl font-black whitespace-nowrap flex-shrink-0">
                                                            {{ trim($score) }}</div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="p-4 bg-white border-t border-gray-100 flex justify-end gap-3 items-center z-20 flex-shrink-0 rounded-b-3xl">
                        @if (auth()->check() && in_array(auth()->user()->role, ['admin', 'sekretaris']))
                            <button type="button" onclick="toggleModal('modalEditPoin')"
                                class="bg-amber-500 hover:bg-amber-600 text-white px-6 py-2.5 rounded-xl font-bold transition text-sm shadow-sm hover:shadow-lg flex items-center gap-2"><svg
                                    class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg> Edit Aturan Poin</button>
                        @endif
                        <button type="button" onclick="toggleModal('modalInfoPoin')"
                            class="bg-primary-blue hover:bg-blue-700 text-white px-8 py-2.5 rounded-xl font-bold transition text-sm shadow-sm hover:shadow-lg">Kembali</button>
                    </div>
                </div>
            </div>

            <div id="modalInfoBeasiswa"
                class="fixed inset-0 z-50 hidden bg-slate-900/70 backdrop-blur-sm items-center justify-center p-4 sm:p-6 transition-all">
                <div
                    class="bg-white rounded-[2rem] shadow-2xl w-full max-w-5xl flex flex-col overflow-hidden animate-modal max-h-[95vh] border border-gray-100 relative">

                    <!-- BAGIAN HEADER BIRU -->
                    <div
                        class="bg-gradient-to-br from-blue-600 via-primary-blue to-blue-800 pt-8 pb-10 px-6 text-center relative z-30 flex-shrink-0 shadow-md">
                        <button type="button" onclick="toggleModal('modalInfoBeasiswa')"
                            class="absolute top-4 right-4 z-20 bg-white/20 hover:bg-white/40 p-2.5 rounded-full shadow-sm transition backdrop-blur-md">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg>
                        </button>
                        <div class="absolute inset-0 opacity-10"><svg class="w-full h-full" viewBox="0 0 100 100"
                                preserveAspectRatio="none">
                                <path fill="white" d="M0 100 C 20 0 50 0 100 100 Z"></path>
                            </svg></div>

                        <h2 class="text-3xl font-extrabold text-white tracking-wide relative z-10 drop-shadow-md">BEASISWA
                            KEBANKSENTRALAN</h2>
                        <p
                            class="text-blue-100 font-bold tracking-widest uppercase text-sm mt-2 bg-black/10 px-4 py-1 rounded-full inline-block relative z-10">
                            Persyaratan & Dokumen</p>

                        <!-- KUNCI PERBAIKAN: Logo dipindah ke bawah agar menimpa garis batas biru dan putih -->
                        <div class="absolute -bottom-7 left-1/2 transform -translate-x-1/2 z-30">
                            <div
                                class="bg-white p-1 rounded-full shadow-sm border border-gray-100 flex items-center justify-center">
                                <div
                                    class="w-14 h-14 bg-gray-50 rounded-full flex items-center justify-center overflow-hidden">
                                    <img src="{{ asset('logo_kiri.png') }}" alt="Logo GenBI"
                                        class="w-10 h-10 object-contain">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 sm:px-8 pb-8 relative z-10 bg-gray-50/50 flex-1 overflow-y-auto hide-scrollbar pt-10">
                        <div
                            class="bg-white rounded-3xl p-6 sm:p-8 border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.06)] mb-8 mt-2 relative">
                            <h4
                                class="text-2xl font-black text-blue-800 mb-6 flex items-center gap-4 border-b border-gray-100 pb-4">
                                <div
                                    class="w-12 h-12 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center font-black text-xl shadow-inner">
                                    A</div> Kriteria Umum Mahasiswa
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @php $kriteriaArray = explode("\n", str_replace("\r", "", $valKriteria)); @endphp
                                @foreach ($kriteriaArray as $kriteria)
                                    @if (trim($kriteria) != '')
                                        @php
                                            $lowerText = strtolower($kriteria);
                                            $icon =
                                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>';
                                            if (
                                                str_contains($lowerText, 'ipk') ||
                                                str_contains($lowerText, 'sks') ||
                                                str_contains($lowerText, 'kuliah')
                                            ) {
                                                $icon =
                                                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path>';
                                            } elseif (
                                                str_contains($lowerText, 'usia') ||
                                                str_contains($lowerText, 'resume') ||
                                                str_contains($lowerText, 'cv')
                                            ) {
                                                $icon =
                                                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>';
                                            } elseif (
                                                str_contains($lowerText, 'sosial') ||
                                                str_contains($lowerText, 'masyarakat') ||
                                                str_contains($lowerText, 'keluarga')
                                            ) {
                                                $icon =
                                                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>';
                                            } elseif (
                                                str_contains($lowerText, 'surat') ||
                                                str_contains($lowerText, 'rekomendasi')
                                            ) {
                                                $icon =
                                                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>';
                                            } elseif (
                                                str_contains($lowerText, 'pidana') ||
                                                str_contains($lowerText, 'narkoba') ||
                                                str_contains($lowerText, 'norma')
                                            ) {
                                                $icon =
                                                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>';
                                            } elseif (
                                                str_contains($lowerText, 'pddikti') ||
                                                str_contains($lowerText, 'aktif')
                                            ) {
                                                $icon =
                                                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>';
                                            }
                                        @endphp
                                        <div
                                            class="bg-gradient-to-r from-blue-50/50 to-transparent p-4 rounded-xl border-l-4 border-blue-500 shadow-sm flex gap-4 hover:bg-blue-50 hover:shadow-md transition-all duration-300">
                                            <div
                                                class="bg-white p-2 rounded-lg flex-shrink-0 h-max mt-0.5 shadow-sm border border-blue-100">
                                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">{!! $icon !!}</svg>
                                            </div>
                                            <p class="text-sm text-gray-700 font-medium leading-relaxed">
                                                {{ trim($kriteria) }}</p>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-gray-100 shadow-sm relative">
                            <h4
                                class="text-xl font-black text-blue-800 mb-6 flex items-center gap-4 border-b border-gray-100 pb-4">
                                <div
                                    class="w-10 h-10 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center font-black text-lg">
                                    B</div> Dokumen Pendukung
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @php $dokumenArray = explode("\n", str_replace("\r", "", $valDokumen)); @endphp
                                @foreach ($dokumenArray as $dokumen)
                                    @if (trim($dokumen) != '')
                                        @php
                                            $lowerText = strtolower($dokumen);
                                            $icon =
                                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>';
                                            if (
                                                str_contains($lowerText, 'ktp') ||
                                                str_contains($lowerText, 'ktm') ||
                                                str_contains($lowerText, 'biodata') ||
                                                str_contains($lowerText, 'cv')
                                            ) {
                                                $icon =
                                                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>';
                                            } elseif (
                                                str_contains($lowerText, 'kk') ||
                                                str_contains($lowerText, 'keluarga')
                                            ) {
                                                $icon =
                                                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>';
                                            } elseif (
                                                str_contains($lowerText, 'rekening') ||
                                                str_contains($lowerText, 'bank')
                                            ) {
                                                $icon =
                                                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>';
                                            } elseif (
                                                str_contains($lowerText, 'surat') ||
                                                str_contains($lowerText, 'letter') ||
                                                str_contains($lowerText, 'rekomendasi')
                                            ) {
                                                $icon =
                                                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>';
                                            } elseif (
                                                str_contains($lowerText, 'khs') ||
                                                str_contains($lowerText, 'studi')
                                            ) {
                                                $icon =
                                                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>';
                                            }
                                        @endphp
                                        <div
                                            class="bg-gradient-to-r from-slate-50 to-white p-4 rounded-xl border border-gray-200 shadow-sm flex items-start gap-4 hover:border-blue-400 hover:shadow-md transition-all duration-300 group">
                                            <div
                                                class="w-10 h-10 rounded-full bg-white text-blue-600 flex items-center justify-center flex-shrink-0 shadow-sm border border-blue-100 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">{!! $icon !!}</svg>
                                            </div>
                                            <p class="text-sm text-gray-700 font-medium leading-relaxed pt-2.5">
                                                {{ trim($dokumen) }}</p>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div
                        class="px-6 sm:px-8 py-5 bg-white border-t border-gray-100 flex justify-end gap-3 items-center flex-shrink-0">
                        @if (auth()->check() && in_array(auth()->user()->role, ['admin', 'sekretaris']))
                            <button type="button" onclick="toggleModal('modalEditBeasiswa')"
                                class="bg-amber-500 hover:bg-amber-600 text-white px-6 py-2.5 rounded-xl font-bold transition text-sm shadow-sm hover:shadow-lg flex items-center gap-2"><svg
                                    class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg> Edit Beasiswa</button>
                        @endif
                        <button type="button" onclick="toggleModal('modalInfoBeasiswa')"
                            class="bg-primary-blue hover:bg-blue-700 text-white px-8 py-2.5 rounded-xl font-bold transition text-sm shadow-sm hover:shadow-lg">Kembali</button>
                    </div>
                </div>
            </div>

            @if (auth()->check() &&
                    auth()->user()->role == 'anggota' &&
                    isset($agendaTerdekat) &&
                    $agendaTerdekat->isNotEmpty() &&
                    isset($tampilkanPopup) &&
                    $tampilkanPopup)
                <div id="popupAgenda"
                    class="fixed inset-0 z-[100] flex bg-gray-900/70 backdrop-blur-sm items-center justify-center p-4 transition-all duration-300">
                    <div
                        class="bg-white rounded-3xl shadow-2xl w-full max-w-lg p-6 relative z-[110] animate-modal border border-gray-50/50">
                        <div class="flex justify-between items-center mb-5 border-b border-gray-100 pb-3">
                            <div class="flex items-center gap-3">
                                <div
                                    class="bg-gradient-to-tr from-amber-500 to-yellow-400 text-white p-2.5 rounded-xl shadow-md shadow-amber-500/20">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-black text-gray-800 leading-tight">Agenda Kegiatan GenBI</h3>
                                    <p class="text-xs font-medium text-gray-400 mt-0.5">Informasi jadwal pelaksanaan
                                        kegiatan
                                        terdekat.</p>
                                </div>
                            </div>
                            <button type="button" onclick="tutupPopupAgenda()"
                                class="text-gray-400 hover:text-red-500 hover:bg-red-50 p-2 rounded-xl transition-colors"><svg
                                    class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg></button>
                        </div>
                        <div class="space-y-4 max-h-[55vh] overflow-y-auto pr-1 hide-scrollbar">
                            @foreach ($agendaTerdekat as $agenda)
                                @php
                                    $tgl = \Carbon\Carbon::parse($agenda->tanggal);
                                    $isToday = $tgl->isToday();
                                    $isTomorrow = $tgl->isTomorrow();
                                @endphp
                                <div
                                    class="p-4 rounded-2xl border transition-all duration-300 hover:translate-x-1 shadow-sm {{ $isToday ? 'bg-red-50/60 border-red-100' : ($isTomorrow ? 'bg-amber-50/60 border-amber-100' : 'bg-blue-50/40 border-blue-100/70') }}">
                                    <div class="flex justify-between items-center gap-2 mb-2">
                                        <span
                                            class="px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider shadow-sm {{ $isToday ? 'bg-gradient-to-r from-red-600 to-rose-500 text-white animate-pulse' : ($isTomorrow ? 'bg-gradient-to-r from-amber-500 to-yellow-500 text-white' : 'bg-gradient-to-r from-blue-600 to-blue-500 text-white') }}">{{ $isToday ? 'Hari Ini' : ($isTomorrow ? 'Besok' : 'Mendatang') }}</span>
                                        <span
                                            class="text-xs font-mono font-bold text-gray-500 bg-white border border-gray-100 px-2 py-0.5 rounded-md shadow-inner">{{ $tgl->translatedFormat('d F Y') }}</span>
                                    </div>
                                    <h4 class="font-black text-gray-800 text-sm tracking-tight leading-snug mb-3">
                                        {{ $agenda->nama_kegiatan }}</h4>
                                    <div
                                        class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs font-bold text-gray-600 mb-3 bg-white/80 p-2.5 rounded-xl border border-gray-100 shadow-inner">
                                        <div class="flex items-center gap-2 text-gray-700"><svg
                                                class="w-4 h-4 text-blue-500 flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg><span class="truncate">Jam:
                                                {{ $agenda->waktu ?? ($agenda->jam ?? 'Selesai') }}</span></div>
                                        <div class="flex items-center gap-2 text-gray-700"><svg
                                                class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg><span class="truncate"
                                                title="{{ $agenda->tempat ?? ($agenda->lokasi ?? '-') }}">Lokasi:
                                                {{ $agenda->tempat ?? ($agenda->lokasi ?? '-') }}</span></div>
                                    </div>
                                    <div class="flex items-center gap-2 text-xs font-bold text-gray-400">
                                        <span
                                            class="bg-gray-100 text-gray-600 px-2.5 py-1 rounded-md text-[11px] font-extrabold shadow-sm">Pelaksana:
                                            {{ $agenda->devisi }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-6 pt-4 border-t border-gray-100 flex justify-end">
                            <button type="button" onclick="tutupPopupAgenda()"
                                class="w-full sm:w-auto bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white px-8 py-3 rounded-xl font-black text-xs transition-all duration-300 shadow-lg shadow-blue-500/20 hover:-translate-y-0.5">Saya
                                Mengerti</button>
                        </div>
                    </div>
                </div>
            @endif

            <!-- ================= FOOTER DASHBOARD ================= -->
            <div
                class="mt-12 pt-6 border-t border-gray-200/60 pb-2 relative z-10 flex flex-col md:flex-row justify-between items-center gap-4 animate-fade-in-down">
                <p class="text-xs md:text-sm font-medium text-gray-500">
                    &copy; {{ date('Y') }} Sistem Informasi GenBI Komisariat USN Kolaka.
                </p>

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

                    @keyframes modalPop {
                        0% {
                            opacity: 0;
                            transform: scale(0.95) translateY(10px);
                        }

                        100% {
                            opacity: 1;
                            transform: scale(1) translateY(0);
                        }
                    }

                    .animate-modal {
                        animation: modalPop 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
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
                    function bukaEditDevisi(id, nama, deskripsi, warna) {
                        document.getElementById('edit_nama_devisi').value = nama;
                        document.getElementById('edit_deskripsi').value = deskripsi;
                        document.getElementById('edit_warna').value = warna;
                        document.getElementById('formEditDevisiAction').action = "{{ url('/dashboard/devisi') }}/" + id;
                        toggleModal('modalEditDevisi');
                    }

                    // LOGIKA CAROUSEL GALERI DOKUMENTASI GLOBAL
                    let carouselInterval;

                    function initCarouselSlider() {
                        if (carouselInterval) clearInterval(carouselInterval);
                        let currentSlide = 0;
                        const slides = document.querySelectorAll('#carouselGaleriDisplay .carousel-item');
                        if (slides.length > 0) {
                            slides.forEach((slide, idx) => {
                                if (idx === 0) {
                                    slide.classList.remove('opacity-0');
                                    slide.classList.add('opacity-100');
                                } else {
                                    slide.classList.remove('opacity-100');
                                    slide.classList.add('opacity-0');
                                }
                            });
                            carouselInterval = setInterval(() => {
                                if (slides.length <= 1) return;
                                slides[currentSlide].classList.remove('opacity-100');
                                slides[currentSlide].classList.add('opacity-0');
                                currentSlide = (currentSlide + 1) % slides.length;
                                slides[currentSlide].classList.remove('opacity-0');
                                slides[currentSlide].classList.add('opacity-100');
                            }, 3500);
                        }
                    }

                    document.addEventListener("DOMContentLoaded", function() {
                        initCarouselSlider();
                        const popup = document.getElementById('popupAgenda');
                        if (popup) {
                            document.body.style.overflow = 'hidden';
                        }
                    });

                    // 1 EVENT LISTENER SUBMIT UNTUK SEMUA FORM (MENGGUNAKAN AJAX/LATAR BELAKANG)
                    document.addEventListener('submit', function(e) {
                        if (e.target && e.target.id === 'formEditGenbi') {
                            e.preventDefault();
                            prosesSimpanInstan(e.target, 'modalEditGenbi', 'modalInfoGenbi');
                        } else if (e.target && e.target.id === 'formEditPoin') {
                            e.preventDefault();
                            prosesSimpanInstan(e.target, 'modalEditPoin', 'modalInfoPoin');
                        } else if (e.target && e.target.id === 'formEditBeasiswa') {
                            e.preventDefault();
                            prosesSimpanInstan(e.target, 'modalEditBeasiswa', 'modalInfoBeasiswa');
                        } else if (e.target && e.target.id === 'formHapusMasal') {
                            e.preventDefault();
                            prosesHapusMasalInstan(e.target);
                        }
                    });

                    // FUNGSI UTAMA: PROSES HAPUS MASSAL TANPA REFRESH
                    function prosesHapusMasalInstan(form) {
                        let btn = document.getElementById('btnHapusMasal');
                        let originalText = btn.innerHTML;
                        let count = document.querySelectorAll('input[name="filenames[]"]:checked').length;

                        if (!confirm('Apakah Anda yakin ingin menghapus ' + count + ' foto tersebut secara permanen?')) return;

                        btn.innerText = "Menghapus...";
                        btn.disabled = true;

                        let token = document.querySelector('input[name="_token"]');

                        fetch(form.action, {
                                method: 'POST',
                                body: new FormData(form),
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': token ? token.value : ''
                                }
                            })
                            .then(response => {
                                if (!response.ok) throw new Error('Network error');
                                return response.text();
                            })
                            .then(html => {
                                const parser = new DOMParser();
                                const doc = parser.parseFromString(html, 'text/html');

                                document.getElementById('carouselGaleriDisplay').innerHTML = doc.getElementById(
                                    'carouselGaleriDisplay').innerHTML;
                                document.getElementById('gridFotoKelola').innerHTML = doc.getElementById('gridFotoKelola')
                                    .innerHTML;

                                document.getElementById('terpilihCount').innerText = "0";
                                btn.innerHTML = originalText;
                                btn.disabled = true;

                                tampilkanToastHapus(count);
                                initCarouselSlider();
                            })
                            .catch(error => {
                                alert("Kesalahan koneksi saat menghapus foto!");
                                btn.innerHTML = originalText;
                                btn.disabled = false;
                            });
                    }

                    // FUNGSI SIMPAN INFO & ATURAN POIN INSTAN (MENCEGAH REFRESH HALAMAN)
                    function prosesSimpanInstan(form, idModalEdit, idModalInfo) {
                        let btn = form.querySelector('button[type="submit"]');
                        let originalText = btn.innerText;
                        btn.innerText = "Menyimpan...";
                        btn.disabled = true;

                        // Pastikan Dynamic List disinkronkan ke Textarea sebelum di-submit
                        if (form.id === 'formEditBeasiswa' && typeof syncDynamicList === 'function') {
                            syncDynamicList('kriteria');
                            syncDynamicList('dokumen');
                        }

                        let token = document.querySelector('input[name="_token"]');

                        fetch(form.action, {
                                method: 'POST',
                                body: new FormData(form),
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': token ? token.value : ''
                                }
                            })
                            .then(response => {
                                if (!response.ok) throw new Error('Network error');
                                return response.text();
                            })
                            .then(html => {
                                const parser = new DOMParser();
                                const doc = parser.parseFromString(html, 'text/html');

                                const editModal = document.getElementById(idModalEdit);
                                const infoModal = document.getElementById(idModalInfo);

                                // Tutup modal edit, buka modal info
                                editModal.classList.add('hidden');
                                editModal.classList.remove('flex');
                                infoModal.classList.remove('hidden');
                                infoModal.classList.add('flex');

                                // Ganti isi konten dengan data terbaru dari database
                                const targetInfoContent = infoModal.querySelector('.animate-modal');
                                const newInfoContent = doc.getElementById(idModalInfo).querySelector('.animate-modal');
                                if (targetInfoContent && newInfoContent) {
                                    targetInfoContent.style.animation = 'none';
                                    targetInfoContent.innerHTML = newInfoContent.innerHTML;
                                }

                                const targetEditContent = editModal.querySelector('.animate-modal');
                                const newEditContent = doc.getElementById(idModalEdit).querySelector('.animate-modal');
                                if (targetEditContent && newEditContent) {
                                    targetEditContent.innerHTML = newEditContent.innerHTML;
                                }

                                document.body.style.overflow = 'hidden';

                                // Tampilkan notifikasi sukses
                                tampilkanToastSukses();

                                btn.innerText = originalText;
                                btn.disabled = false;
                            })
                            .catch(error => {
                                alert("Kesalahan koneksi saat menyimpan data!");
                                btn.innerText = originalText;
                                btn.disabled = false;
                            });
                    }

                    function tampilkanToastHapus(jumlah) {
                        let existingToast = document.getElementById('toast-ajax');
                        if (existingToast) existingToast.remove();

                        let div = document.createElement('div');
                        div.innerHTML = `
            <div id="toast-ajax" class="fixed top-5 right-5 z-[100] p-4 bg-white border-l-4 border-red-500 rounded-xl shadow-2xl flex items-center gap-4 transition-opacity duration-500">
                <div class="bg-red-100 text-red-600 p-2.5 rounded-full"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></div>
                <div>
                    <p class="text-sm font-black text-gray-800">Foto Berhasil Dihapus!</p>
                    <p class="text-xs text-gray-500 font-medium mt-0.5">${jumlah} foto telah dihapus dari galeri.</p>
                </div>
            </div>`;
                        document.body.appendChild(div.firstElementChild);
                        setTimeout(() => {
                            let t = document.getElementById('toast-ajax');
                            if (t) {
                                t.style.opacity = '0';
                                setTimeout(() => t.remove(), 500);
                            }
                        }, 3000);
                    }

                    function tampilkanToastSukses() {
                        let existingToast = document.getElementById('toast-ajax');
                        if (existingToast) existingToast.remove();

                        let div = document.createElement('div');
                        div.innerHTML = `
            <div id="toast-ajax" class="fixed top-5 right-5 z-[100] p-4 bg-white border-l-4 border-emerald-500 rounded-xl shadow-2xl flex items-center gap-4 transition-opacity duration-500">
                <div class="bg-emerald-100 text-emerald-600 p-2.5 rounded-full"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg></div>
                <div>
                    <p class="text-sm font-black text-gray-800">Berhasil Disimpan!</p>
                </div>
            </div>`;
                        document.body.appendChild(div.firstElementChild);
                        setTimeout(() => {
                            let t = document.getElementById('toast-ajax');
                            if (t) {
                                t.style.opacity = '0';
                                setTimeout(() => t.remove(), 500);
                            }
                        }, 3000);
                    }

                    function toggleModal(modalID) {
                        const modal = document.getElementById(modalID);
                        if (modal) {
                            if (modal.classList.contains('hidden')) {
                                document.body.style.overflow = 'hidden';
                                modal.classList.remove('hidden');
                                modal.classList.add('flex');

                                // Trigger Render Kotak Dinamis jika modal edit beasiswa dibuka
                                if (modalID === 'modalEditBeasiswa' && document.getElementById('hidden_kriteria')) {
                                    initDynamicList('kriteria');
                                    initDynamicList('dokumen');
                                }
                            } else {
                                document.body.style.overflow = 'auto';
                                modal.classList.add('hidden');
                                modal.classList.remove('flex');
                            }
                        }
                    }

                    function updateHapusButton() {
                        const checkboxes = document.querySelectorAll('input[name="filenames[]"]:checked');
                        const count = checkboxes.length;
                        const btn = document.getElementById('btnHapusMasal');

                        if (document.getElementById('terpilihCount')) document.getElementById('terpilihCount').innerText = count;
                        if (btn) btn.disabled = count === 0;
                    }

                    function tutupPopupAgenda() {
                        const modal = document.getElementById('popupAgenda');
                        if (modal) {
                            modal.classList.add('opacity-0', 'scale-95');
                            setTimeout(() => {
                                modal.remove();
                                document.body.style.overflow = 'auto';
                            }, 250);
                        }
                    }

                    // ==========================================
                    // DYNAMIC LIST BUILDER UNTUK BEASISWA
                    // ==========================================
                    function initDynamicList(type) {
                        const hiddenInput = document.getElementById('hidden_' + type);
                        const container = document.getElementById('container_' + type);
                        container.innerHTML = '';

                        const items = hiddenInput.value.split('\n');
                        let hasValidItem = false;

                        items.forEach(item => {
                            if (item.trim() !== '') {
                                addDynamicItem(type, item.trim());
                                hasValidItem = true;
                            }
                        });

                        if (!hasValidItem) {
                            addDynamicItem(type, '');
                        }
                    }

                    function addDynamicItem(type, value = '') {
                        const container = document.getElementById('container_' + type);
                        const itemDiv = document.createElement('div');
                        itemDiv.className = 'flex items-start gap-2.5 group animate-fade-in-down';

                        itemDiv.innerHTML = `
                <div class="mt-1 w-7 h-7 flex items-center justify-center rounded-lg bg-gray-100 text-gray-400 font-black text-xs flex-shrink-0 item-number transition-colors group-focus-within:bg-blue-100 group-focus-within:text-blue-600 border border-transparent group-focus-within:border-blue-200"></div>
                <textarea rows="2" class="flex-1 border border-gray-200 hover:border-blue-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all resize-none shadow-sm text-gray-700 font-medium bg-white" placeholder="Ketik rincian di sini..." oninput="syncDynamicList('${type}')">${value}</textarea>
                <button type="button" onclick="hapusDynamicItem(this, '${type}')" class="mt-1 w-8 h-8 flex items-center justify-center rounded-xl bg-red-50 text-red-400 hover:bg-red-500 hover:text-white transition-all opacity-0 group-hover:opacity-100 flex-shrink-0 shadow-sm border border-red-100 hover:border-transparent" title="Hapus Poin">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            `;

                        container.appendChild(itemDiv);
                        syncDynamicList(type);

                        if (value === '') {
                            const textarea = itemDiv.querySelector('textarea');
                            textarea.focus();
                            textarea.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });
                        }
                    }

                    function hapusDynamicItem(btnElement, type) {
                        btnElement.parentElement.remove();
                        syncDynamicList(type);
                    }

                    function syncDynamicList(type) {
                        const container = document.getElementById('container_' + type);
                        const textareas = container.querySelectorAll('textarea');
                        const numbers = container.querySelectorAll('.item-number');

                        let values = [];
                        textareas.forEach((ta, index) => {
                            if (numbers[index]) numbers[index].innerText = index + 1;
                            if (ta.value.trim() !== '') {
                                values.push(ta.value.trim());
                            }
                        });

                        document.getElementById('hidden_' + type).value = values.join('\n');
                    }
                </script>
            @endsection
