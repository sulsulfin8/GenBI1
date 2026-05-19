@extends('layout.app')

@section('content')
    <div class="mb-6 animate-fade-in-down">
        <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">Profil Saya</h1>
        <p class="text-gray-500 text-sm mt-1">Kelola informasi data diri dan kredensial akun Anda.</p>
    </div>

    @if (session('success'))
        <div
            class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl text-sm font-bold flex items-center gap-3 shadow-sm animate-fade-in-down">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-3xl p-8 shadow-soft border border-gray-50 relative z-20">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="flex flex-col md:flex-row gap-8">
                <!-- Kolom Kiri: Foto Profil -->
                <div class="w-full md:w-1/3 flex flex-col items-center space-y-4">
                    <div
                        class="relative w-40 h-40 rounded-full border-4 border-gray-100 overflow-hidden shadow-lg group bg-gray-50">
                        @if (auth()->user()->photo)
                            <!-- PERBAIKAN: Menambahkan 'object-top' agar fokus potongan ada di kepala -->
                            <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="Foto Profil"
                                class="w-full h-full object-cover object-top">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=ffedd5&color=ea580c"
                                alt="Default Avatar" class="w-full h-full object-cover">
                        @endif

                        <!-- Overlay saat hover -->
                        <div class="absolute inset-0 bg-black/50 hidden group-hover:flex items-center justify-center transition-all cursor-pointer"
                            onclick="document.getElementById('photoInput').click()">
                            <span class="text-white text-xs font-bold uppercase tracking-wider">Ubah Foto</span>
                        </div>
                    </div>
                    <input type="file" name="photo" id="photoInput" class="hidden"
                        accept="image/png, image/jpeg, image/jpg">
                    <p class="text-xs text-gray-400 text-center">Format: JPG, JPEG, PNG.<br>Maksimal ukuran 5MB.</p>
                </div>
                <!-- Kolom Kanan: Data Diri -->
                <div class="w-full md:w-2/3 space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ auth()->user()->name }}" required
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary-blue transition-all bg-gray-50 focus:bg-white">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Email / Username</label>
                            <input type="email" name="email" value="{{ auth()->user()->email }}" required
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary-blue transition-all bg-gray-50 focus:bg-white">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">NIM</label>
                            <input type="text" name="nim" value="{{ auth()->user()->nim }}"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary-blue transition-all bg-gray-50 focus:bg-white">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Jurusan</label>
                            <input type="text" name="jurusan" value="{{ auth()->user()->jurusan }}"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary-blue transition-all bg-gray-50 focus:bg-white">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Ganti Password
                            (Opsional)</label>
                        <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary-blue transition-all bg-gray-50 focus:bg-white">
                    </div>

                    <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
                        <!-- Tombol Kembali -->
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-gray-600 px-8 py-3 rounded-xl text-sm font-bold transition-all duration-300 transform hover:-translate-y-0.5">
                            Kembali
                        </a>

                        <!-- Tombol Simpan Perubahan -->
                        <button type="submit"
                            class="bg-gradient-to-r from-blue-600 to-primary-blue hover:from-blue-700 hover:to-blue-600 text-white px-8 py-3 rounded-xl text-sm font-bold shadow-md shadow-blue-500/30 transition-all duration-300 transform hover:-translate-y-0.5">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Script sederhana untuk preview foto setelah dipilih sebelum diupload
        document.getElementById('photoInput').onchange = function(evt) {
            var tgt = evt.target || window.event.srcElement,
                files = tgt.files;
            if (FileReader && files && files.length) {
                var fr = new FileReader();
                fr.onload = function() {
                    document.querySelector('.group img').src = fr.result;
                }
                fr.readAsDataURL(files[0]);
            }
        }
    </script>
@endsection
