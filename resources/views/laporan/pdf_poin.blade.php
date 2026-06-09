<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Poin Keaktifan</title>
    <style>
        /* Format Margin Normal (2cm di semua sisi) dengan kertas Letter Berdiri */
        @page {
            size: letter landscape;
            margin: 2cm;
        }

        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 11pt;
        }

        .text-center {
            text-align: center;
        }

        .kop-table {
            width: 100%;
            border-bottom: 3px double black;
            margin-bottom: 20px;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table.data th,
        table.data td {
            border: 1px solid black;
            padding: 6px;
            text-align: center;
            vertical-align: top;
        }

        table.data th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .sp-aman {
            color: green;
            font-weight: bold;
        }

        .sp-warning {
            color: orange;
            font-weight: bold;
        }

        .sp-danger {
            color: red;
            font-weight: bold;
        }

        .keterangan-teks {
            text-align: left;
            font-size: 10pt;
        }
    </style>
</head>

<body>

    <table class="kop-table"
        style="width: 100%; border-bottom: 3px double black; margin-bottom: 20px; border-collapse: collapse;">
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

    <div class="text-center">
        <p style="font-size: 14pt; font-weight: bold; text-transform: uppercase;">REKAPITULASI POIN KEAKTIFAN DAN SURAT
            PERINGATAN (SP)</p>
        <p style="font-size: 11pt;">GenBI Komisariat USN Kolaka Periode Kepengurusan Berjalan</p>
    </div>

    <table class="data">
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="12%">NIM</th>
                <th width="18%">Nama Lengkap</th>
                <th width="9%">Poin Absen</th>
                <th width="9%">Poin Manual</th>
                <th width="9%">Total Poin</th>
                <th width="9%">Status SP</th>
                <th width="30%">Keterangan Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rekapData as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data->nim ?? '-' }}</td>
                    <td style="text-align: left;">{{ $data->nama }}</td>
                    <td>+{{ $data->poin_absensi }}</td>
                    <td>{{ $data->poin_manual > 0 ? '+' . $data->poin_manual : $data->poin_manual }}</td>
                    <td style="font-weight: bold; font-size: 12pt;">{{ $data->total_poin }}</td>
                    <td
                        class="
                    {{ $data->sp == 'Aman' ? 'sp-aman' : '' }}
                    {{ $data->sp == 'SP 1' || $data->sp == 'SP 2' ? 'sp-warning' : '' }}
                    {{ $data->sp == 'SP 3' ? 'sp-danger' : '' }}
                ">
                        {{ $data->sp }}</td>

                    <td class="keterangan-teks">{{ $data->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
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

                <p style="margin: 0; font-weight: bold;">( {{ $adminData->nama }} )</p>
            </td>
        </tr>
    </table>
</body>

</html>
