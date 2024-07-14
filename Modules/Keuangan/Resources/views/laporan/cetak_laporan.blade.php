<!DOCTYPE html>
<html>

<head>
    <title>Cetak Laporan</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        h4,
        h6 {
            text-align: center;
            padding: 0;
            margin: 0;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 0 16px;
        }

        .info-row strong {
            flex: 1;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            border: 0px;
            padding: 8px;
            text-align: right;
        }

        .table th {
            text-align: center;
            color: #000;
        }

        .text-purple {
            color: purple;
        }
    </style>
</head>

<body>
    <h4>LAPORAN REALISASI TA 2024</h4>
    <h6>Per Program; Kegiatan: Output; SubOutput; Komponen; SubKomponen; Akun; Item;</h6>
    <h6>Periode Juni 2024</h6>
    <br>

    <div class="info-row">
        <strong>Kementerian: KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</strong>
    </div>
    <div class="info-row">
        <strong>Unit Organisasi: DIREKTORAT JENDERAL PENDIDIKAN VOKASI</strong>
    </div>
    <div class="info-row">
        <strong>Satuan Kerja: POLITEKNIK NEGERI BANYUWANGI</strong>
    </div>

    <table class="table">
        <thead style="background-color: #007bff">
            <tr>
                <th rowspan="2">Uraian</th>
                <th rowspan="2">Anggaran Keuangan</th>
                <th colspan="3">Realisasi TA 2024</th>
                <th rowspan="2">%</th>
                <th rowspan="2">SISA ANGGARAN</th>
            </tr>
            <tr>
                <th>Periode Lalu</th>
                <th>Periode Ini</th>
                <th>s.d. Periode</th>
            </tr>
        </thead>
        <tbody>
            <tr style="background-color: #00f7ff;">
                <th class="text-center">Jumlah Seluruhnya</th>
                <th>cek</th>
                <th>cek</th>
                <th>cek</th>
                <th>cek</th>
                <th>cek</th>
                <th>cek</th>
            </tr>
            @foreach ($subPerencanaans as $item)
                <tr>
                    <td>{{ $item['pic'] }}</td>
                    <td>{{ $item['kode'] }}. {{ $item['kegiatan'] }}</td>
                    <td>{{ str_replace(',', '.', number_format($item['pagu'])) }}</td>
                    <td>{{ str_replace(',', '.', number_format($item['realisasi'])) }}</td>
                    <td>{{ str_replace(',', '.', number_format($item['sisa'])) }}</td>
                    <td>{{ number_format($item['persentase'], 2) }} %</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
