<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Pelanggan</th>
            <th>Total Pembelian</th>
        </tr>
    </thead>
    <tbody>

        @php
            a   
        @endphp

        @foreach ($transaksiData as $trx)

        <tr>
            <th>{{ $no++ }}</th>
            <th>{{ $trx->pelanggan }}</th>
            <td>{{ $trx->total_cost }}</td>

        </tr>
        @endforeach

    </tbody>
</table>
