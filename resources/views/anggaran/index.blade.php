@extends('layout.app')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Rancangan Anggaran</h1>
        <p class="text-gray-500 text-sm">Sesuaikan rincian program kerja dengan format resmi GenBI.</p>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">

        <div class="flex flex-col md:flex-row justify-end items-center mb-4 text-sm text-gray-600 gap-4">
            <form action="{{ route('anggaran') }}" method="GET" class="flex items-center gap-3 w-full md:w-auto">

                <div class="flex items-center gap-2">
                    <span class="hidden lg:inline text-gray-500 font-semibold">Filter Devisi:</span>
                    <select name="devisi" onchange="this.form.submit()"
                        class="border border-gray-300 rounded-lg px-3 py-1.5 focus:outline-none focus:border-primary-blue focus:ring-1 focus:ring-primary-blue bg-white font-medium text-gray-700 min-w-[150px] cursor-pointer">
                        <option value="">-- Semua Devisi --</option>
                        <option value="Pendidikan & Kebudayaan"
                            {{ request('devisi') == 'Pendidikan & Kebudayaan' ? 'selected' : '' }}>Pendidikan & Kebudayaan
                        </option>
                        <option value="Pengabdian Masyarakat"
                            {{ request('devisi') == 'Pengabdian Masyarakat' ? 'selected' : '' }}>Pengabdian Masyarakat
                        </option>
                        <option value="Publikasi Dekorasi & Dokumentasi"
                            {{ request('devisi') == 'Publikasi Dekorasi & Dokumentasi' ? 'selected' : '' }}>Publikasi
                            Dekorasi & Dokumentasi</option>
                        <option value="Kewirausahaan" {{ request('devisi') == 'Kewirausahaan' ? 'selected' : '' }}>
                            Kewirausahaan</option>
                        <option value="Lingkungan Hidup" {{ request('devisi') == 'Lingkungan Hidup' ? 'selected' : '' }}>
                            Lingkungan Hidup</option>
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

    <div id="modalAnggaran"
        class="fixed inset-0 z-50 hidden bg-gray-900/70 backdrop-blur-sm items-center justify-center p-4">
        <div
            class="bg-white rounded-2xl shadow-2xl w-full max-w-5xl max-h-[95vh] flex flex-col overflow-hidden animate-in fade-in zoom-in duration-300">
            <form action="{{ route('anggaran.store') }}" method="POST" class="flex flex-col flex-1 min-h-0">
                @csrf
                <input type="hidden" name="kegiatan_id" id="modal_kegiatan_id">

                <div class="px-6 py-4 border-b bg-gray-50 flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <div class="bg-blue-600 p-2 rounded-lg text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Form Rancangan Anggaran GenBI</h3>
                    </div>
                    <button type="button" onclick="toggleModal('modalAnggaran')"
                        class="text-gray-400 hover:text-red-500 transition">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="p-6 overflow-y-auto flex-1 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-blue-50/50 p-5 rounded-xl border border-blue-100">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-blue-700 uppercase mb-1">A. Nama Kegiatan</label>
                                <input type="text" name="nama_kegiatan" id="modal_nama"
                                    class="w-full border-gray-300 rounded-lg p-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-blue-700 uppercase mb-1">B. Tujuan
                                    Kegiatan</label>
                                <textarea name="tujuan" id="modal_tujuan" rows="2" class="w-full border-gray-300 rounded-lg p-2 text-sm"
                                    placeholder="Jelaskan tujuan kegiatan..."></textarea>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-blue-700 uppercase mb-1">C. Manfaat
                                    Kegiatan</label>
                                <textarea name="manfaat" id="modal_manfaat" rows="2" class="w-full border-gray-300 rounded-lg p-2 text-sm"
                                    placeholder="Jelaskan manfaat kegiatan..."></textarea>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs font-bold text-blue-700 uppercase mb-1">D. Waktu</label>
                                    <input type="text" name="waktu" id="modal_waktu"
                                        class="w-full border-gray-300 rounded-lg p-2 text-sm"
                                        placeholder="Contoh: Bulanan">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-blue-700 uppercase mb-1">Tempat</label>
                                    <input type="text" name="tempat" id="modal_tempat"
                                        class="w-full border-gray-300 rounded-lg p-2 text-sm" placeholder="Media Sosial">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-3">
                            <label class="block text-xs font-bold text-gray-700 uppercase">E. Rincian Anggaran Biaya
                                (RAB)</label>
                            <button type="button" onclick="addRow()"
                                class="text-xs font-bold text-blue-600 flex items-center gap-1 hover:underline">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 4v16m8-8H4"></path>
                                </svg>
                                Tambah Baris Barang
                            </button>
                        </div>
                        <div class="border rounded-xl overflow-hidden bg-white shadow-sm">
                            <table class="w-full text-sm">
                                <thead class="bg-gray-800 text-white">
                                    <tr>
                                        <th class="p-3 font-semibold">Nama Barang/Jasa</th>
                                        <th class="p-3 font-semibold w-40">Harga Satuan</th>
                                        <th class="p-3 font-semibold w-24 text-center">Jumlah (Qty)</th>
                                        <th class="p-3 font-semibold w-32">Satuan</th>
                                        <th class="p-3 font-semibold w-40">Subtotal</th>
                                        <th class="p-3 font-semibold w-12"></th>
                                    </tr>
                                </thead>
                                <tbody id="rab_body" class="divide-y">
                                </tbody>
                                <tfoot class="bg-gray-50 font-bold">
                                    <tr>
                                        <td colspan="4" class="p-3 text-right">Total Anggaran :</td>
                                        <td class="p-3 text-left text-blue-700" id="grand_total">Rp. 0</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="px-6 py-4 border-t bg-gray-50 flex justify-end gap-3">
                    <button type="button" onclick="toggleModal('modalAnggaran')"
                        class="px-6 py-2 text-gray-500 font-semibold">Batal</button>
                    <button type="submit"
                        class="bg-green-600 text-white px-8 py-2 rounded-xl font-bold shadow-lg hover:bg-green-700 transition flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                            </path>
                        </svg>
                        Simpan & Update Anggaran
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let rowIdx = 0;

        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('modalAnggaran');
            const form = modal.querySelector('form');
            if (form) {
                form.addEventListener('submit', function() {
                    const hargaInputs = document.querySelectorAll('input[id^="harga_"]');
                    hargaInputs.forEach(input => {
                        input.value = input.value.replace(/\./g, ''); // Hapus titik
                    });
                });
            }
        });

        function formatRibuan(input) {
            let value = input.value.replace(/[^0-9]/g, ''); // Hapus semua selain angka
            if (value !== '') {
                input.value = new Intl.NumberFormat('id-ID').format(value);
            } else {
                input.value = '';
            }
        }

        function openModalAnggaran(kegiatan) {
            document.getElementById('modal_kegiatan_id').value = kegiatan.id;
            document.getElementById('modal_nama').value = kegiatan.nama_kegiatan;
            document.getElementById('modal_tujuan').value = kegiatan.tujuan || '';
            document.getElementById('modal_manfaat').value = kegiatan.manfaat || '';
            document.getElementById('modal_waktu').value = kegiatan.waktu || '';
            document.getElementById('modal_tempat').value = kegiatan.tempat || '';

            document.getElementById('rab_body').innerHTML = "";

            if (kegiatan.anggarans && kegiatan.anggarans.length > 0) {
                kegiatan.anggarans.forEach(ang => addRow(ang));
            } else {
                addRow();
            }

            toggleModal('modalAnggaran');
        }

        function addRow(data = null) {
            let hargaAwal = data ? new Intl.NumberFormat('id-ID').format(data.harga_satuan) : '';

            const html = `
            <tr id="row_${rowIdx}" class="hover:bg-gray-50">
                <td class="p-2">
                    <input type="text" name="items[${rowIdx}][nama]" value="${data ? data.nama_barang : ''}" class="w-full border-gray-200 rounded p-2 text-sm" placeholder="Nama barang..." required>
                </td>
                <td class="p-2">
                    <div class="flex items-center bg-white border border-gray-200 rounded overflow-hidden focus-within:ring-1 focus-within:ring-blue-500 focus-within:border-blue-500">
                        <span class="pl-2 pr-1 text-sm text-gray-500 font-medium">Rp.</span>
                        <input type="text" name="items[${rowIdx}][harga]" value="${hargaAwal}" oninput="formatRibuan(this); calc(${rowIdx})" id="harga_${rowIdx}" class="w-full border-none p-2 pl-0 text-sm outline-none focus:ring-0 bg-transparent text-left" placeholder="0" required>
                    </div>
                </td>
                <td class="p-2">
                    <input type="number" name="items[${rowIdx}][qty]" value="${data ? data.jumlah : ''}" oninput="calc(${rowIdx})" id="qty_${rowIdx}" class="w-full border-gray-200 rounded p-2 text-sm text-center" placeholder="1" required>
                </td>
                <td class="p-2">
                    <input type="text" name="items[${rowIdx}][satuan]" value="${data ? data.satuan : ''}" class="w-full border-gray-200 rounded p-2 text-sm" placeholder="Cth: Pcs, Tahun" required>
                </td>
                <td class="p-2">
                    <input type="text" id="total_${rowIdx}" class="w-full bg-gray-50 border-none rounded p-2 text-sm font-semibold text-gray-800" readonly value="${data ? 'Rp. ' + new Intl.NumberFormat('id-ID').format(data.total) : 'Rp. 0'}">
                </td>
                <td class="p-2 text-center">
                    <button type="button" onclick="removeRow(${rowIdx})" class="text-red-400 hover:text-red-600 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </td>
            </tr>
        `;
            document.getElementById('rab_body').insertAdjacentHTML('beforeend', html);
            rowIdx++;
            updateGrandTotal();
        }

        function calc(idx) {
            let hargaStr = document.getElementById(`harga_${idx}`).value.replace(/\./g, '');
            const h = parseFloat(hargaStr) || 0;
            const q = parseFloat(document.getElementById(`qty_${idx}`).value) || 0;

            const total = h * q;
            document.getElementById(`total_${idx}`).value = 'Rp. ' + new Intl.NumberFormat('id-ID').format(total);
            updateGrandTotal();
        }

        function updateGrandTotal() {
            let grand = 0;
            const rows = document.getElementById('rab_body').querySelectorAll('tr');
            rows.forEach(row => {
                const idx = row.id.split('_')[1];
                let hargaStr = document.getElementById(`harga_${idx}`).value.replace(/\./g, '');
                const h = parseFloat(hargaStr) || 0;
                const q = parseFloat(document.getElementById(`qty_${idx}`).value) || 0;
                grand += (h * q);
            });
            document.getElementById('grand_total').innerText = 'Rp. ' + new Intl.NumberFormat('id-ID').format(grand);
        }

        function removeRow(idx) {
            document.getElementById(`row_${idx}`).remove();
            updateGrandTotal();
        }

        function toggleModal(id) {
            const m = document.getElementById(id);
            m.classList.toggle('hidden');
            m.classList.toggle('flex');
        }
    </script>
@endsection
