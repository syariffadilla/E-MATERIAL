@extends('layouts.apps')

@section('css')
    <style>
        #tabel-barang {
            display: none;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('contents')
    <?php
    $date = new DateTime();
    $tanggalIndonesia = $date->format('Y-m-d');
    ?>
    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-lg-12">
                <div class="card   rounded">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="mb-2" id="invoice">Invoice # {{ $transaksi->no_transaksi }} </h4>
                                Tanggal Pembelian: {{ $transaksi->tgl_transaksi }}
                            </div>
                       

                        </div>

                        <div class="row">
                            <div class="col-sm-12 mt-4">
                                <div class="table-responsive-lg">
                                    <table class="table" id="tabel-barang-utama">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nama Barang</th>
                                                <th class="text-center" scope="col">Stok</th>
                                                <th class="text-center" scope="col">Jumlah</th>
                                                <th class="text-center" scope="col">Stok Akhir</th>
                                                <!-- <th class="text-center" scope="col">Totals</th> -->

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($detail as $detail)
                                            <tr>
                                                <td>
                                                    <h6 class="mb-0 ">{{ $detail->nama_barang }}</h6>
                                                </td>
                                                <td class="text-center" id="harga_barang_cart" name="harga_barang_cart">
                                                    {{ $detail->stok_barang }}
                                                </td>
                                                <td class="text-center" id="jumlah_cart" name="jumlah_cart">
                                                    {{ $detail->jumlah_barang }} 
                                                </td>
                                                <td class="text-center">
                                                    {{ $detail->sisaStok }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td>
                                                </td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                            </tr>

                                        </tfoot>
                                    </table>

                           

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="mb-0 mt-4">
                                        <li id="kasir">Dilayani Oleh Kasir :
                                            {{ $transaksi->kasir }}</li>

                                    </p>
                                    <div class="d-flex justify-content-center mt-4 float-end">
                                        <a href="{{ route('penjualan_manager') }}"> <button type="button" class="btn btn-primary me-2"><i class="fas fa-arrow-circle-left"> Kembali</i></button></a>
                                  
                                    <div class="d-flex justify-content-center mt-4">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

{{-- @php
    var_dump($transaksi->no_transaksi);
@endphp --}}

    @endsection

    @section('css')
        <style>
            .suggestions {
                max-height: 150px;
                overflow-y: auto;
                border: 1px solid #ccc;
                background-color: #fff;
                padding: 5px;
                position: absolute;
                z-index: 9999;
            }
        </style>
    @endsection



