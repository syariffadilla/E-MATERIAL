<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
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
        <h2>Data Barang </h2>
    </div>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Barang</th>
                <th>Kategori Barang</th>
                <th>Kategori Satuan</th>
                <th>Diskon </th>
                <th>Harga Modal </th>
                <th>Harga Barang </th>
                <th>Nama Supplier </th>
                {{-- <th>Nama Pembeli</th>
                <th>Total Harga</th>
                <th>Tanggal Transaksi</th>
                <th>Kasir</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($barangs as $no => $trx)
            <tr>
                <td style="align-content: center;">{{ $no + 1 }}</td>
                <td>{{ $trx->nama_barang }}</td>
                <td>{{ $trx->kategori->nama_kategori ?? '-' }}</td>
                <td>{{ $trx->kategori_satuan }}</td>
                <td>{{ $trx->disc }}</td>
                <td>Rp. {{number_format( $trx->harga_modal, 0, ",", ".") }}</td>
                <td>Rp. {{number_format( $trx->harga_barang, 0, ",", ".") }}</td>
                <td>{{ $trx->suplier->nama ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
