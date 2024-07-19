@extends('layouts.apps')
@section('contents')
    <div class="container-fluid content-inner mt-n5 py-0">
        <div class="card">
            <div class="card-header text-end">
                <button class="btn btn-success btn-md" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                        class="fas fa-search-plus"> Cari berdasarkan
                        No Transaksi</i></button>
                <button class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#exampleModalrange"><i
                        class="fas fa-calendar-alt"> Cari
                        berdasarkan range tanggal </i></button>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-7">
                                <h4 class="mb-3 card-title">Daftar Penjualan {{ $tanggal }} </h4>
                                <br>
                            </div>
                            <div class="col-lg-5">
                                <div class="mb-3">
                                    <div class="text-end">
                                        <!-- Example split danger button -->
                                        <div class="btn-group">
                                            <button class="btn btn-light btn-sm dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Export Data
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#"
                                                        onclick="return clipboard();">ClipBoard</a></li>
                                                <li><a class="dropdown-item"
                                                        href="{{ route('penjualan.export', ['awal' => $awal, 'akhir' => $akhir]) }}">Excel</a>
                                                </li>
                                                <li><a class="dropdown-item"
                                                        href="{{ route('export-generate2', ['awal' => $awal, 'akhir' => $akhir]) }}">Pdf</a>
                                                </li>

                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">

                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped" data-toggle="data-table">
                                <thead>
                                    <tr>
                                        <th>no</th>
                                        <th>No Pemakaian</th>
                                        <th>Tgl Pemakaian</th>
                                        
                                        <th class="hidden">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($transaksi as $trx)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $trx->no_transaksi }}</td>
                                            <td>{{ $trx->tgl_transaksi }}</td>
                                            <td class="hidden">
                                                <div style="float:center;">
                                                    <form action="{{ route('showPenjualanManager', ['id' => $trx->id]) }}"
                                                        method="GET">
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-sm btn-icon text-primary flex-end"
                                                            data-bs-toggle="tooltip" title="Show Penjualan">

                                                            <span class="btn-inner">
                                                                <a href="">
                                                                    <svg class="icon-20" width="20" viewBox="0 0 24 24"
                                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341"
                                                                            stroke="currentColor" stroke-width="1.5"
                                                                            stroke-linecap="round" stroke-linejoin="round">
                                                                        </path>
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z"
                                                                            stroke="currentColor" stroke-width="1.5"
                                                                            stroke-linecap="round" stroke-linejoin="round">
                                                                        </path>
                                                                        <path d="M15.1655 4.60254L19.7315 9.16854"
                                                                            stroke="currentColor" stroke-width="1.5"
                                                                            stroke-linecap="round" stroke-linejoin="round">
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
    </div>
    </div>
@endsection
@section('css')
    {{-- <style>
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
    </style> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
@section('modal')
    <!-- Modal -->
    <div class="modal fade" id="exampleModalrange" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <h5 class="mb-3">Masukkan tanggal yang ingin anda lihat</h5>
                        <form action="{{ route('penjualan_tanggal') }}" method="POST">
                            @csrf
                            <div id="reportrange"
                                style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                <i class="fa fa-calendar"></i>&nbsp;
                                <span></span> <i class="fa fa-caret-down"></i>
                            </div>
                            <div class="text-end mt-3">
                                <input type="hidden" name="awal" id="awal">
                                <input type="hidden" name="akhir" id="akhir">
                                <button type="submit" class="btn btn-primary">Cek</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('detail.penjualan', ['noTransaksi' => '__noTransaksi__']) }}" method="GET">
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
    <script>
        function clipboard() {

            const table = document.getElementById('datatable');
            navigator.clipboard.writeText(filterHiddenCells(table.outerHTML))
                .then(() => {
                    Swal.fire({
                        html: "Data berhasil disalin ke clipboard!",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                })
                .catch(err => {
                    alert('Gagal menyalin teks: ', err);
                });
        }

        // Fungsi untuk memfilter elemen <td> dengan kelas '.hidden'
        function filterHiddenCells(html) {
            var tempElement = document.createElement('div');
            tempElement.innerHTML = html;

            var hiddenCells = tempElement.querySelectorAll('th.hidden');
            hiddenCells.forEach(cell => cell.parentNode.removeChild(cell));
            var hiddenCells = tempElement.querySelectorAll('td.hidden');
            hiddenCells.forEach(cell => cell.parentNode.removeChild(cell));

            return tempElement.innerHTML;
        }

        function deleteTable(idval) {
            Swal.fire({
                html: "Reset total pembelian pelanggan?",
                icon: "info",
                buttonsStyling: false,
                showCancelButton: true,
                confirmButtonText: "Ok",
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: "btn btn-primary me-3",
                    cancelButton: 'btn btn-danger'
                }

            }).then((result) => {
                var href = "{{ route('pelangganmanager.show', 'resetpelanggan') }}?id=" + idval;
                if (result.isConfirmed) {
                    $("#overlay").fadeIn();
                    window.location.href = href;
                }
            });
        }
    </script>
    {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $(function() {
            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('#reportrange span').html(start.format('D MMMM, YYYY') + ' s/d ' + end.format('D MMMM, YYYY'));
                var awal = start.format('YYYY-MM-DD');
                var akhir = end.format('YYYY-MM-DD');
                $('#awal').val(awal);
                $('#akhir').val(akhir);
            }
            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Hari Ini': [moment(), moment()],
                    'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '7 Days Terakhir': [moment().subtract(6, 'days'), moment()],
                    '30 Days Terakhir': [moment().subtract(29, 'days'), moment()],
                    'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
                    'Bulan Lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                }
            }, cb);
            cb(start, end);
        });

        function cb(start, end) {
            $('#reportrange span').html(start.format('D MMMM, YYYY') + ' s/d ' + end.format('D MMMM, YYYY'));
            var awal = start.format('YYYY-MM-DD');
            var akhir = end.format('YYYY-MM-DD');
            $('#awal').val(awal);
            $('#akhir').val(akhir);
            // Ubah nilai input dan submit form secara otomatis
            $('form').submit();
        }
    </script>
@endsection
