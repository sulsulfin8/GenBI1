@extends('layout.app')

@section('content')
    <div class="mb-8 animate-fade-in-down">
        <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">Kelola Pengguna</h1>
        <p class="text-gray-500 text-sm mt-1">Manajemen akun dan hak akses pengguna SIM GenBI.</p>
    </div>

    @php
        // PERBAIKAN: Ambil langsung dari seluruh database agar notifikasi tetap muncul
        // meskipun sedang mencari nama orang lain atau berada di halaman (pagination) lain.
        $mintaResetUsers = \App\Models\User::where('request_reset', true)->get();
        $totalMintaReset = $mintaResetUsers->count();
    @endphp

    @if ($totalMintaReset > 0)
        <div
            class="mb-6 p-4 bg-gradient-to-r from-red-500 to-rose-600 text-white rounded-2xl shadow-lg shadow-red-500/20 flex items-center justify-between gap-4 animate-fade-in-down relative z-20">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-white/20 rounded-xl backdrop-blur-sm animate-bounce flex-shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="font-black text-[10px] uppercase tracking-widest text-red-100">Pemberitahuan Mendesak</p>
                    <p class="text-sm font-bold text-white/95 mt-0.5">
                        Ada <span class="underline decoration-white font-black">{{ $totalMintaReset }} Anggota</span> yang
                        meminta reset kata sandi, yaitu:
                        <span
                            class="text-yellow-300 font-black bg-black/20 px-2 py-0.5 rounded-lg inline-block my-0.5 shadow-sm border border-white/10">
                            {{ $mintaResetUsers->pluck('name')->implode(', ') }}
                        </span>.
                        Harap segera buatkan kata sandi baru.
                    </p>
                </div>
            </div>
        </div>
    @endif

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
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 text-sm text-gray-600 gap-4">
            <form action="{{ route('users.index') }}" method="GET" class="flex items-center gap-2">
                @if (request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif
                <span class="font-medium">Tampilkan</span>
                <select name="per_page" onchange="this.form.submit()"
                    class="border border-gray-200 rounded-lg px-3 py-1.5 focus:outline-none focus:border-primary-blue focus:ring-2 focus:ring-primary-blue/20 bg-gray-50 hover:bg-white transition font-bold text-gray-700 cursor-pointer">
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                </select>
                <span class="font-medium">entri</span>
            </form>

            <div class="flex flex-col md:flex-row items-center gap-3 w-full md:w-auto">
                <form action="{{ route('users.index') }}" method="GET" class="relative w-full md:w-64" id="searchForm">
                    @if (request('per_page'))
                        <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                    @endif
                    <input type="text" name="search" id="searchInput" value="{{ request('search') }}"
                        placeholder="Nama, NIM, atau Jurusan..." oninput="handleSearch(this)"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 pl-10 focus:outline-none focus:border-primary-blue focus:ring-2 focus:ring-primary-blue/20 text-sm bg-gray-50 focus:bg-white transition-all">
                    <button type="submit"
                        class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-primary-blue transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </form>

                <button onclick="toggleModal('modalTambahUser')"
                    class="w-full md:w-auto bg-gradient-to-r from-blue-600 to-primary-blue hover:from-blue-700 hover:to-blue-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-all shadow-md shadow-blue-500/30 flex items-center justify-center gap-2 hover:-translate-y-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Pengguna
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
                        <th class="py-4 px-5 font-black text-[11px] text-gray-500 uppercase tracking-widest">Informasi
                            Pengguna</th>
                        <th class="py-4 px-5 font-black text-[11px] text-gray-500 uppercase tracking-widest">Devisi &
                            Jurusan</th>
                        <th class="py-4 px-5 font-black text-[11px] text-gray-500 uppercase tracking-widest">Hak Akses</th>
                        <th class="py-4 px-5 font-black text-[11px] text-gray-500 uppercase tracking-widest">Status Akun
                        </th>
                        <th class="py-4 px-5 font-black text-[11px] text-gray-500 uppercase tracking-widest text-center">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-100">
                    @forelse($users as $key => $user)
                        <tr class="hover:bg-blue-50/40 transition-colors duration-200 group">
                            <td class="py-4 px-5 text-center text-gray-400 font-bold">
                                {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
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
                                            {{ $user->nim ?? 'NIM tidak tersedia' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-5">
                                <p class="font-bold text-gray-700 text-sm">{{ $user->devisi ?? 'Belum ada devisi' }}</p>
                                <p class="text-xs text-gray-500 mt-0.5">{{ $user->jurusan ?? '-' }}</p>
                            </td>
                            <td class="py-4 px-5">
                                <span
                                    class="px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest inline-flex items-center gap-1.5
                                    {{ $user->role == 'admin' ? 'bg-purple-100 text-purple-700' : '' }}
                                    {{ $user->role == 'sekretaris' ? 'bg-amber-100 text-amber-700' : '' }}
                                    {{ $user->role == 'bendahara' ? 'bg-emerald-100 text-emerald-700' : '' }}
                                    {{ $user->role == 'anggota' ? 'bg-gray-100 text-gray-600' : '' }}">
                                    @if ($user->role == 'admin')
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                            </path>
                                        </svg>
                                    @elseif($user->role == 'sekretaris')
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    @elseif($user->role == 'bendahara')
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08-.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                            </path>
                                        </svg>
                                    @else
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                    @endif
                                    {{ $user->role }}
                                </span>
                            </td>

                            <td class="py-4 px-5">
                                @if ($user->request_reset)
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-black bg-red-50 text-red-600 border border-red-100 animate-pulse shadow-sm">
                                        <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                        ⚠️ Minta Reset
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold bg-emerald-50 text-emerald-600 border border-emerald-100 shadow-sm">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                        Aktif
                                    </span>
                                @endif
                            </td>

                            <td class="py-4 px-5 text-center">
                                <div class="flex justify-center items-center gap-2">
                                    <button onclick="toggleModal('modalEditUser{{ $user->id }}')" title="Edit Data"
                                        class="p-2 text-blue-600 bg-blue-50 hover:bg-blue-600 hover:text-white rounded-lg transition-all shadow-sm">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="2">
                                            <path
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                        onsubmit="return confirm('Peringatan: Menghapus user ini mungkin akan memengaruhi data absensi atau kegiatan yang terkait dengannya. Yakin ingin melanjutkan?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" title="Hapus User"
                                            class="p-2 text-red-500 bg-red-50 hover:bg-red-500 hover:text-white rounded-lg transition-all shadow-sm">
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
                            <td colspan="6" class="py-16 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <div class="bg-gray-50 p-4 rounded-full mb-3">
                                        <svg class="w-10 h-10 opacity-40 text-gray-500" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                            </path>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-bold text-gray-600">
                                        @if (request('search'))
                                            Data tidak ditemukan untuk pencarian "{{ request('search') }}"
                                        @else
                                            Belum ada pengguna terdaftar.
                                        @endif
                                    </p>
                                    @if (!request('search'))
                                        <p class="text-xs mt-1">Silakan klik "Tambah Pengguna" untuk menambahkan anggota
                                            baru.</p>
                                    @else
                                        <a href="{{ route('users.index') }}"
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
                {{ $users->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    <div id="modalTambahUser"
        class="fixed inset-0 z-50 hidden bg-gray-900/70 backdrop-blur-sm items-center justify-center p-4 transition-all">
        <div
            class="bg-white rounded-3xl shadow-2xl w-full max-w-md flex flex-col overflow-hidden animate-modal max-h-[90vh]">
            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h3 class="text-lg font-extrabold text-gray-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    Tambah Pengguna
                </h3>
                <button onclick="toggleModal('modalTambahUser')"
                    class="text-gray-400 hover:text-red-500 hover:bg-red-50 p-2 rounded-xl transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <form action="{{ route('users.store') }}" method="POST" class="p-6 space-y-4 overflow-y-auto">
                @csrf
                <div>
                    <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-1.5">Nama
                        Lengkap</label>
                    <input type="text" name="name" placeholder="Contoh: Budi Santoso" required
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary-blue focus:border-primary-blue transition-all bg-gray-50 focus:bg-white font-medium text-gray-800">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-1.5">NIM</label>
                        <input type="text" name="nim" placeholder="Contoh: 22123..."
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary-blue focus:border-primary-blue transition-all bg-gray-50 focus:bg-white font-medium text-gray-800">
                    </div>
                    <div>
                        <label
                            class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-1.5">Jurusan</label>
                        <input type="text" name="jurusan" placeholder="Contoh: Sistem Informasi"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary-blue focus:border-primary-blue transition-all bg-gray-50 focus:bg-white font-medium text-gray-800">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-1.5">Email /
                        Username</label>
                    <input type="text" name="email" placeholder="Contoh: budisantoso123" required
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary-blue focus:border-primary-blue transition-all bg-gray-50 focus:bg-white font-medium text-gray-800">
                </div>
                <div>
                    <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-1.5">Password</label>
                    <input type="password" name="password" placeholder="Minimal 6 karakter" required
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary-blue focus:border-primary-blue transition-all bg-gray-50 focus:bg-white font-medium text-gray-800">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label
                            class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-1.5">Devisi</label>
                        <select name="devisi"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary-blue focus:border-primary-blue transition-all bg-gray-50 focus:bg-white font-medium text-gray-800 cursor-pointer">
                            <option value="">-- Pilih Devisi --</option>
                            <option value="Pendidikan & Kebudayaan">Pendidikan</option>
                            <option value="Pengabdian Masyarakat">Pengabdian</option>
                            <option value="Publikasi Dekorasi & Dokumentasi">Pubdok</option>
                            <option value="Kewirausahaan">Kewirausahaan</option>
                            <option value="Lingkungan Hidup">Lingkungan</option>
                        </select>
                    </div>
                    <div class="mt-0">
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Jabatan Struktur</label>
                        <select name="jabatan"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm cursor-pointer focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                            <option value="">-- Anggota Biasa --</option>
                            <option value="Ketua Devisi Pendidikan & Kebudayaan">Ketua Devisi Pendidikan</option>
                            <option value="Ketua Devisi Pengabdian Masyarakat">Ketua Devisi Pengmas</option>
                            <option value="Ketua Devisi Pubdok">Ketua Devisi Pubdok</option>
                            <option value="Ketua Devisi Kewirausahaan">Ketua Devisi Wirausaha</option>
                            <option value="Ketua Devisi Lingkungan Hidup">Ketua Devisi Lingkungan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-1.5">Hak Akses
                            (Role)</label>
                        <select name="role" required
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary-blue focus:border-primary-blue transition-all bg-gray-50 focus:bg-white font-bold text-primary-blue cursor-pointer">
                            <option value="anggota">Anggota</option>
                            <option value="sekretaris">Sekretaris</option>
                            <option value="bendahara">Bendahara</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-4 mt-2 border-t border-gray-100">
                    <button type="button" onclick="toggleModal('modalTambahUser')"
                        class="px-5 py-3 text-gray-500 font-bold bg-gray-100 hover:bg-gray-200 rounded-xl text-sm transition">Batal</button>
                    <button type="submit"
                        class="bg-gradient-to-r from-blue-600 to-primary-blue hover:from-blue-700 hover:to-blue-600 text-white px-8 py-3 rounded-xl text-sm font-bold shadow-md shadow-blue-500/30 transition hover:-translate-y-0.5">Simpan
                        Data</button>
                </div>
            </form>
        </div>
    </div>

    @foreach ($users as $user)
        <div id="modalEditUser{{ $user->id }}"
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
                        Edit Pengguna
                    </h3>
                    <button onclick="toggleModal('modalEditUser{{ $user->id }}')"
                        class="text-gray-400 hover:text-red-500 hover:bg-red-50 p-2 rounded-xl transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form action="{{ route('users.update', $user->id) }}" method="POST"
                    class="p-6 space-y-4 overflow-y-auto">
                    @csrf @method('PUT')
                    <div>
                        <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-1.5">Nama
                            Lengkap</label>
                        <input type="text" name="name" value="{{ $user->name }}" required
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all bg-gray-50 focus:bg-white font-medium text-gray-800">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label
                                class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-1.5">NIM</label>
                            <input type="text" name="nim" value="{{ $user->nim }}"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all bg-gray-50 focus:bg-white font-medium text-gray-800">
                        </div>
                        <div>
                            <label
                                class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-1.5">Jurusan</label>
                            <input type="text" name="jurusan" value="{{ $user->jurusan }}"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all bg-gray-50 focus:bg-white font-medium text-gray-800">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-1.5">Email /
                            Username</label>
                        <input type="text" name="email" value="{{ $user->email }}" required
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all bg-gray-50 focus:bg-white font-medium text-gray-800">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-1.5">Ganti
                            Password</label>
                        <input type="password" name="password" placeholder="Masukkan sandi baru untuk mereset"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all bg-gray-50 focus:bg-white font-medium text-gray-800 placeholder-gray-400">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label
                                class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-1.5">Devisi</label>
                            <select name="devisi"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all bg-gray-50 focus:bg-white font-medium text-gray-800 cursor-pointer">
                                <option value="">-- Pilih Devisi --</option>
                                <option value="Pendidikan & Kebudayaan"
                                    {{ $user->devisi == 'Pendidikan & Kebudayaan' ? 'selected' : '' }}>Pendidikan</option>
                                <option value="Pengabdian Masyarakat"
                                    {{ $user->devisi == 'Pengabdian Masyarakat' ? 'selected' : '' }}>Pengabdian</option>
                                <option value="Publikasi Dekorasi & Dokumentasi"
                                    {{ $user->devisi == 'Publikasi Dekorasi & Dokumentasi' ? 'selected' : '' }}>Pubdok
                                </option>
                                <option value="Kewirausahaan" {{ $user->devisi == 'Kewirausahaan' ? 'selected' : '' }}>
                                    Kewirausahaan</option>
                                <option value="Lingkungan Hidup"
                                    {{ $user->devisi == 'Lingkungan Hidup' ? 'selected' : '' }}>Lingkungan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-1.5">Hak
                                Akses</label>
                            <select name="role" required
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all bg-gray-50 focus:bg-white font-bold text-emerald-600 cursor-pointer">
                                <option value="anggota" {{ $user->role == 'anggota' ? 'selected' : '' }}>Anggota</option>
                                <option value="sekretaris" {{ $user->role == 'sekretaris' ? 'selected' : '' }}>Sekretaris
                                </option>
                                <option value="bendahara" {{ $user->role == 'bendahara' ? 'selected' : '' }}>Bendahara
                                </option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-0">
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Jabatan Struktur</label>
                        <select name="jabatan"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm cursor-pointer focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                            <option value="" {{ empty($user->jabatan) ? 'selected' : '' }}>-- Anggota Biasa --
                            </option>
                            <option value="Ketua Devisi Pendidikan & Kebudayaan"
                                {{ $user->jabatan == 'Ketua Devisi Pendidikan & Kebudayaan' ? 'selected' : '' }}>Ketua
                                Devisi Pendidikan</option>
                            <option value="Ketua Devisi Pengabdian Masyarakat"
                                {{ $user->jabatan == 'Ketua Devisi Pengabdian Masyarakat' ? 'selected' : '' }}>Ketua Devisi
                                Pengmas</option>
                            <option value="Ketua Devisi Pubdok"
                                {{ $user->jabatan == 'Ketua Devisi Pubdok' ? 'selected' : '' }}>Ketua Devisi Pubdok
                            </option>
                            <option value="Ketua Devisi Kewirausahaan"
                                {{ $user->jabatan == 'Ketua Devisi Kewirausahaan' ? 'selected' : '' }}>Ketua Devisi
                                Wirausaha</option>
                            <option value="Ketua Devisi Lingkungan Hidup"
                                {{ $user->jabatan == 'Ketua Devisi Lingkungan Hidup' ? 'selected' : '' }}>Ketua Devisi
                                Lingkungan</option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 mt-2 border-t border-gray-100">
                        <button type="button" onclick="toggleModal('modalEditUser{{ $user->id }}')"
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
