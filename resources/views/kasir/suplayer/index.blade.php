@extends('layouts.apps')
@section('contents')
    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div class="card">
            <div class="card-header">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4> Data Supplier
                            </h4>

                            <div class="col-lg-12 text-end">
                            <div class="btn-group">
                                <button class="btn btn-secondary" aria-expanded="false" data-bs-toggle="modal"
                                    data-bs-target="#ModalSuplayer">
                                    <i
                                                    class="fas fa-plus"> Tambah Data</i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table id="datatable" class="table table-striped" data-toggle="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Supplier</th>
                                <th class="text-center">Alamat</th>
                                <th>No Telepon</th>
                                <th class="hidden">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($point as $no => $item)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->no_tlp }}</td>

                                    <td class="hidden">
                                        <a class="btn btn-sm btn-icon text-primary flex-end"
                                                        title="Edit Suplayer" data-bs-toggle="modal"
                                                        data-bs-target="#ModalEdit{{ $item->id }}">
                                                        <span class="btn-inner">
                                                            <svg class="icon-20" width="20" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M15.1655 4.60254L19.7315 9.16854"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </span>
                                                    </a>
                                                    <a class="btn btn-sm btn-icon text-danger " title="Delete Barang"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#ModalHapus{{ $item->id }}">
                                                        <span class="btn-inner">
                                                            <svg class="icon-20" width="20" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg"
                                                                stroke="currentColor">
                                                                <path
                                                                    d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M20.708 6.23975H3.75" stroke="currentColor"
                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round"></path>
                                                                <path
                                                                    d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </span>
                                                    </a>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>

                    </table>
                </div>

    <div class="modal fade" id="ModalSuplayer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Data Supplier</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('supplier.add') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="">Nama Supplier</label>
                            <input type="text" name="nama" required class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Alamat Supplier</label>
                            <input type="text" name="alamat" required class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">No Telepon</label>
                            <input type="text" name="no_tlp" required class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">save</button>
                    </div>
            </div>
            </form>
        </div>
    </div>

    @foreach ($point as $data)
        <div class="modal fade" id="ModalEdit{{ $data->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Data Suplayer</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="{{ route('suplayer.update', $data->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="">Nama Suplayer</label>
                                <input type="text" name="nama" required class="form-control"
                                    value="{{ $data->nama }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Alamat Suplayer</label>
                                <input type="text" name="alamat" required class="form-control"
                                    value="{{ $data->alamat }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">No Telepon</label>
                                <input type="text" name="no_tlp" required class="form-control"
                                    value="{{ $data->no_tlp }}">
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">update</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    @endforeach
    @if (isset($suplayerfind))
    <div class="modal fade" id="ModalHapus{{ $data->id }}" tabindex="-1"
        aria-labelledby="exampleModalLabel{{ $data->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                {{-- <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel{{ $data->id }}">Data Kategori</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> --}}
                <form action="{{ route('suplayer_destroy', $data->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body text-center">
                        <div class="container-fluid">

                            <img src="{{asset('img/info.jpg')}}" alt="" width="30%">
                        </div>
                        <br>
                        <p>Anda yakin ingin menghapus data ini?</p>
                        <div class="text-center mt-2">
                            <button type="submit" class="btn btn-danger">Delete</button>
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal" aria-label="Close">Cancel</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
    {{-- <div class="modal fade" id="ModalHapus{{ $data->id }}" tabindex="-1"
        aria-labelledby="exampleModalLabel{{ $data->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel{{ $data->id }}">Data
                        Suplayer
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="{{ route('suplayer_destroy', $data->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <p>Anda yakin ingin menghapus data ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}




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
