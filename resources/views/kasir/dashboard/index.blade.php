@extends('layouts.apps')
@section('css')

<style>

    /* Tombol untuk perangkat dengan lebar layar lebih kecil dari 576px */
@media (max-width: 575.98px) {
    .card-header .btn {
        font-size: 12px;
        padding: 5px 10px;
    }
}

/* Tombol untuk perangkat dengan lebar layar antara 576px dan 991.98px */
@media (min-width: 576px) and (max-width: 991.98px) {
  .card-header .btn {
    font-size: 14px;
    padding: 8px 12px;
  }
}

/* Tombol untuk perangkat dengan lebar layar lebih besar dari 992px */
@media (min-width: 992px) {
    .card-header .btn {
        font-size: 16px;
        padding: 10px 15px;
    }
}
</style>
@endsection
@section('contents')
    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div class="card">
            <div class="card-header text-end">
                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Cari berdasarkan
                    No Transaksi</button>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-7">
                                <h4 class="mb-3 card-title">Daftar Penjualan {{ date('d/m/Y') }} </h4>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                    <table id="datatable" class="table table-striped" data-toggle="data-table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">No Transaksi</th>
                                <th scope="col">Pelangan</th>
                                <th scope="col">Tgl Beli</th>
                                <th scope="col">Jumlah Pembelian</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi as $trx)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $trx->no_transaksi }}</td>
                                    <td>{{ $trx->pelanggan }}</td>
                                    <td>{{ $trx->tgl_transaksi }}</td>
                                    <td>Rp. {{ number_format(floatval($trx->total_transaksi), 2, ',', '.') }}</td>

                                    <td>
                                        <div style="float:center;">
                                            <form action="{{ route('showPenjualan',['id' => $trx->id]) }}" method="GET">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-icon text-primary flex-end" data-bs-toggle="tooltip" title="Show Penjualan">

                                                <span class="btn-inner">
                                                    <a href="">
                                                    <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341"
                                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z"
                                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                        <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                        </path>
                                                    </svg>

                                                </span>
                                            </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('modal')

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('detail.penjualan.kasir', ['noTransaksi' => '__noTransaksi__']) }}" method="GET">
                        @csrf
                        <div class="text-center">
                            <h5 class="mb-3">Masukkan No Transaksi Pembelian</h5>
                            <input id="no_transaksi" name="noTransaksi" class="form-control form-control-lg"
                                type="text" aria-label=".form-control-lg example">
                        </div>
                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-primary">Cek</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
{{-- <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script> --}}
@endsection
