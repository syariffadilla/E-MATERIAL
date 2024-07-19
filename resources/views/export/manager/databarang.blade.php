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
         
        </tr>
    </thead>
    <tbody>


        @foreach ($data['barangs'] as $trx)
    <tr>
        <th>{{ $no++ }}</th>
        <td>{{ $trx->nama_barang }}</td>
        <td>{{ $trx->kategori->nama_kategori ?? '-' }}</td>
        <td>{{ $trx->kategori_satuan }}</td>
        <td>{{ $trx->disc }}</td>
        <td>Rp. {{ number_format($trx->harga_modal, 0, ',', '.') }}</td>
        <td>Rp. {{ number_format($trx->harga_barang, 0, ',', '.') }}</td>
        <td>{{ $trx->suplier->nama ?? '-' }}</td>
    </tr>
@endforeach


    </tbody>
</table>
