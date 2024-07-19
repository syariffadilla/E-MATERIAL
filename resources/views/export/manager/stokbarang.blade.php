<table>
    <thead>
        <tr>
            <th>No.</th>
                <th>Nama Barang</th>
               
                <th>Stok Barang</th>
               
                <th>Nama Supplier </th>
        </tr>
    </thead>
    <tbody>


        @foreach ($data['barangs'] as $trx)
        <tr>
            <th>{{ ++$no }}</th>
            <td>{{ $trx->nama_barang }}</td>
        
            <td>{{ $trx->stok }}</td>
          
            <td>{{ $trx->suplier->nama ?? '-' }}</td>
        </tr>
    @endforeach



    </tbody>
</table>
