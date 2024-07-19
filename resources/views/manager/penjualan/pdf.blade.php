<!DOCTYPE html>
<html>
<head>
    <title>Data Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 24px;
            margin: 0;
        }
        .header h1 {
            font-size: 18px;
            margin: 0;
            border-bottom: 3px solid black;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        .header2 {
            text-align: left;
            margin-bottom: 20px;
        }
        .header img {
            display: block;
            margin: 0 auto;
            width: 100px;
            height: 100px;
            margin-top: 10px;
        }
        .header2 h2 {
            font-size: 24px;
            margin: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header2">
        <h2>Data Penjualan </h2>
    </div>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>No. Transaksi</th>
                <th>Nama Pembeli</th>
                <th>Total Harga</th>
                <th>Tanggal Transaksi</th>
                <th>Kasir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $no => $trx)
            <tr>
                <td>{{ $no + 1 }}</td>
                <td>{{ $trx->no_transaksi }}</td>
                <td>{{ $trx->pelanggan }}</td>
                <td>Rp. {{ number_format($trx->total_transaksi) }}</td>
                <td style="text-align: center;">{{ $trx->tgl_transaksi }}</td>
                <td>{{ $trx->kasir }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
