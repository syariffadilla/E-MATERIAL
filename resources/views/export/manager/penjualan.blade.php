<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>No. Transaksi</th>
            <th>Nama Barang</th>
            <th>Total Harga</th>
            <th>Tanggal Transaksi</th>
            <th>Kasir</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($detail_transaksiData as $trx)

        <tr>
            <th style="text-align: center">{{ $no++ }}</th>
            <th>{{ $trx->no_transaksi }}</th>
            <th>{{ $trx->nama_barang }}</th>
            <th>{{ $trx->total_transaksi }}</th>
            <th>{{ $trx->tgl_transaksi }}</th>
            <th>{{ $trx->kasir }}</th>
        </tr>
        @endforeach

    </tbody>
</table>
