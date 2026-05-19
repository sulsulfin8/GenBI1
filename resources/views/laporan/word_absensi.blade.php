<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word'
    xmlns='http://www.w3.org/TR/REC-html40'>

<head>
    <style>
        @page {
            size: 21cm 29.7cm;
            margin: 2cm;
        }

        body {
            font-family: "Times New Roman", serif;
            font-size: 12pt;
        }

        .text-center {
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        /* Gaya Khusus Kop Surat */
        .kop-table {
            width: 100%;
            border-bottom: 3px double black;
            margin-bottom: 25px;
            border-collapse: collapse;
        }

        /* Gaya Khusus Tabel Data Absensi */
        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        table.data th,
        table.data td {
            border: 1px solid black;
            padding: 8px;
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

    <div class="text-center bold">
        <p style="font-size: 14pt; text-transform: uppercase;">LAPORAN DAFTAR HADIR ANGGOTA</p>
        <p>KEGIATAN: {{ $kegiatan->nama_kegiatan }}</p>
    </div>

    <table style="margin-top: 20px; width: 100%; border-collapse: collapse;">
        <tr>
            <td width="20%">Hari/Tanggal</td>
            <td>: {{ $kegiatan->tanggal }}</td>
        </tr>
        <tr>
            <td>Tempat</td>
            <td>: {{ $kegiatan->tempat }}</td>
        </tr>
        <tr>
            <td>Devisi Pelaksana</td>
            <td>: {{ $kegiatan->devisi }}</td>
        </tr>
    </table>

    <table class="data">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th width="5%">No</th>
                <th width="45%">Nama Anggota</th>
                <th width="20%">NIM</th>
                <th width="15%">Status</th>
                <th width="15%">Paraf</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kegiatan->absensis as $index => $abs)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $abs->nama_lengkap }}</td>
                    <td class="text-center">{{ $abs->nim ?? '-' }}</td>
                    <td class="text-center">{{ $abs->status }}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @php
        $bulan = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember',
        ];
        $tglIndo = date('d') . ' ' . $bulan[date('F')] . ' ' . date('Y');
    @endphp
    <br><br><br>
    <table style="width: 100%; margin-top: 80px; border-collapse: collapse;">
        <tr>
            <td width="60%"></td>

            <td width="40%" class="text-center">
                <p>Kolaka, {{ $tglIndo }}</p>
                <p>Sekretaris Devisi,</p>
                <br><br><br><br>
                <p class="bold">( ........................................ )</p>
            </td>
        </tr>
    </table>
</body>

</html>
