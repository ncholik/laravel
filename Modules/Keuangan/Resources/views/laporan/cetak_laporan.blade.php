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
                <th>PIC</th>
                <th>Uraian</th>
                <th>Anggaran Keuangan</th>
                <th>Realisasi TA 2024</th>
                <th>%</th>
                <th>SISA ANGGARAN</th>
            </tr>
        </thead>
        <tbody>
            <tr style="background-color: #00f7ff;">
                <th colspan="2" class="text-center">Jumlah Seluruhnya</th>
                <th style="text-align: right">{{ str_replace(',', '.', number_format($totals['totalPagu'])) }}</th>
                <th style="text-align: right">{{ str_replace(',', '.', number_format($totals['totalRealisasi'])) }}</th>
                <th style="text-align: right">{{ number_format($totals['totalPersentase'], 2) }} %</th>
                <th style="text-align: right">{{ str_replace(',', '.', number_format($totals['totalSisa'])) }}</th>
            </tr>
            @foreach ($subPerencanaans as $item)
                <tr>
                    <td>{{ $item['pic'] }}</td>
                    <td>{{ $item['kode'] }}. {{ $item['kegiatan'] }}</td>
                    <td>{{ str_replace(',', '.', number_format($item['pagu'])) }}</td>
                    <td>{{ str_replace(',', '.', number_format($item['realisasi'])) }}</td>
                    <td>{{ number_format($item['persentase'], 2) }}%</td>
                    <td>{{ str_replace(',', '.', number_format($item['sisa'])) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
