<!DOCTYPE html>
<html>

<head>
    <title>Struk</title>
    <style>
        body {
            font-family: monospace;
        }

        .container {
            width: 90mm;
            margin: auto;
            text-align: center;
        }

        .container-left {
            width: 90mm;
            margin: auto;
            text-align: left;
        }

        .header {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 12px;
        }

        .content {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .footer {
            font-size: 14px;
            margin-top: 12px;
            text-align: right;
        }

        .keterangan {
            font-size: 14px;
            margin-top: 12px;
            text-align: left;
        }
    </style>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
            font-size: 16px;
        }

        img {
            width: 40%;
            height: auto;
        }
        p{
            font-size: 16px;
        }
    </style>
</head>

<body>
    <div class="container-left">
        {{-- <div class="container">
            <img src="{{ asset('/img/SumberBangunan.png') }}" alt="Gambar" />
        </div> --}}
        <center>
            <div class="header">
                <h2>{{$profil->nama_toko}}</h2>
                <h3>No Invoice : {{ $transaksi['no_transaksi'] }}</h3>
            </div>
        </center>
        
        <div class="content">
            <p>Telp: {{$profil->telp}}</p>
            <p>{{$profil->alamat}}</p>
            <hr>
        </div>
    </div>
    <div class="container-left">
        <div class="content">
            
            <p>Tanggal : {{ date("d/M/Y", strtotime($transaksi['tgl_transaksi'])); }}</p>
        </div>
    </div>
    <div class="container">
        <div class="content">
            <table>
                <tr>
                    <td>Nama Barang</td>
                    <td>Jml</td>
                    @php
                        $allZeroDisc = true;
                        foreach ($detail as $item) {
                            if ($item['disc'] > 0) {
                                $allZeroDisc = false;
                                break;
                            }
                        }
                    @endphp
                    @if (!$allZeroDisc)
                        <td>Disc</td>
                    @endif
                    <td>Harga</td>
                </tr>
                @foreach ($detail as $item)
                    @php
                        $hargaSetelahDiskon = $item['harga_barang'] - $item['disc'];
                    @endphp
                    <tr>
                        <td>{{ $item['nama_barang'] }}</td>
                        <td>{{ $item['jumlah'] }}</td>
                        @if ($item['disc'] > 0 || !$allZeroDisc)
                            <td>{{  number_format($item['disc'], 0, ',', '.') }}</td>
                        @endif
                        <td>{{ number_format($hargaSetelahDiskon * $item['jumlah'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </table>


        </div>
        <div class="footer">
            <h4 style="font-size: 16px">Total: Rp.  {{ number_format($transaksi['total_transaksi'], 0, ',', '.') }}</h4>
            <p>Bayar: Rp.  {{ number_format($transaksi['bayar'], 0, ',', '.') }}</p>
            <p>Kembali: Rp.  {{ number_format($transaksi['kembalian'], 0, ',', '.') }}</p>
        </div>
        <div class="keterangan">
            <p>Dilayani oleh : {{ $user['name'] }} (Kasir)</p>
            <p>Catatan :</p>
            <p>{{ $transaksi['keterangan'] }}</p>
        </div>
        <i>~ Terima kasih atas kunjungan Anda ~</i>
       
       
        <br><br>
        <a href="#" onclick="return window.print();" id="printButton" class="print-button">Cetak Ulang</a>
        <a href="{{url('/kasir_transaksi')}}" id="backButton" class="print-button">Kembali</a>
    </div>

    <script>
        function beforePrint() {
            document.getElementById('printButton').style.display = 'none';
            document.getElementById('backButton').style.display = 'none';
        }

        function afterPrint() {
            document.getElementById('printButton').style.display = 'inline';
            document.getElementById('backButton').style.display = 'inline';
        }

        if (window.matchMedia) {
            var mediaQueryList = window.matchMedia('print');
            mediaQueryList.addListener(function(mql) {
                if (mql.matches) {
                    beforePrint();
                } else {
                    afterPrint();
                }
            });
        }

        function detectPrint() {
            beforePrint();
            window.print();
        }

        document.getElementById('printButton').addEventListener('click', detectPrint);
    </script>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>

</html>
