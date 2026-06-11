<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word'
    xmlns='http://www.w3.org/TR/REC-html40'>

<head>
    <meta charset="utf-8">
    <title>Laporan RAB</title>
    <style>
        /* Pengaturan Ukuran Kertas A4 & Margin Standar Laporan */
        @page {
            size: 21cm 29.7cm;
            margin: 2cm 2cm 2cm 2.5cm;
        }

        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            color: #000;
        }

        /* Kop Surat */
        table.kop-surat {
            width: 100%;
            border-bottom: 3px double black;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        /* Tipografi Judul */
        .judul-utama {
            text-align: center;
            font-weight: bold;
            font-size: 12pt;
            text-transform: uppercase;
            margin-bottom: 25px;
            line-height: 1.3;
        }

        .teks-tebal {
            font-weight: bold;
        }

        .spasi-bawah {
            margin-bottom: 10px;
        }

        /* PERBAIKAN: Indentasi Paragraf agar sejajar dengan Teks Judul, bukan Angka */
        .indent-a {
            margin-left: 0px;
        }

        .indent-1 {
            margin-left: 20px;
        }

        .indent-content {
            margin-left: 50px;
            /* Lebar ini disesuaikan agar pas di bawah teks sub-judul */
            text-align: justify;
        }

        /* Tabel RAB Profesional */
        table.tabel-rab {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        table.tabel-rab th,
        table.tabel-rab td {
            border: 1px solid black;
            padding: 6px 8px;
            vertical-align: middle;
        }

        table.tabel-rab th {
            background-color: #f2f2f2;
            text-align: center;
            font-weight: bold;
        }

        /* Helper Classes */
        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .uang {
            text-align: right;
            white-space: nowrap;
        }

        .nowrap {
            white-space: nowrap;
        }
    </style>
</head>

<body>

    <!-- ================= KOP SURAT ================= -->
    <table class="kop-surat">
        <tr>
            <td width="15%" style="text-align: center; vertical-align: middle; padding: 10px 0; border: none;">
                @if ($logoL)
                    <img src="{{ $logoL }}" width="80" style="display: block; margin: 0 auto;">
                @endif
            </td>
            <td width="70%" style="text-align: center; line-height: 1.2; padding: 10px 0; border: none;">
                <b
                    style="font-size: 16pt; text-transform: uppercase;">{{ $kop->baris1 ?? 'GENERASI BARU INDONESIA (GenBI)' }}</b><br>
                <b
                    style="font-size: 14pt; text-transform: uppercase;">{{ $kop->baris2 ?? 'PROVINSI SULAWESI TENGGARA' }}</b><br>
                <b
                    style="font-size: 14pt; text-transform: uppercase;">{{ $kop->baris3 ?? 'KOMISARIAT USN KOLAKA' }}</b><br>
                <i style="font-size: 10pt;">{{ $kop->alamat ?? '' }}</i><br>
                <i style="font-size: 10pt;">{{ $kop->kontak ?? '' }}</i>
            </td>
            <td width="15%" style="text-align: center; vertical-align: middle; padding: 10px 0; border: none;">
                @if ($logoR)
                    <img src="{{ $logoR }}" width="80" style="display: block; margin: 0 auto;">
                @endif
            </td>
        </tr>
    </table>

    <!-- ================= ISI LAPORAN (DINAMIS) ================= -->
    @foreach ($kegiatans as $kegiatan)
        <!-- Judul Rancang Program -->
        <div class="judul-utama">
            RANCANGAN PROGRAM KERJA<br>
            DEPARTEMEN {{ strtoupper($kegiatan->devisi) }}<br>
            GENBI KOMISARIAT USN KOLAKA TAHUN {{ date('Y') }}-{{ date('Y') + 1 }}
        </div>

        <!-- A. Nama Kegiatan -->
        <div class="teks-tebal spasi-bawah indent-a">
            A. &nbsp; {{ $kegiatan->nama_kegiatan }}
        </div>

        <!-- 1.1 Pengertian -->
        <div class="teks-tebal indent-1" style="margin-bottom: 5px;">
            1.1. Pengertian {{ $kegiatan->nama_kegiatan }}
        </div>
        <div class="indent-content spasi-bawah">
            {!! nl2br(e($kegiatan->pengertian ?? '-')) !!}
        </div>

        <!-- 1.2 Tujuan -->
        <div class="teks-tebal indent-1" style="margin-bottom: 5px;">
            1.2. Tujuan Kegiatan
        </div>
        <div class="indent-content spasi-bawah">
            {!! nl2br(e($kegiatan->tujuan ?? '-')) !!}
        </div>

        <!-- 1.3 Manfaat -->
        <div class="teks-tebal indent-1" style="margin-bottom: 5px;">
            1.3. Manfaat Kegiatan
        </div>
        <div class="indent-content spasi-bawah">
            {!! nl2br(e($kegiatan->manfaat ?? '-')) !!}
        </div>

        <!-- 1.4 Waktu dan Tempat -->
        <div class="teks-tebal indent-1" style="margin-bottom: 5px;">
            1.4. Waktu dan Tempat
        </div>
        <div class="indent-content spasi-bawah">
            Adapun waktu dan tempat pelaksanaan kegiatan ini adalah sebagai berikut:<br>
            Waktu &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $kegiatan->waktu ?? '-' }}<br>
            Tempat &nbsp;&nbsp;&nbsp;&nbsp;: {{ $kegiatan->tempat ?? '-' }}
        </div>

        <!-- 1.5 RAB -->
        <div class="teks-tebal indent-1" style="margin-bottom: 5px;">
            1.5. Rencana Anggaran Biaya (RAB)
        </div>
        <div class="indent-content">
            <table class="tabel-rab">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 33%;">Nama Keperluan</th>
                        <th style="width: 22%;" class="nowrap">Harga Satuan</th>
                        <th style="width: 8%;">Vol</th>
                        <th style="width: 10%;">Satuan</th>
                        <th style="width: 22%;" class="nowrap">Jumlah (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    @php $totalSeluruh = 0; @endphp
                    @forelse($kegiatan->anggarans as $index => $item)
                        @php
                            $subtotal = $item->harga_satuan * $item->jumlah;
                            $totalSeluruh += $subtotal;
                        @endphp
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td class="uang">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $item->jumlah }}</td>
                            <td class="text-center">{{ $item->satuan }}</td>
                            <td class="uang">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada rincian anggaran yang diinputkan.</td>
                        </tr>
                    @endforelse
                    <tr>
                        <td colspan="5" class="text-left teks-tebal">TOTAL KESELURUHAN</td>
                        <td class="uang teks-tebal">Rp {{ number_format($totalSeluruh, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pemisah Halaman (Jika bukan kegiatan terakhir di divisi yang sama) -->
        @if (!$loop->last)
            <div style="page-break-after: always;"></div>
        @endif
    @endforeach

    <!-- ================= TANDA TANGAN ================= -->
    <br><br>
    <table style="width: 100%; border: none; border-collapse: collapse;">
        <tr>
            <td style="width: 50%; border: none;"></td>
            <td style="width: 50%; text-align: center; vertical-align: bottom; border: none;">
                <p style="margin: 0;">Kolaka, {{ now()->format('d M Y') }}</p>
                <p style="margin: 0;">Ketua Umum,</p>

                <div style="margin-top: 10px; margin-bottom: 10px;">
                    @if ($isVerifikasi)
                        @if (!empty($adminData->ttd))
                            <!-- UKURAN TANDA TANGAN DIPERBESAR MENJADI 110 -->
                            <img src="{{ $adminData->ttd }}" height="110">
                        @else
                            <div style="height: 110px;"></div>
                        @endif
                    @else
                        <!-- UKURAN QR CODE JUGA SEDIKIT DIPERBESAR -->
                        <img src="data:image/png;base64,{{ $qrCodeBase64 }}" width="80">
                    @endif
                </div>

                <p style="margin: 0; font-weight: bold;">(
                    {{ $adminData->nama ?? '........................................' }} )</p>
            </td>
        </tr>
    </table>
</body>

</html>
