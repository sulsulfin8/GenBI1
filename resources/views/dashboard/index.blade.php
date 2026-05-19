@extends('layout.app')

@section('content')
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
                        </svg>
                        Kelola Foto
                    </button>

                    <button onclick="toggleModal('modalUploadDokumentasi')"
                        class="bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white px-4 py-2 rounded-xl text-sm font-bold transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Foto
                    </button>
                </div>
            @endif
        </div>

        <div id="carouselGaleriDisplay"
            class="relative w-full h-[350px] md:h-[450px] rounded-2xl overflow-hidden group shadow-inner bg-gray-900">
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
                <div class="carousel-item absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0">
                    <img src="{{ asset('bahan1/2.JPG') }}"
                        class="absolute inset-0 w-full h-full object-cover blur-xl opacity-60 scale-110 pointer-events-none"
                        alt="blur">
                    <img src="{{ asset('bahan1/2.JPG') }}" alt="Default"
                        class="relative z-10 w-full h-full object-contain drop-shadow-2xl">
                </div>
            @endif

            <div
                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent pointer-events-none z-20">
            </div>
            <div class="absolute bottom-6 left-6 md:bottom-8 md:left-8 text-white z-30">
                <span
                    class="bg-primary-blue text-xs font-bold px-3 py-1 rounded-full uppercase tracking-widest mb-3 inline-block">Galeri</span>
                <h4 class="text-2xl md:text-3xl font-extrabold shadow-sm">Momen Kebersamaan</h4>
                <p class="text-sm md:text-base opacity-90 mt-1 max-w-xl">Dokumentasi kegiatan GenBI Sulawesi Tenggara
                    Komisariat USN Kolaka.</p>
            </div>
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
                    <button onclick="toggleModal('modalKelolaDokumentasi')"
                        class="text-gray-400 hover:text-red-500 hover:bg-red-50 p-2 rounded-xl transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
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
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                        d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </div>
                                        </div>

                                        <div
                                            class="absolute bottom-0 left-0 right-0 p-2 bg-gradient-to-t from-gray-900 to-transparent pointer-events-none">
                                            <p class="text-[10px] text-white font-medium truncate">{{ $foto }}</p>
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
                                class="bg-red-500 hover:bg-red-600 disabled:opacity-50 disabled:cursor-not-allowed text-white px-6 py-2.5 rounded-xl font-bold transition flex items-center gap-2 text-sm shadow-md shadow-red-500/30">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                                Hapus
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script>
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
            });

            // CENTRAL DELEGATED FORM SUBMISSION (ANTI-REFRESH)
            document.addEventListener('submit', function(e) {
                if (e.target && e.target.id === 'formEditGenbi') {
                    e.preventDefault();
                    prosesSimpanInstan(e.target, 'modalEditGenbi', 'modalInfoGenbi');
                } else if (e.target && e.target.id === 'formEditPoin') {
                    e.preventDefault();
                    prosesSimpanInstan(e.target, 'modalEditPoin', 'modalInfoPoin');
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
                // PERBAIKAN: Hanya men-disable fungsi tanpa menambah class manual yang bikin nyangkut
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
                        console.error(error);
                        alert("Kesalahan koneksi saat menghapus foto!");
                        btn.innerHTML = originalText;
                        btn.disabled = false;
                    });
            }

            // FUNGSI SIMPAN INFO & ATURAN POIN INSTAN (SUDAH DIPERBAIKI TANPA KEDIP)
            function prosesSimpanInstan(form, idModalEdit, idModalInfo) {
                let btn = form.querySelector('button[type="submit"]');
                let originalText = btn.innerText;

                btn.innerText = "Menyimpan...";
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

                        const editModal = document.getElementById(idModalEdit);
                        const infoModal = document.getElementById(idModalInfo);

                        // 1. Matikan modal edit & nyalakan info terlebih dahulu agar transisi mulus
                        editModal.classList.add('hidden');
                        editModal.classList.remove('flex');
                        infoModal.classList.remove('hidden');
                        infoModal.classList.add('flex');

                        // 2. GANTI HANYA TEKS DI DALAM ANIMASI. Jangan mereplace div "animate-modal"-nya!
                        const targetInfoContent = infoModal.querySelector('.animate-modal');
                        const newInfoContent = doc.getElementById(idModalInfo).querySelector('.animate-modal');
                        if (targetInfoContent && newInfoContent) {
                            targetInfoContent.innerHTML = newInfoContent.innerHTML;
                        } else {
                            infoModal.innerHTML = doc.getElementById(idModalInfo).innerHTML;
                        }

                        const targetEditContent = editModal.querySelector('.animate-modal');
                        const newEditContent = doc.getElementById(idModalEdit).querySelector('.animate-modal');
                        if (targetEditContent && newEditContent) {
                            targetEditContent.innerHTML = newEditContent.innerHTML;
                        } else {
                            editModal.innerHTML = doc.getElementById(idModalEdit).innerHTML;
                        }

                        document.body.style.overflow = 'hidden';

                        // Panggil notifikasi pop-up hijau
                        if (typeof tampilkanToastSukses === "function") {
                            tampilkanToastSukses();
                        }

                        btn.innerText = originalText;
                        btn.disabled = false;
                    })
                    .catch(error => {
                        console.error(error);
                        alert("Kesalahan koneksi saat menyimpan data!");
                        btn.innerText = originalText;
                        btn.disabled = false;
                    });
            }

            // NOTIFIKASI MINI SUKSES HAPUS (MERAH)
            function tampilkanToastHapus(jumlah) {
                let existingToast = document.getElementById('toast-ajax');
                if (existingToast) existingToast.remove();

                let div = document.createElement('div');
                div.innerHTML = `
                <div id="toast-ajax" class="fixed top-5 right-5 z-[100] p-4 bg-white border-l-4 border-red-500 rounded-xl shadow-2xl flex items-center gap-4 transition-opacity duration-500">
                    <div class="bg-red-100 text-red-600 p-2.5 rounded-full">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-black text-gray-800">Foto Berhasil Dihapus!</p>
                        <p class="text-xs text-gray-500 font-medium mt-0.5">${jumlah} foto telah dihapus dari galeri.</p>
                    </div>
                </div>
            `;
                document.body.appendChild(div.firstElementChild);
                setTimeout(() => {
                    let t = document.getElementById('toast-ajax');
                    if (t) {
                        t.style.opacity = '0';
                        setTimeout(() => t.remove(), 500);
                    }
                }, 3000);
            }

            // NOTIFIKASI MINI SUKSES SIMPAN (HIJAU)
            function tampilkanToastSukses() {
                let existingToast = document.getElementById('toast-ajax');
                if (existingToast) existingToast.remove();

                let div = document.createElement('div');
                div.innerHTML = `
                <div id="toast-ajax" class="fixed top-5 right-5 z-[100] p-4 bg-white border-l-4 border-emerald-500 rounded-xl shadow-2xl flex items-center gap-4 transition-opacity duration-500">
                    <div class="bg-emerald-100 text-emerald-600 p-2.5 rounded-full">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-black text-gray-800">Berhasil Disimpan!</p>
                        <p class="text-xs text-gray-500 font-medium mt-0.5">Perubahan langsung diterapkan.</p>
                    </div>
                </div>
            `;
                document.body.appendChild(div.firstElementChild);
                setTimeout(() => {
                    let t = document.getElementById('toast-ajax');
                    if (t) {
                        t.style.opacity = '0';
                        setTimeout(() => t.remove(), 500);
                    }
                }, 3000);
            }

            // CONTROLLER BUKA/TUTUP POPUP
            function toggleModal(modalID) {
                const modal = document.getElementById(modalID);
                if (modal) {
                    if (modal.classList.contains('hidden')) {
                        document.body.style.overflow = 'hidden';
                        modal.classList.remove('hidden');
                        modal.classList.add('flex');
                    } else {
                        document.body.style.overflow = 'auto';
                        modal.classList.add('hidden');
                        modal.classList.remove('flex');
                    }
                }
            }

            // CONTROLLER REALTIME CHECKBOX HITUNGAN FOTO
            function updateHapusButton() {
                const checkboxes = document.querySelectorAll('input[name="filenames[]"]:checked');
                const count = checkboxes.length;
                const btn = document.getElementById('btnHapusMasal');

                if (document.getElementById('terpilihCount')) {
                    document.getElementById('terpilihCount').innerText = count;
                }
                if (btn) {
                    // Tailwind akan menangani pewarnaan tombol ini secara otomatis saat disabled
                    btn.disabled = count === 0;
                }
            }
        </script>
    @endif
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

                @php
                    $devisiMapping = [
                        'Pendidikan & Kebudayaan' => [
                            'kadep_value' => 'Ketua Devisi Pendidikan & Kebudayaan',
                            'color' => 'blue',
                            'label' => 'Pendidikan',
                        ],
                        'Pengabdian Masyarakat' => [
                            'kadep_value' => 'Ketua Devisi Pengabdian Masyarakat',
                            'color' => 'emerald',
                            'label' => 'Pengabdian Masyarakat',
                        ],
                        'Publikasi Dekorasi & Dokumentasi' => [
                            'kadep_value' => 'Ketua Devisi Pubdok',
                            'color' => 'purple',
                            'label' => 'Pubdekdok',
                        ],
                        'Kewirausahaan' => [
                            'kadep_value' => 'Ketua Devisi Kewirausahaan',
                            'color' => 'amber',
                            'label' => 'Kewirausaha',
                        ],
                        'Lingkungan Hidup' => [
                            'kadep_value' => 'Ketua Devisi Lingkungan Hidup',
                            'color' => 'teal',
                            'label' => 'Lingkungan Hidup',
                        ],
                    ];
                @endphp

                @foreach ($devisiMapping as $dbName => $config)
                    @php
                        $dataKadep = $semuaKadep[$config['kadep_value']] ?? null;
                        $anggotaListMentah = isset($anggotaDevisi) ? $anggotaDevisi->get($dbName, []) : [];

                        $anggotaList = collect($anggotaListMentah)->filter(function ($user) {
                            return empty($user->jabatan) || !str_contains($user->jabatan, 'Ketua Devisi');
                        });
                    @endphp

                    <div class="flex-1 flex flex-col items-center px-1.5 relative group">
                        <div class="w-0.5 h-6 bg-gray-300"></div>

                        <div
                            class="w-full bg-white p-3 rounded-2xl border-t-4 border-{{ $config['color'] }}-500 shadow-md text-center z-10 relative hover:-translate-y-1 transition-transform">
                            <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-1">Ketua Devisi</p>
                            <h4 class="text-[10px] font-extrabold text-{{ $config['color'] }}-700 leading-tight mb-2">
                                {{ $config['label'] }}</h4>
                            <div
                                class="w-12 h-12 rounded-full overflow-hidden border-2 border-{{ $config['color'] }}-100 mx-auto mb-2 shadow-sm bg-gray-50">
                                <img src="{{ $dataKadep && $dataKadep->photo ? asset('storage/' . $dataKadep->photo) : asset('img/default.png') }}"
                                    class="w-full h-full object-cover object-top">
                            </div>
                            <p class="text-[10px] font-black text-gray-800 truncate px-1"
                                title="{{ $dataKadep->name ?? 'Belum Ada' }}">{{ $dataKadep->name ?? 'Belum Ada' }}</p>
                        </div>

                        <div class="w-0.5 h-6 bg-gray-300"></div>

                        <div
                            class="w-full bg-white border border-gray-100 rounded-2xl p-3 shadow-sm flex-1 flex flex-col hover:border-{{ $config['color'] }}-200 transition-colors relative z-10">
                            <div class="text-center border-b border-gray-50 pb-1.5 mb-2">
                                <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest">Anggota Devisi</p>
                            </div>
                            <ul class="text-[10px] font-medium text-gray-600 space-y-2 flex-1 text-left px-1">
                                @forelse($anggotaList as $anggota)
                                    <li class="flex items-start gap-1.5 group/item">
                                        <span
                                            class="w-1 h-1 rounded-full bg-{{ $config['color'] }}-400 mt-1.5 flex-shrink-0 group-hover/item:scale-150 transition-transform"></span>
                                        <span
                                            class="leading-tight group-hover/item:text-{{ $config['color'] }}-600 transition-colors">{{ $anggota->name }}</span>
                                    </li>
                                @empty
                                    <li class="text-gray-400 italic text-center mt-3 text-[9px]">- Belum ada anggota -</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

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
                <p class="text-gray-500 text-sm mt-2 ml-11">Struktur kepengurusan dan fokus ruang lingkup kerja setiap
                    divisi.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <div
                class="bg-gradient-to-br from-gray-50 to-gray-100/50 border border-gray-200 rounded-2xl p-6 hover:-translate-y-1 hover:shadow-lg transition-all duration-300 group">
                <div
                    class="w-12 h-12 bg-gray-800 text-white rounded-xl flex items-center justify-center mb-5 shadow-md shadow-gray-400/50 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m3-4h1m-1 4h1m-5 8h8">
                        </path>
                    </svg>
                </div>
                <h4 class="font-black text-gray-800 text-lg mb-2">Pengurus Inti</h4>
                <p class="text-sm text-gray-600 leading-relaxed">
                    Terdiri dari Ketua, Sekretaris, dan Bendahara. Bertanggung jawab atas jalannya roda organisasi,
                    administrasi, sirkulasi keuangan, serta mengambil keputusan strategis komisariat.
                </p>
            </div>

            <div
                class="bg-gradient-to-br from-blue-50 to-blue-100/50 border border-blue-200 rounded-2xl p-6 hover:-translate-y-1 hover:shadow-lg hover:shadow-blue-100 transition-all duration-300 group">
                <div
                    class="w-12 h-12 bg-blue-500 text-white rounded-xl flex items-center justify-center mb-5 shadow-md shadow-blue-500/40 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                </div>
                <h4 class="font-black text-blue-900 text-lg mb-2">Pendidikan & Kebudayaan</h4>
                <p class="text-sm text-blue-800/80 leading-relaxed">
                    Berfokus pada peningkatan kapasitas akademik anggota dan masyarakat, serta pelestarian nilai-nilai
                    kebudayaan lokal melalui kegiatan seminar, diskusi, dan pelatihan.
                </p>
            </div>

            <div
                class="bg-gradient-to-br from-emerald-50 to-emerald-100/50 border border-emerald-200 rounded-2xl p-6 hover:-translate-y-1 hover:shadow-lg hover:shadow-emerald-100 transition-all duration-300 group">
                <div
                    class="w-12 h-12 bg-emerald-500 text-white rounded-xl flex items-center justify-center mb-5 shadow-md shadow-emerald-500/40 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                        </path>
                    </svg>
                </div>
                <h4 class="font-black text-emerald-900 text-lg mb-2">Pengabdian Masyarakat</h4>
                <p class="text-sm text-emerald-800/80 leading-relaxed">
                    Menjadi jembatan antara GenBI dan masyarakat. Menyelenggarakan kegiatan sosial, bantuan kemanusiaan, dan
                    program pemberdayaan untuk menebar energi positif secara langsung.
                </p>
            </div>

            <div
                class="bg-gradient-to-br from-purple-50 to-purple-100/50 border border-purple-200 rounded-2xl p-6 hover:-translate-y-1 hover:shadow-lg hover:shadow-purple-100 transition-all duration-300 group">
                <div
                    class="w-12 h-12 bg-purple-500 text-white rounded-xl flex items-center justify-center mb-5 shadow-md shadow-purple-500/40 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h4 class="font-black text-purple-900 text-lg mb-2">Pubdekdok</h4>
                <p class="text-sm text-purple-800/80 leading-relaxed">
                    Divisi Publikasi, Dekorasi & Dokumentasi. Menjadi ujung tombak penyebaran informasi, mengelola media
                    sosial, dan mendokumentasikan setiap momen penting kegiatan GenBI.
                </p>
            </div>

            <div
                class="bg-gradient-to-br from-orange-50 to-orange-100/50 border border-orange-200 rounded-2xl p-6 hover:-translate-y-1 hover:shadow-lg hover:shadow-orange-100 transition-all duration-300 group">
                <div
                    class="w-12 h-12 bg-orange-500 text-white rounded-xl flex items-center justify-center mb-5 shadow-md shadow-orange-500/40 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
                <h4 class="font-black text-orange-900 text-lg mb-2">Kewirausahaan</h4>
                <p class="text-sm text-orange-800/80 leading-relaxed">
                    Menumbuhkan jiwa *entrepreneurship* anggota. Menggagas ide bisnis kreatif, pencarian dana mandiri
                    (Danus), dan mendorong kemandirian finansial organisasi.
                </p>
            </div>

            <div
                class="bg-gradient-to-br from-teal-50 to-teal-100/50 border border-teal-200 rounded-2xl p-6 hover:-translate-y-1 hover:shadow-lg hover:shadow-teal-100 transition-all duration-300 group">
                <div
                    class="w-12 h-12 bg-teal-500 text-white rounded-xl flex items-center justify-center mb-5 shadow-md shadow-teal-500/40 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
                <h4 class="font-black text-teal-900 text-lg mb-2">Lingkungan Hidup</h4>
                <p class="text-sm text-teal-800/80 leading-relaxed">
                    Bergerak di bidang pelestarian alam. Menginisiasi program penghijauan, kampanye sadar sampah, dan
                    menanamkan kepedulian lingkungan kepada anggota maupun masyarakat sekitar.
                </p>
            </div>

        </div>
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

    @if (auth()->check() && in_array(auth()->user()->role, ['admin', 'sekretaris']))
        <div id="modalUploadDokumentasi"
            class="fixed inset-0 z-[60] hidden bg-gray-900/70 backdrop-blur-sm items-center justify-center p-4 transition-all">
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md p-6 relative animate-modal">
                <div class="flex justify-between items-center mb-5 border-b border-gray-100 pb-4">
                    <h3 class="text-xl font-black text-gray-800 leading-tight">Tambah Dokumentasi</h3>
                    <button onclick="toggleModal('modalUploadDokumentasi')"
                        class="text-gray-400 hover:text-red-500 hover:bg-red-50 p-2 rounded-xl transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <form action="{{ route('dashboard.upload_dokumentasi') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-xs font-black text-gray-500 uppercase mb-2">Pilih Foto Kegiatan</label>
                        <input type="file" name="foto" required accept="image/*"
                            class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 bg-gray-50 cursor-pointer">
                        <p class="text-xs text-gray-400 mt-2 font-medium">Format yang didukung: JPG, JPEG, PNG. Maksimal
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
    @endif

    <div id="modalInfoGenbi"
        class="fixed inset-0 z-50 hidden bg-gray-900/70 backdrop-blur-sm items-center justify-center p-4 sm:p-6 transition-all">
        <div
            class="bg-white rounded-3xl shadow-2xl w-full max-w-5xl flex flex-col overflow-hidden animate-modal max-h-[95vh] relative">
            <div
                class="bg-gradient-to-br from-blue-600 via-primary-blue to-blue-800 pt-8 pb-10 px-6 text-center relative z-30 flex-shrink-0 shadow-md">
                <button onclick="toggleModal('modalInfoGenbi')"
                    class="absolute top-4 right-4 z-20 bg-white/20 hover:bg-white/40 p-2.5 rounded-full shadow-sm transition backdrop-blur-md">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
                <div class="absolute inset-0 opacity-10"><svg class="w-full h-full" viewBox="0 0 100 100"
                        preserveAspectRatio="none">
                        <path fill="white" d="M0 100 C 20 0 50 0 100 100 Z"></path>
                    </svg></div>
                <h2 class="text-3xl font-extrabold text-white tracking-wide relative z-10 drop-shadow-md">GENBI SULTRA</h2>
                <p
                    class="text-blue-100 font-bold tracking-widest uppercase text-sm mt-2 bg-black/10 px-4 py-1 rounded-full inline-block relative z-10">
                    Komisariat USN Kolaka</p>
                <div class="absolute -bottom-7 left-1/2 transform -translate-x-1/2 z-30">
                    <div
                        class="bg-white p-1 rounded-full shadow-sm border border-gray-100 flex items-center justify-center">
                        <div class="w-14 h-14 bg-gray-50 rounded-full flex items-center justify-center overflow-hidden">
                            <img src="{{ asset('logo_kiri.png') }}" alt="Logo GenBI" class="w-10 h-10 object-contain">
                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-y-auto hide-scrollbar flex-1 relative z-10 bg-gray-50/50 p-6 sm:p-8 pt-10">
                <div class="text-center mb-10 mt-2">
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed max-w-2xl mx-auto">
                        GenBi Sultra Komisariat Universitas Sembilanbelas November Kolaka merupakan Komunitas yang
                        beranggotakan mahasiswa/i penerima beasiswa Bank Indonesia. Berfokus pada <span
                            class="font-bold text-primary-blue">pengembangan diri, kegiatan sosial, dan pemberdayaan
                            masyarakat</span> untuk memperkuat eksistensi serta kontribusi organisasi dalam lingkup kampus
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
                            <p class="text-sm text-blue-700/80 leading-relaxed">Membantu mengkomunikasikan kebijakan Bank
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
                                    class="italic">role model</span> (teladan) yang membawa perubahan positif bagi kalangan
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
                            <p class="text-sm text-purple-700/80 leading-relaxed">Diharapkan mampu memimpin dan menjadi
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
                        <div class="bg-red-100 text-red-500 p-2 rounded-xl"><svg class="w-5 h-5" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                    clip-rule="evenodd"></path>
                            </svg></div>
                        Komitmen & Harapan
                    </h4>
                    <p class="text-sm text-gray-600 leading-relaxed text-justify relative z-10">
                        {{ $info->komitmen ?? '' }}</p>
                </div>

                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div
                        class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-3xl p-8 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group">
                        <div
                            class="w-14 h-14 bg-blue-500 rounded-2xl flex items-center justify-center mb-6 shadow-md shadow-blue-500/30 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                    <button onclick="toggleModal('modalEditGenbi')"
                        class="bg-amber-500 hover:bg-amber-600 text-white px-6 py-2.5 rounded-xl font-bold transition text-sm shadow-sm hover:shadow-lg flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        Edit Visi & Misi
                    </button>
                @endif
                <button onclick="toggleModal('modalInfoGenbi')"
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
                <button onclick="toggleModal('modalInfoPoin')"
                    class="absolute top-4 right-4 z-20 bg-white/20 hover:bg-white/40 p-2.5 rounded-full shadow-sm transition backdrop-blur-md">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
                <div class="absolute inset-0 opacity-10"><svg class="w-full h-full" viewBox="0 0 100 100"
                        preserveAspectRatio="none">
                        <path fill="white" d="M0 100 C 20 0 50 0 100 100 Z"></path>
                    </svg></div>
                <h2 class="text-3xl font-extrabold text-white tracking-wide relative z-10 drop-shadow-md">ATURAN POIN
                    KEAKTIFAN</h2>
                <p
                    class="text-blue-100 font-bold tracking-widest uppercase text-sm mt-2 bg-black/10 px-4 py-1 rounded-full inline-block relative z-10">
                    Sistem Reward & Punishment</p>

                <div class="absolute -bottom-7 left-1/2 transform -translate-x-1/2 z-30">
                    <div
                        class="bg-white p-1 rounded-full shadow-sm border border-gray-100 flex items-center justify-center">
                        <div class="w-14 h-14 bg-gray-50 rounded-full flex items-center justify-center overflow-hidden">
                            <img src="{{ asset('logo_kiri.png') }}" alt="Logo GenBI" class="w-10 h-10 object-contain">
                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-y-auto hide-scrollbar flex-1 relative z-10 bg-gray-50/50 p-6 sm:p-8 pt-10">
                <div
                    class="bg-amber-50 border border-amber-100 p-4 rounded-2xl flex items-center gap-4 mb-8 shadow-sm mt-2">
                    <div class="bg-amber-100 p-2 rounded-xl">
                        <svg class="w-6 h-6 text-amber-600 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                            </path>
                        </svg>
                    </div>
                    <p class="text-sm text-amber-800 font-bold uppercase tracking-wide">Semua Izin Kegiatan Harus Melalui
                        SEKERTARIS UMUM!</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <h4 class="text-red-600 font-black uppercase text-xs tracking-widest flex items-center gap-2">
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
                                <p class="text-xs text-red-700 font-bold uppercase leading-relaxed italic text-center">
                                    Sakit/Kerja tdk berkontribusi min 40 hari = LANGSUNG SP 3</p>
                            </div>
                        </div>

                        <div class="bg-white border border-blue-100 rounded-2xl p-4 space-y-4 shadow-sm mt-4">
                            <h5 class="text-[10px] font-bold text-blue-500 uppercase tracking-widest">Aturan QRIS (Target
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
                                <span class="w-2 h-2 rounded-full bg-green-500"></span> Apresiasi & Pengurangan Poin
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
                                            <p class="text-xs text-gray-500 mb-1 font-bold uppercase">{{ trim($name) }}
                                            </p>
                                            <p class="text-2xl font-black text-green-600">{{ $scoreNum }} <span
                                                    class="text-sm font-medium">Poin</span></p>
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
                                                    <p class="text-xs opacity-90 font-bold uppercase">Ambang Batas
                                                        {{ $numeral }}</p>
                                                    <p class="text-lg font-black leading-tight">{{ trim($name) }}</p>
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
                    <button onclick="toggleModal('modalEditPoin')"
                        class="bg-amber-500 hover:bg-amber-600 text-white px-6 py-2.5 rounded-xl font-bold transition text-sm shadow-sm hover:shadow-lg flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        Edit Aturan Poin
                    </button>
                @endif
                <button onclick="toggleModal('modalInfoPoin')"
                    class="bg-primary-blue hover:bg-blue-700 text-white px-8 py-2.5 rounded-xl font-bold transition text-sm shadow-sm hover:shadow-lg">Kembali</button>
            </div>
        </div>
    </div>

    <div id="modalInfoBeasiswa"
        class="fixed inset-0 z-50 hidden bg-gray-900/70 backdrop-blur-sm items-center justify-center p-4 sm:p-6 transition-all">
        <div
            class="bg-white rounded-3xl shadow-2xl w-full max-w-5xl flex flex-col overflow-hidden animate-modal max-h-[95vh] relative">

            <div
                class="bg-gradient-to-br from-blue-600 via-primary-blue to-blue-800 pt-8 pb-10 px-6 text-center relative z-30 flex-shrink-0 shadow-md">
                <button onclick="toggleModal('modalInfoBeasiswa')"
                    class="absolute top-4 right-4 z-20 bg-white/20 hover:bg-white/40 p-2.5 rounded-full shadow-sm transition backdrop-blur-md">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
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

                <div class="absolute -bottom-7 left-1/2 transform -translate-x-1/2 z-30">
                    <div
                        class="bg-white p-1 rounded-full shadow-sm border border-gray-100 flex items-center justify-center">
                        <div class="w-14 h-14 bg-gray-50 rounded-full flex items-center justify-center overflow-hidden">
                            <img src="{{ asset('logo_kiri.png') }}" alt="Logo GenBI" class="w-10 h-10 object-contain">
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
                            A</div>
                        Kriteria Umum Mahasiswa
                    </h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div
                            class="flex items-start gap-3 p-3 rounded-xl hover:bg-blue-50 transition duration-300 border border-transparent hover:border-blue-100">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <p class="text-sm text-gray-700 font-medium">Mahasiswa aktif dan terdata pada PDDikti.</p>
                        </div>
                        <div
                            class="flex items-start gap-3 p-3 rounded-xl hover:bg-blue-50 transition duration-300 border border-transparent hover:border-blue-100">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <p class="text-sm text-gray-700 font-medium">Telah menyelesaikan min. 40 SKS (berada di
                                semester 4 s/d semester 6) pada Prodi yang ditentukan.</p>
                        </div>
                        <div
                            class="flex items-start gap-3 p-3 rounded-xl hover:bg-blue-50 transition duration-300 border border-transparent hover:border-blue-100">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <p class="text-sm text-gray-700 font-medium">Memiliki IPK minimal 3.00 (skala 4.00).</p>
                        </div>
                        <div
                            class="flex items-start gap-3 p-3 rounded-xl hover:bg-blue-50 transition duration-300 border border-transparent hover:border-blue-100">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <p class="text-sm text-gray-700 font-medium">Usia maksimal 23 tahun (belum genap 24 tahun) saat
                                menerima beasiswa.</p>
                        </div>
                        <div
                            class="flex items-start gap-3 p-3 rounded-xl hover:bg-blue-50 transition duration-300 border border-transparent hover:border-blue-100">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <p class="text-sm text-gray-700 font-medium">Membuat Resume Pribadi (CV).</p>
                        </div>
                        <div
                            class="flex items-start gap-3 p-3 rounded-xl hover:bg-blue-50 transition duration-300 border border-transparent hover:border-blue-100">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <p class="text-sm text-gray-700 font-medium">Membuat Surat Motivasi (termasuk rencana karir
                                setelah lulus).</p>
                        </div>
                        <div
                            class="flex items-start gap-3 p-3 rounded-xl hover:bg-blue-50 transition duration-300 border border-transparent hover:border-blue-100">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <p class="text-sm text-gray-700 font-medium">Tidak sedang menerima beasiswa/ikatan dinas dari
                                instansi lain.</p>
                        </div>
                        <div
                            class="flex items-start gap-3 p-3 rounded-xl hover:bg-blue-50 transition duration-300 border border-transparent hover:border-blue-100">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <p class="text-sm text-gray-700 font-medium">Memiliki pengalaman aktivitas sosial yang
                                bermanfaat bagi masyarakat.</p>
                        </div>
                        <div
                            class="flex items-start gap-3 p-3 rounded-xl hover:bg-blue-50 transition duration-300 border border-transparent hover:border-blue-100">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <p class="text-sm text-gray-700 font-medium">Berasal dari keluarga berlatar belakang ekonomi
                                pra sejahtera (kurang mampu).</p>
                        </div>
                        <div
                            class="flex items-start gap-3 p-3 rounded-xl hover:bg-blue-50 transition duration-300 border border-transparent hover:border-blue-100">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <p class="text-sm text-gray-700 font-medium">Tidak melanggar norma kampus, sosial, serta bebas
                                pidana & narkoba.</p>
                        </div>
                        <div
                            class="md:col-span-2 flex items-start gap-3 p-4 bg-blue-50/50 rounded-xl border border-blue-100 mt-2">
                            <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <p class="text-sm text-blue-900 font-bold">Bersedia berperan aktif dalam komunitas GenBI dan
                                tunduk pada seluruh syarat ketentuan program beasiswa Bank Indonesia.</p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-3xl p-6 sm:p-8 border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.06)] relative">
                    <h4
                        class="text-2xl font-black text-blue-800 mb-6 flex items-center gap-4 border-b border-gray-100 pb-4">
                        <div
                            class="w-12 h-12 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center font-black text-xl shadow-inner">
                            B</div>
                        Dokumen Pendukung
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div
                            class="flex items-start gap-4 p-3 rounded-xl hover:bg-blue-50 transition duration-300 border border-transparent hover:border-blue-100 group">
                            <div
                                class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 text-blue-600 group-hover:bg-blue-500 group-hover:text-white flex items-center justify-center font-extrabold text-sm shadow-sm transition-all duration-300">
                                1</div>
                            <p class="text-sm text-gray-700 font-medium pt-1">Biodata Mahasiswa (sesuai lampiran).</p>
                        </div>
                        <div
                            class="flex items-start gap-4 p-3 rounded-xl hover:bg-blue-50 transition duration-300 border border-transparent hover:border-blue-100 group">
                            <div
                                class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 text-blue-600 group-hover:bg-blue-500 group-hover:text-white flex items-center justify-center font-extrabold text-sm shadow-sm transition-all duration-300">
                                2</div>
                            <p class="text-sm text-gray-700 font-medium pt-1">Salinan KTP atau KTM yang masih berlaku.</p>
                        </div>
                        <div
                            class="flex items-start gap-4 p-3 rounded-xl hover:bg-blue-50 transition duration-300 border border-transparent hover:border-blue-100 group">
                            <div
                                class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 text-blue-600 group-hover:bg-blue-500 group-hover:text-white flex items-center justify-center font-extrabold text-sm shadow-sm transition-all duration-300">
                                3</div>
                            <p class="text-sm text-gray-700 font-medium pt-1">Salinan Kartu Keluarga (KK).</p>
                        </div>
                        <div
                            class="flex items-start gap-4 p-3 rounded-xl hover:bg-blue-50 transition duration-300 border border-transparent hover:border-blue-100 group">
                            <div
                                class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 text-blue-600 group-hover:bg-blue-500 group-hover:text-white flex items-center justify-center font-extrabold text-sm shadow-sm transition-all duration-300">
                                4</div>
                            <p class="text-sm text-gray-700 font-medium pt-1">Lembar Kartu Hasil Studi (KHS) 3 semester
                                terakhir.</p>
                        </div>
                        <div
                            class="flex items-start gap-4 p-3 rounded-xl hover:bg-blue-50 transition duration-300 border border-transparent hover:border-blue-100 group">
                            <div
                                class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 text-blue-600 group-hover:bg-blue-500 group-hover:text-white flex items-center justify-center font-extrabold text-sm shadow-sm transition-all duration-300">
                                5</div>
                            <p class="text-sm text-gray-700 font-medium pt-1">Surat Keterangan Aktif Kuliah.</p>
                        </div>
                        <div
                            class="flex items-start gap-4 p-3 rounded-xl hover:bg-blue-50 transition duration-300 border border-transparent hover:border-blue-100 group">
                            <div
                                class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 text-blue-600 group-hover:bg-blue-500 group-hover:text-white flex items-center justify-center font-extrabold text-sm shadow-sm transition-all duration-300">
                                6</div>
                            <p class="text-sm text-gray-700 font-medium pt-1">Resume Pribadi (CV).</p>
                        </div>
                        <div
                            class="flex items-start gap-4 p-3 rounded-xl hover:bg-blue-50 transition duration-300 border border-transparent hover:border-blue-100 group">
                            <div
                                class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 text-blue-600 group-hover:bg-blue-500 group-hover:text-white flex items-center justify-center font-extrabold text-sm shadow-sm transition-all duration-300">
                                7</div>
                            <p class="text-sm text-gray-700 font-medium pt-1">Motivation Letter (dalam Bahasa Indonesia).
                            </p>
                        </div>
                        <div
                            class="flex items-start gap-4 p-3 rounded-xl hover:bg-blue-50 transition duration-300 border border-transparent hover:border-blue-100 group">
                            <div
                                class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 text-blue-600 group-hover:bg-blue-500 group-hover:text-white flex items-center justify-center font-extrabold text-sm shadow-sm transition-all duration-300">
                                8</div>
                            <p class="text-sm text-gray-700 font-medium pt-1">Surat Rekomendasi dari 1 tokoh
                                (akademik/non-akademik).</p>
                        </div>
                        <div
                            class="flex items-start gap-4 p-3 rounded-xl hover:bg-blue-50 transition duration-300 border border-transparent hover:border-blue-100 group">
                            <div
                                class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 text-blue-600 group-hover:bg-blue-500 group-hover:text-white flex items-center justify-center font-extrabold text-sm shadow-sm transition-all duration-300">
                                9</div>
                            <p class="text-sm text-gray-700 font-medium pt-1">Surat Keterangan tidak sedang menerima
                                beasiswa instansi lain.</p>
                        </div>
                        <div
                            class="flex items-start gap-4 p-3 rounded-xl hover:bg-blue-50 transition duration-300 border border-transparent hover:border-blue-100 group">
                            <div
                                class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 text-blue-600 group-hover:bg-blue-500 group-hover:text-white flex items-center justify-center font-extrabold text-sm shadow-sm transition-all duration-300">
                                10</div>
                            <p class="text-sm text-gray-700 font-medium pt-1">Surat Keterangan Keluarga Tidak Mampu (dari
                                kelurahan/kecamatan).</p>
                        </div>
                        <div
                            class="flex items-start gap-4 p-3 rounded-xl hover:bg-blue-50 transition duration-300 border border-transparent hover:border-blue-100 group">
                            <div
                                class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 text-blue-600 group-hover:bg-blue-500 group-hover:text-white flex items-center justify-center font-extrabold text-sm shadow-sm transition-all duration-300">
                                11</div>
                            <p class="text-sm text-gray-700 font-medium pt-1">Surat Pernyataan kesanggupan aktif di
                                komunitas GenBI.</p>
                        </div>
                        <div
                            class="flex items-start gap-4 p-3 rounded-xl hover:bg-blue-50 transition duration-300 border border-transparent hover:border-blue-100 group">
                            <div
                                class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 text-blue-600 group-hover:bg-blue-500 group-hover:text-white flex items-center justify-center font-extrabold text-sm shadow-sm transition-all duration-300">
                                12</div>
                            <p class="text-sm text-gray-700 font-medium pt-1">Salinan buku rekening bank (bagian depan
                                dalam) atas nama mahasiswa.</p>
                        </div>
                    </div>
                </div>

            </div>

            <div
                class="p-4 bg-white border-t border-gray-100 flex justify-end items-center z-20 flex-shrink-0 rounded-b-3xl">
                <button onclick="toggleModal('modalInfoBeasiswa')"
                    class="bg-primary-blue hover:bg-blue-700 text-white px-8 py-2.5 rounded-xl font-bold transition text-sm shadow-sm hover:shadow-lg">Kembali</button>
            </div>
        </div>
    </div>

    @if (auth()->check() && in_array(auth()->user()->role, ['admin', 'sekretaris']))
        <div id="modalEditGenbi"
            class="fixed inset-0 z-[60] hidden bg-gray-900/70 backdrop-blur-sm items-center justify-center p-4 sm:p-6 transition-all">
            <div
                class="bg-white rounded-3xl shadow-2xl w-full max-w-3xl flex flex-col overflow-hidden animate-modal max-h-[95vh] relative">
                <div
                    class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50 flex-shrink-0 z-20">
                    <h3 class="text-lg font-extrabold text-gray-800">Edit Informasi GenBI</h3>
                    <button onclick="toggleModal('modalEditGenbi')"
                        class="text-gray-400 hover:text-red-500 hover:bg-red-50 p-2 rounded-xl transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
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
                        <label class="block text-sm font-bold text-gray-700 uppercase mb-2">Misi (Pisahkan tiap misi dengan
                            baris baru / Enter)</label>
                        <textarea name="misi" rows="6" required
                            class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-4 focus:ring-blue-500/20 focus:border-blue-400 bg-gray-50 focus:bg-white transition-all">{{ $info->misi ?? '' }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 uppercase mb-2">Komitmen & Harapan</label>
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
                    <button onclick="toggleModal('modalEditPoin')"
                        class="text-gray-400 hover:text-red-500 hover:bg-red-50 p-2 rounded-xl transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form id="formEditPoin" action="{{ route('dashboard.update_poin') }}" method="POST"
                    class="p-6 space-y-6 overflow-y-auto hide-scrollbar flex-1 z-10">
                    @csrf
                    <div class="bg-blue-50 p-4 rounded-xl border border-blue-100 mb-4 flex gap-3 items-start">
                        <svg class="w-6 h-6 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-sm text-blue-800 font-medium leading-relaxed">
                            <b>Panduan:</b> Untuk mengubah data poin, gunakan format <code>Nama Aturan: Nilai Poin</code>.
                            Pisahkan setiap aturan dengan baris baru (Enter). Contoh: <i>Telat datang: +5 Poin</i>.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase mb-2">Pelanggaran & Penambahan
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
                            <label class="block text-sm font-bold text-gray-700 uppercase mb-2">Apresiasi & Pengurangan
                                Poin</label>
                            <textarea name="apresiasi" rows="4"
                                class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-4 focus:ring-blue-500/20 focus:border-blue-400 bg-gray-50 focus:bg-white transition-all">{{ $info->apresiasi ?? "Rajin: -3 Poin\nAktif: -2 Poin" }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase mb-2">Ambang Batas Peringatan
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
    @endif
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // LOGIKA CAROUSEL GALERI DOKUMENTASI
            let currentSlide = 0;
            const slides = document.querySelectorAll('.carousel-item');
            if (slides.length > 0) {
                setInterval(() => {
                    slides[currentSlide].classList.remove('opacity-100');
                    slides[currentSlide].classList.add('opacity-0');
                    currentSlide = (currentSlide + 1) % slides.length;
                    slides[currentSlide].classList.remove('opacity-0');
                    slides[currentSlide].classList.add('opacity-100');
                }, 3500);
            }
        });

        // DELEGASI EVENT SUBMIT (SOLUSI AMPUH AGAR BISA SAVE BERKALI-KALI)
        document.addEventListener('submit', function(e) {
            if (e.target && e.target.id === 'formEditGenbi') {
                e.preventDefault();
                prosesSimpanInstan(e.target, 'modalEditGenbi', 'modalInfoGenbi');
            } else if (e.target && e.target.id === 'formEditPoin') {
                e.preventDefault();
                prosesSimpanInstan(e.target, 'modalEditPoin', 'modalInfoPoin');
            }
        });

        // FUNGSI INTI AJAX TANPA KEDIP & TANPA ANIMASI BERULANG
        function prosesSimpanInstan(form, idModalEdit, idModalInfo) {
            let btn = form.querySelector('button[type="submit"]');
            let originalText = btn.innerText;

            btn.innerText = "Menyimpan...";
            btn.classList.add('opacity-50', 'cursor-not-allowed');
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

                    const editModal = document.getElementById(idModalEdit);
                    const infoModal = document.getElementById(idModalInfo);

                    // 1. Sembunyikan Modal Edit
                    if (editModal) {
                        editModal.classList.add('hidden');
                        editModal.classList.remove('flex');
                    }

                    // 2. Pastikan Info Modal Tampil
                    if (infoModal) {
                        infoModal.classList.remove('hidden');
                        infoModal.classList.add('flex');
                    }

                    // 3. Update konten Info Modal secara HALUS (Matikan animasi paksa)
                    const targetInfoContent = infoModal.querySelector('.animate-modal');
                    const newInfoContent = doc.getElementById(idModalInfo).querySelector('.animate-modal');

                    if (targetInfoContent && newInfoContent) {
                        // Trik Utama: Mematikan animasi CSS agar popup tidak melompat ulang!
                        targetInfoContent.style.animation = 'none';
                        targetInfoContent.innerHTML = newInfoContent.innerHTML;
                    }

                    // 4. Update juga konten Edit Modal di background
                    if (editModal) {
                        const targetEditContent = editModal.querySelector('.animate-modal');
                        const newEditContent = doc.getElementById(idModalEdit).querySelector('.animate-modal');
                        if (targetEditContent && newEditContent) {
                            targetEditContent.style.animation = 'none';
                            targetEditContent.innerHTML = newEditContent.innerHTML;
                        }
                    }

                    document.body.style.overflow = 'hidden';

                    // 5. Tampilkan notifikasi pop-up hijau
                    if (typeof tampilkanToastSukses === "function") {
                        tampilkanToastSukses();
                    } else if (typeof tampilkanToast === "function") {
                        tampilkanToast();
                    }

                    // 6. Kembalikan kondisi tombol
                    btn.innerText = originalText;
                    btn.classList.remove('opacity-50', 'cursor-not-allowed');
                    btn.disabled = false;
                })
                .catch(error => {
                    console.error(error);
                    alert("Kesalahan koneksi saat menyimpan data!");
                    btn.innerText = originalText;
                    btn.classList.remove('opacity-50', 'cursor-not-allowed');
                    btn.disabled = false;
                });
        }

        function tampilkanToast() {
            let existingToast = document.getElementById('toast-ajax');
            if (existingToast) existingToast.remove();

            let div = document.createElement('div');
            div.innerHTML = `
                <div id="toast-ajax" class="fixed top-5 right-5 z-[100] p-4 bg-white border-l-4 border-emerald-500 rounded-xl shadow-2xl flex items-center gap-4 transition-opacity duration-500">
                    <div class="bg-emerald-100 text-emerald-600 p-2.5 rounded-full">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-black text-gray-800">Berhasil Disimpan!</p>
                        <p class="text-xs text-gray-500 font-medium mt-0.5">Perubahan langsung diterapkan.</p>
                    </div>
                </div>
            `;
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
                } else {
                    document.body.style.overflow = 'auto';
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }
            }
        }
    </script>
@endsection
