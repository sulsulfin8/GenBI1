<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word'
    xmlns='http://www.w3.org/TR/REC-html40'>

<head>
    <meta charset="utf-8">
    <title>Laporan RAB - {{ $namaDevisi }}</title>
    <style>
        @page {
            size: 21cm 29.7cm;
            margin: 2cm;
        }

        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12pt;
        }

        .text-center {
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        .uppercase {
            text-transform: uppercase;
        }

        /* Gaya Khusus Tabel RAB */
        table.tabel-rab {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
            margin-bottom: 25px;
        }

        table.tabel-rab th,
        table.tabel-rab td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }

        table.tabel-rab th {
            text-align: center;
            background-color: #f2f2f2;
        }

        /* Gaya Khusus Kop Surat yang Konsisten (Seperti Laporan Absensi) */
        table.kop-table {
            width: 100%;
            border-bottom: 3px double black;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <table class="kop-table">
        <tr>
            <td width="15%" style="text-align: center; vertical-align: middle; padding: 10px 0;">
                @if ($logoL)
                    <img src="{{ $logoL }}" width="80" style="display: block; margin: 0 auto;">
                @endif
            </td>

            <td width="70%" style="text-align: center; line-height: 1.2; padding: 10px 0;">
                <b
                    style="font-size: 16pt; text-transform: uppercase;">{{ $kop->baris1 ?? 'GENERASI BARU INDONESIA (GenBI)' }}</b><br>
                <b
                    style="font-size: 14pt; text-transform: uppercase;">{{ $kop->baris2 ?? 'PROVINSI SULAWESI TENGGARA' }}</b><br>
                <b
                    style="font-size: 14pt; text-transform: uppercase;">{{ $kop->baris3 ?? 'KOMISARIAT USN KOLAKA' }}</b><br>
                <i style="font-size: 10pt;">{{ $kop->alamat ?? '' }}</i><br>
                <i style="font-size: 10pt;">{{ $kop->kontak ?? '' }}</i>
            </td>

            <td width="15%" style="text-align: center; vertical-align: middle; padding: 10px 0;">
                @if ($logoR)
                    <img src="{{ $logoR }}" width="80" style="display: block; margin: 0 auto;">
                @endif
            </td>
        </tr>
    </table>

    @foreach ($kegiatans as $kegiatan)
        <div class="text-center bold uppercase" style="margin-top: 20px;">
            <p style="margin: 2px 0;">PROGRAM KERJA</p>
            <p style="margin: 2px 0;">DEVISI {{ $kegiatan->devisi }}</p>
            <p style="margin: 2px 0;">GENBI KOMISARIAT USN KOLAKA TAHUN 2025-2026</p>
            <p style="margin: 2px 0;">{{ $kegiatan->nama_kegiatan }}</p>
        </div>

        <br>

        <p style="text-indent: 40px; text-align: justify; margin-bottom: 15px;">
            {{ $kegiatan->nama_kegiatan }} merupakan program kerja yang berfokus pada... <i>(Tambahkan penjelasan
                program kerja di sini jika diperlukan)</i>.
        </p>

        <p class="bold uppercase" style="margin-bottom: 5px;">TUJUAN</p>
        <p style="text-align: justify; margin-top: 0; margin-bottom: 15px;">{!! nl2br(e($kegiatan->tujuan)) !!}</p>

        <p class="bold uppercase" style="margin-bottom: 5px;">MANFAAT</p>
        <p style="text-align: justify; margin-top: 0; margin-bottom: 15px;">{!! nl2br(e($kegiatan->manfaat)) !!}</p>

        <p class="bold uppercase" style="margin-bottom: 5px;">WAKTU DAN TEMPAT</p>
        <p style="margin-top: 0; margin-bottom: 15px;">{{ $kegiatan->waktu }}, {{ $kegiatan->tempat }}</p>

        <p class="bold uppercase" style="margin-bottom: 5px;">RAB</p>
        <table class="tabel-rab">
            <thead>
                <tr>
                    <th width="35%">Nama Barang</th>
                    <th width="20%">Harga Satuan</th>
                    <th width="10%">Qty</th>
                    <th width="15%">Satuan</th>
                    <th width="20%">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach ($kegiatan->anggarans as $rab)
                    <tr>
                        <td>{{ $rab->nama_barang }}</td>
                        <td>Rp. {{ number_format($rab->harga_satuan, 0, ',', '.') }}</td>
                        <td style="text-align: center;">{{ $rab->jumlah }}</td>
                        <td style="text-align: center;">{{ $rab->satuan }}</td>
                        <td>Rp. {{ number_format($rab->total, 0, ',', '.') }}</td>
                    </tr>
                    @php $total += $rab->total; @endphp
                @endforeach
                <tr>
                    <td colspan="4" style="text-align: right; font-weight: bold; padding-right: 10px;">Total
                        Keseluruhan</td>
                    <td style="font-weight: bold;">Rp. {{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        @if (!$loop->last)
            <div style="page-break-after: always;"></div>
        @endif
    @endforeach

</body>

</html>
