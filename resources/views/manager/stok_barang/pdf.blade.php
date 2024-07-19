<!DOCTYPE html>
<html>
<head>
    <title>Data Stok Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            text-align: center;
            margin-bottom: 20px;
        }
        header h1 {
            font-size: 24px;
            margin: 0;
        }
        header h4 {
            font-size: 18px;
            margin: 0;
            border-bottom: 3px solid black;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        header h3 {
            font-size: 24px;
            margin: 0;
        }
        header h4 {
            font-size: 24px;
            margin: 0;
        }
        .logo {
            display: block;
            margin: 0 auto;
            width: 100px;
            height: 100px;
            margin-top: 10px;
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

    <!-- kop -->

    <?php
    $date = new DateTime();
    $tanggalIndonesia = $date->format('Y-m-d');
    ?>

    <header>
        <h1>{{ $profil['nama_toko'] }}</h1>
        <h1>Telp: {{ $profil['telp'] }}</h1>
        <h4>{{ $profil['alamat'] }}</h4>
    <br> <br>
        <span>DATA STOK BARANG {{ $tanggalIndonesia  }}</span>
        <p>Kategori : {{ $kategoriFirst->nama_kategori ?? '-' }}</p>

    </header>


    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Barang</th>
                <th>Kategori Barang</th>
                <th>Stok Barang</th>
                <th>Nama Supplier</th>
                {{-- <th>Nama Pembeli</th>
                <th>Total Harga</th>
                <th>Tanggal Transaksi</th>
                <th>Kasir</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($barangs as $no => $trx)
            <tr>
                <td>{{ $no + 1 }}</td>
                <td>{{ $trx->nama_barang }}</td>
                <td>{{ $trx->kategori->nama_kategori ?? '-' }}</td>
                <td class="text-center">{{ $trx->stok ?? '0' }}</td>
                <td>{{ $trx->suplier->nama ?? '-' }}</td>

                {{-- <td>{{ $trx->pelanggan }}</td>
                <td>Rp. {{ number_format($trx->total_transaksi) }}</td>
                <td style="text-align: center;">{{ $trx->tgl_transaksi }}</td>
                <td>{{ $trx->kasir }}</td> --}}
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
