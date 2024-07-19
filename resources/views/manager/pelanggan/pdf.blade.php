<!DOCTYPE html>
<html>
<head>
    <title>Data Pelanggan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <h1>Data Pelanggan</h1>

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama Pelanggan</th>
            <th>Total Pembelian</th>
            <th>Total Poin</th>
            <th>Pembelian Terakhir</th>
        </tr>
        @foreach ($pelanggan as $no => $item)
        @php
            $date = date_create($item->updated_at);
        @endphp
        <tr>
            <td class="text-center">{{ $no + 1 }}</td>
            <td>{{ $item->pelanggan }}</td>
            <td>Rp {{ number_format($item->total_cost) }}</td>
            <td>{{ floatval($item->total_cost / 100000) }}</td>
            <td>{{ date_format($date, 'd/M/Y') }}</td>
        </tr>
        @endforeach
    </table>

</body>
</html>
