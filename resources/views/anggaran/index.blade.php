@extends('layout.app')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Rancangan Anggaran</h1>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <div class="flex flex-col md:flex-row justify-end items-center mb-4 text-sm text-gray-600 gap-4">
            <form action="{{ route('anggaran') }}" method="GET" class="flex items-center gap-3 w-full md:w-auto">
                <div class="flex items-center gap-2">
                    <span class="hidden lg:inline text-gray-500 font-semibold">Filter Devisi:</span>
                    <select name="devisi" onchange="this.form.submit()"
                        class="border border-gray-300 rounded-lg px-3 py-1.5 focus:outline-none focus:border-primary-blue focus:ring-1 focus:ring-primary-blue bg-white font-medium text-gray-700 min-w-[150px] cursor-pointer">
                        <option value="">-- Semua Devisi --</option>
                        @foreach ($devisis as $dev)
                            @continue(in_array(strtolower($dev->nama_devisi), ['pengurus inti', 'presidium inti']))
                            <option value="{{ $dev->nama_devisi }}"
                                {{ request('devisi') == $dev->nama_devisi ? 'selected' : '' }}>{{ $dev->nama_devisi }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-center gap-2 relative">
                    <span class="hidden lg:inline font-semibold">Cari:</span>
                    <div class="relative flex items-center">
                        <input type="search" name="search" value="{{ request('search') }}"
                            oninput="if(this.value === '') this.form.submit();" placeholder="Nama kegiatan..."
                            class="border border-gray-300 rounded-lg px-3 py-1.5 pr-8 focus:outline-none focus:border-primary-blue focus:ring-1 focus:ring-primary-blue text-sm w-40 md:w-56">
                        <button type="submit" class="absolute right-2 text-gray-400 hover:text-primary-blue transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="overflow-x-auto rounded-xl border border-gray-100">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 border-b border-gray-200">
                        <th class="py-4 px-4 font-semibold text-sm w-12 text-center">No</th>
                        <th class="py-4 px-4 font-semibold text-sm">Kegiatan</th>
                        <th class="py-4 px-4 font-semibold text-sm">Devisi</th>
                        <th class="py-4 px-4 font-semibold text-sm text-center">Total RAB</th>
                        <th class="py-4 px-4 font-semibold text-sm text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($kegiatans as $keg)
                        <tr class="hover:bg-blue-50/20 transition">
                            <td class="py-4 px-4 text-center text-sm">{{ $loop->iteration }}</td>
                            <td class="py-4 px-4 font-medium text-gray-800 text-sm">{{ $keg->nama_kegiatan }}</td>
                            <td class="py-4 px-4 text-sm">{{ $keg->devisi }}</td>
                            <td class="py-4 px-4 text-center font-bold text-blue-600 text-sm">
                                Rp. {{ number_format($keg->anggarans->sum('total'), 0, ',', '.') }}
                            </td>
                            <td class="py-4 px-4 text-center">
                                <button onclick="openModalAnggaran({{ json_encode($keg) }})"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-lg text-xs font-bold hover:bg-blue-700 transition flex items-center gap-2 mx-auto">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                    Rancang Anggaran
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-10 text-center text-gray-500 bg-gray-50/50">
                                @if (request('devisi') || request('search'))
                                    Data rancangan anggaran tidak ditemukan untuk pencarian ini.
                                @else
                                    Belum ada kegiatan yang didaftarkan.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- MODAL RANCANG ANGGARAN (DESAIN PROFESIONAL)-->
    <!-- ========================================== -->
    <div id="modalRancangAnggaran"
        class="fixed inset-0 z-[60] hidden bg-slate-900/70 backdrop-blur-sm items-center justify-center p-4 sm:p-6 transition-all">
        <div
            class="bg-white rounded-[2rem] shadow-2xl w-full max-w-6xl flex flex-col overflow-hidden animate-modal max-h-[95vh] relative border border-gray-100">

            <div
                class="bg-white px-6 sm:px-8 py-5 border-b border-gray-100 flex items-center justify-between relative overflow-hidden flex-shrink-0 z-20">
                <div
                    class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-full blur-2xl -translate-y-1/2 translate-x-1/3 pointer-events-none">
                </div>
                <div class="relative z-10 flex items-center gap-4">
                    <div
                        class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center shadow-inner border border-blue-100/50">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-gray-800 tracking-tight leading-tight">Rancang Anggaran</h3>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-0.5">Rencana Anggaran Biaya
                            (RAB)</p>
                    </div>
                </div>
                <button type="button" onclick="toggleModal('modalRancangAnggaran')"
                    class="relative z-10 text-gray-400 hover:text-red-500 bg-gray-50 hover:bg-red-50 p-2.5 rounded-xl transition-colors border border-gray-100 shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <form id="formRancangAnggaran" action="{{ route('anggaran.store') }}" method="POST"
                class="flex flex-col flex-1 overflow-hidden z-10 bg-slate-50/50">
                @csrf
                <input type="hidden" name="kegiatan_id" id="modal_kegiatan_id">

                <div class="p-6 sm:p-8 space-y-6 overflow-y-auto hide-scrollbar flex-1">

                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-200 space-y-5">
                        <div class="flex items-center gap-3 border-b border-gray-100 pb-3">
                            <span
                                class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center font-black text-sm">1</span>
                            <label class="block text-sm font-black text-gray-800 uppercase tracking-tight">Informasi
                                Kegiatan</label>
                        </div>

                        <div>
                            <label class="block text-xs font-black text-gray-500 uppercase mb-2 ml-1">Nama Kegiatan
                                Terpilih</label>
                            <input type="text" name="nama_kegiatan" id="modal_nama" readonly
                                class="w-full border-2 border-gray-100 rounded-xl px-4 py-2.5 text-sm transition-all font-bold text-gray-800 bg-gray-50 shadow-inner cursor-not-allowed">
                        </div>

                        <div>
                            <label class="block text-xs font-black text-gray-500 uppercase mb-2 ml-1">Pengertian Kegiatan
                                <span class="text-red-500">*</span></label>
                            <textarea name="pengertian" id="modal_pengertian" rows="2" required
                                class="w-full border-2 border-gray-200 hover:border-blue-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-medium text-gray-700 bg-gray-50 focus:bg-white shadow-sm resize-none"
                                placeholder="Tuliskan pengertian / deskripsi kegiatan ini..."></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-black text-gray-500 uppercase mb-2 ml-1">Tujuan Kegiatan
                                    <span class="text-red-500">*</span></label>
                                <textarea name="tujuan" id="modal_tujuan" rows="2" required
                                    class="w-full border-2 border-gray-200 hover:border-blue-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-medium text-gray-700 bg-gray-50 focus:bg-white shadow-sm resize-none"
                                    placeholder="Tuliskan tujuan utama kegiatan ini..."></textarea>
                            </div>
                            <div>
                                <label class="block text-xs font-black text-gray-500 uppercase mb-2 ml-1">Manfaat Kegiatan
                                    <span class="text-red-500">*</span></label>
                                <textarea name="manfaat" id="modal_manfaat" rows="2" required
                                    class="w-full border-2 border-gray-200 hover:border-blue-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-medium text-gray-700 bg-gray-50 focus:bg-white shadow-sm resize-none"
                                    placeholder="Tuliskan manfaat yang diharapkan..."></textarea>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-black text-gray-500 uppercase mb-2 ml-1">Waktu Pelaksanaan
                                    <span class="text-red-500">*</span></label>
                                <input type="text" name="waktu" id="modal_waktu" required
                                    class="w-full border-2 border-gray-200 hover:border-blue-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-medium text-gray-700 bg-gray-50 focus:bg-white shadow-sm"
                                    placeholder="Contoh: 08:00 WITA - Selesai">
                            </div>
                            <div>
                                <label class="block text-xs font-black text-gray-500 uppercase mb-2 ml-1">Tempat / Lokasi
                                    <span class="text-red-500">*</span></label>
                                <input type="text" name="tempat" id="modal_tempat" required
                                    class="w-full border-2 border-gray-200 hover:border-blue-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-medium text-gray-700 bg-gray-50 focus:bg-white shadow-sm"
                                    placeholder="Contoh: Aula Rektorat USN Kolaka">
                            </div>
                        </div>
                    </div>

                    <!-- Rincian Barang (Format Tabel Profesional) -->
                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-200">
                        <div class="flex items-center justify-between border-b border-gray-100 pb-3 mb-5">
                            <div class="flex items-center gap-3">
                                <span
                                    class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center font-black text-sm">2</span>
                                <label class="block text-sm font-black text-gray-800 uppercase tracking-tight">Rincian
                                    Anggaran Biaya (RAB)</label>
                            </div>
                            <button type="button" onclick="tambahBarang()"
                                class="text-xs font-bold text-white bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-xl transition-all shadow-md shadow-blue-500/30 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                Tambah Baris
                            </button>
                        </div>

                        <!-- Tabel RAB -->
                        <div class="border border-gray-200 rounded-2xl overflow-hidden shadow-sm bg-white">
                            <div class="overflow-x-auto custom-scrollbar max-h-[35vh]">
                                <table class="w-full text-left border-collapse min-w-[800px]">
                                    <thead class="bg-gray-50/90 sticky top-0 z-10 backdrop-blur-sm shadow-sm">
                                        <tr>
                                            <th
                                                class="py-3 px-4 text-xs font-extrabold text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                                Nama Keperluan</th>
                                            <th
                                                class="py-3 px-4 text-xs font-extrabold text-gray-500 uppercase tracking-wider border-b border-gray-200 text-right w-40">
                                                Harga Satuan</th>
                                            <th
                                                class="py-3 px-4 text-xs font-extrabold text-gray-500 uppercase tracking-wider border-b border-gray-200 text-center w-24">
                                                Jumlah</th>
                                            <th
                                                class="py-3 px-4 text-xs font-extrabold text-gray-500 uppercase tracking-wider border-b border-gray-200 text-center w-28">
                                                Satuan</th>
                                            <th
                                                class="py-3 px-4 text-xs font-extrabold text-gray-500 uppercase tracking-wider border-b border-gray-200 text-right w-40">
                                                Subtotal</th>
                                            <th class="py-3 px-4 border-b border-gray-200 w-14"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="containerBarang" class="divide-y divide-gray-100">
                                        <!-- Javascript akan memasukkan <tr> di sini -->
                                    </tbody>
                                </table>
                            </div>

                            <!-- Total Keseluruhan Footer -->
                            <div class="bg-blue-50/80 p-5 border-t border-blue-100 flex justify-end items-center gap-6">
                                <span class="text-sm font-black text-gray-600 uppercase tracking-widest">Total
                                    Anggaran:</span>
                                <span class="text-2xl font-black text-blue-600 drop-shadow-sm">Rp <span
                                        id="totalKeseluruhan">0</span></span>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Footer Modal -->
                <div
                    class="px-6 sm:px-8 py-5 border-t border-gray-100 flex justify-end gap-3 items-center bg-white flex-shrink-0 z-20">
                    <button type="button" onclick="toggleModal('modalRancangAnggaran')"
                        class="px-6 py-2.5 text-gray-600 font-bold bg-gray-50 border border-gray-200 hover:bg-gray-100 hover:text-gray-800 rounded-xl text-sm transition-all shadow-sm">Batal</button>
                    <button type="submit"
                        class="bg-gradient-to-r from-emerald-600 to-emerald-500 hover:from-emerald-700 hover:to-emerald-600 text-white px-8 py-2.5 rounded-xl text-sm font-bold shadow-md shadow-emerald-500/30 transition hover:-translate-y-0.5 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Simpan RAB
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script Khusus Rancang Anggaran -->
    <script>
        let barangIndex = 0;

        // FUNGSI MEMBUKA MODAL DAN MENGISI DATA AWAL DARI DATABASE
        function openModalAnggaran(kegiatan) {
            document.getElementById('modal_kegiatan_id').value = kegiatan.id;
            document.getElementById('modal_nama').value = kegiatan.nama_kegiatan;
            document.getElementById('modal_pengertian').value = kegiatan.pengertian || '';
            document.getElementById('modal_tujuan').value = kegiatan.tujuan || '';
            document.getElementById('modal_manfaat').value = kegiatan.manfaat || '';
            document.getElementById('modal_waktu').value = kegiatan.waktu || '';
            document.getElementById('modal_tempat').value = kegiatan.tempat || '';

            // Bersihkan baris barang sebelumnya
            const container = document.getElementById('containerBarang');
            container.innerHTML = "";
            barangIndex = 0; // Reset index array

            // Cek apakah sudah ada anggaran tersimpan
            if (kegiatan.anggarans && kegiatan.anggarans.length > 0) {
                kegiatan.anggarans.forEach(ang => {
                    tambahBarang(ang.nama_barang, ang.harga_satuan, ang.jumlah, ang.satuan);
                });
            } else {
                tambahBarang(); // Berikan 1 baris kosong default
            }

            toggleModal('modalRancangAnggaran');
            hitungTotal();
        }

        // FUNGSI TAMBAH BARIS TABEL BARANG
        function tambahBarang(nama = '', harga = '', jumlah = '1', satuan = '') {
            const container = document.getElementById('containerBarang');
            const row = document.createElement('tr');
            row.className = 'hover:bg-blue-50/30 transition-colors group animate-fade-in-down';
            row.id = `barangRow_${barangIndex}`;

            // Format harga awal jika ada (untuk edit)
            let hargaFormatted = harga ? new Intl.NumberFormat('id-ID').format(harga) : '';

            row.innerHTML = `
                <td class="p-3">
                    <input type="text" name="items[${barangIndex}][nama]" value="${nama}" required placeholder="Spanduk, Snack..." 
                        class="w-full border border-gray-200 hover:border-blue-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-medium text-gray-700 bg-gray-50 focus:bg-white placeholder-gray-400">
                </td>
                <td class="p-3">
                    <div class="relative flex items-center">
                        <span class="absolute left-3 text-gray-400 font-bold text-xs">Rp</span>
                        <input type="text" name="items[${barangIndex}][harga]" value="${hargaFormatted}" required placeholder="0" oninput="formatRibuanDanHitung(this)" 
                            class="input-harga w-full border border-gray-200 hover:border-blue-300 rounded-lg pl-9 pr-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-medium text-gray-700 bg-gray-50 focus:bg-white text-right font-mono">
                    </div>
                </td>
                <td class="p-3">
                    <input type="number" name="items[${barangIndex}][qty]" value="${jumlah}" required placeholder="1" min="1" oninput="hitungTotal()" 
                        class="input-jumlah w-full border border-gray-200 hover:border-blue-300 rounded-lg px-2 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-medium text-gray-700 bg-gray-50 focus:bg-white text-center font-mono">
                </td>
                <td class="p-3">
                    <input type="text" name="items[${barangIndex}][satuan]" value="${satuan}" required placeholder="Pcs/Lbr" 
                        class="w-full border border-gray-200 hover:border-blue-300 rounded-lg px-2 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-medium text-gray-700 bg-gray-50 focus:bg-white text-center">
                </td>
                <td class="p-3 text-right">
                    <span class="text-sm font-bold text-gray-700 font-mono">Rp <span class="subtotal-text">0</span></span>
                </td>
                <td class="p-3 text-center">
                    <button type="button" onclick="hapusBarang('${row.id}')" 
                        class="w-8 h-8 mx-auto flex items-center justify-center rounded-lg bg-white text-red-400 hover:bg-red-500 hover:text-white transition-all opacity-0 group-hover:opacity-100 shadow-sm border border-gray-200 hover:border-transparent" title="Hapus Baris">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </td>
            `;

            container.appendChild(row);
            barangIndex++;

            // Hitung subtotal untuk baris yang baru ditambah jika merupakan hasil data Edit
            if (nama !== '') {
                hitungTotal();
            } else {
                container.parentElement.scrollTop = container.parentElement.scrollHeight;
            }
        }

        // FUNGSI HAPUS KOTAK
        function hapusBarang(rowId) {
            const row = document.getElementById(rowId);
            if (row) {
                row.remove();
                hitungTotal(); // Recalculate jika dihapus
            }
        }

        // FUNGSI MENGHAPUS TITIK SAAT DIKETIK DAN MENGHITUNG TOTAL
        function formatRibuanDanHitung(inputElement) {
            let value = inputElement.value.replace(/[^0-9]/g, ''); // Buang selain angka
            if (value !== '') {
                inputElement.value = new Intl.NumberFormat('id-ID').format(value); // Beri titik ribuan
            } else {
                inputElement.value = '';
            }
            hitungTotal();
        }

        // FUNGSI MENGHITUNG SUBTOTAL PER BARIS & TOTAL KESELURUHAN
        function hitungTotal() {
            let grandTotal = 0;
            const container = document.getElementById('containerBarang');
            if (!container) return;

            const rows = container.querySelectorAll('tr');

            rows.forEach(row => {
                const inputHarga = row.querySelector('.input-harga');
                const inputJumlah = row.querySelector('.input-jumlah');
                const subtotalText = row.querySelector('.subtotal-text');

                if (inputHarga && inputJumlah && subtotalText) {
                    // Ambil nilai asli tanpa titik ribuan
                    const hargaBersih = inputHarga.value.replace(/\./g, '');
                    const harga = parseFloat(hargaBersih) || 0;
                    const jumlah = parseFloat(inputJumlah.value) || 0;

                    // Hitung subtotal dan tampilkan di teks baris tersebut
                    const subtotal = harga * jumlah;
                    subtotalText.innerText = new Intl.NumberFormat('id-ID').format(subtotal);

                    grandTotal += subtotal;
                }
            });

            // Tampilkan total keseluruhan
            document.getElementById('totalKeseluruhan').innerText = new Intl.NumberFormat('id-ID').format(grandTotal);
        }

        // Fungsi buka/tutup modal
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

        // KUNCI PERBAIKAN: Submit menggunakan AJAX agar menetap di popup + Notifikasi Sukses
        document.getElementById('formRancangAnggaran').addEventListener('submit', function(e) {
            e.preventDefault(); // Mencegah halaman refresh / kembali

            let form = this;
            let btn = form.querySelector('button[type="submit"]');
            let originalText = btn.innerHTML;

            // Ubah tombol jadi status loading
            btn.innerHTML = 'Menyimpan...';
            btn.disabled = true;

            let formData = new FormData(form);

            // Bersihkan titik ribuan dari harga sebelum dikirim (tanpa mengubah tampilan input pengguna)
            const hargaInputs = form.querySelectorAll('.input-harga');
            hargaInputs.forEach(input => {
                let name = input.getAttribute('name');
                let cleanValue = input.value.replace(/\./g, '');
                formData.set(name, cleanValue);
            });

            // Kirim data di latar belakang
            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    // Munculkan popup notifikasi sukses
                    tampilkanToastSuksesAnggaran();

                    // Kembalikan tombol ke kondisi semula agar bisa diklik lagi jika ada perubahan
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                })
                .catch(error => {
                    alert('Terjadi kesalahan koneksi saat menyimpan!');
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                });
        });

        // FUNGSI BARU: Untuk memunculkan popup notifikasi
        function tampilkanToastSuksesAnggaran() {
            let existingToast = document.getElementById('toast-ajax');
            if (existingToast) existingToast.remove();

            let div = document.createElement('div');
            div.innerHTML = `
            <div id="toast-ajax" class="fixed top-5 right-5 z-[100] p-4 bg-white border-l-4 border-emerald-500 rounded-xl shadow-2xl flex items-center gap-4 transition-opacity duration-500">
                <div class="bg-emerald-100 text-emerald-600 p-2.5 rounded-full"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg></div>
                <div>
                    <p class="text-sm font-black text-gray-800">Berhasil Disimpan!</p>
                    <p class="text-xs text-gray-500 font-medium mt-0.5">Rancangan anggaran telah tersimpan.</p>
                </div>
            </div>`;
            document.body.appendChild(div.firstElementChild);

            // Hilangkan notifikasi secara otomatis setelah 3 detik
            setTimeout(() => {
                let t = document.getElementById('toast-ajax');
                if (t) {
                    t.style.opacity = '0';
                    setTimeout(() => t.remove(), 500);
                }
            }, 3000);
        }
    </script>
@endsection
