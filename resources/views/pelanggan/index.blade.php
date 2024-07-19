@extends('layouts.apps')
@section('contents')
    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div class="card">
            <div class="card-header">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4> Data Pelanggan
                            </h4>
                        </div>
                        @if ($user->role_is == 1)
                        <div class="col-lg-6">
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
                                        <li><a class="dropdown-item" href="{{ route('export') }}">Excel</a></li>
                                        <li><a class="dropdown-item" href="{{ route('export-generate') }}">Pdf</a></li>
                                        <li><a class="dropdown-item" href="{{ route('pelanggan.export.csv') }}">Csv</a></li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                        @endif
                    </div>

                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table id="datatable" class="table table-striped" data-toggle="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Pelanggan</th>
                                <th>Total pembelian</th>
                                <th>Point</th>
                                <th>Pembelian Terakhir</th>
                                <th class="hidden text-center">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($point as $no => $item)
                                @php
                                    $date = date_create($item->updated_at);
                                @endphp
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $item->pelanggan }}</td>
                                    <td>Rp {{ number_format($item->total_cost, 2, ',', '.') }}</td>
                                    <td>{{ floatval($item->total_cost / 100000 ) }}</td>
                                    <td>{{ date_format($date, 'd/M/Y') }}</td>
                                    <td class="hidden">
                                        <button class="btn btn-sm text-warning flex-end"
                                            onclick="return deleteTable('{{ $item->id }}');"><span class="btn-inner">
                                                <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.4"
                                                        d="M19.643 9.48851C19.643 9.5565 19.11 16.2973 18.8056 19.1342C18.615 20.8751 17.4927 21.9311 15.8092 21.9611C14.5157 21.9901 13.2494 22.0001 12.0036 22.0001C10.6809 22.0001 9.38741 21.9901 8.13185 21.9611C6.50477 21.9221 5.38147 20.8451 5.20057 19.1342C4.88741 16.2873 4.36418 9.5565 4.35445 9.48851C4.34473 9.28351 4.41086 9.08852 4.54507 8.93053C4.67734 8.78453 4.86796 8.69653 5.06831 8.69653H18.9388C19.1382 8.69653 19.3191 8.78453 19.4621 8.93053C19.5953 9.08852 19.6624 9.28351 19.643 9.48851Z"
                                                        fill="currentColor"></path>
                                                    <path
                                                        d="M21 5.97686C21 5.56588 20.6761 5.24389 20.2871 5.24389H17.3714C16.7781 5.24389 16.2627 4.8219 16.1304 4.22692L15.967 3.49795C15.7385 2.61698 14.9498 2 14.0647 2H9.93624C9.0415 2 8.26054 2.61698 8.02323 3.54595L7.87054 4.22792C7.7373 4.8219 7.22185 5.24389 6.62957 5.24389H3.71385C3.32386 5.24389 3 5.56588 3 5.97686V6.35685C3 6.75783 3.32386 7.08982 3.71385 7.08982H20.2871C20.6761 7.08982 21 6.75783 21 6.35685V5.97686Z"
                                                        fill="currentColor"></path>
                                                </svg>
                                            </span> Reset Total</button>

                                    </td>
                                </tr>
                            @endforeach


                        </tbody>

                    </table>
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
                    var href = "{{ route('pelanggankasir.show', 'resetpelanggan') }}?id=" + idval;
                    if (result.isConfirmed) {
                        $("#overlay").fadeIn();
                        window.location.href = href;
                    }
                });
            }
        </script>
    @endsection
