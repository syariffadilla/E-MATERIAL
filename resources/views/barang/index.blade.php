@extends('layouts.apps')

@section('css')
    <style>
        /* Tombol "Tambah Data" untuk perangkat dengan lebar layar lebih kecil dari 576px */
        @media (max-width: 575.98px) {
            .tambahData .btn {
                font-size: 12px;
                padding: 5px 10px;
            }
        }

        /* Tombol "Tambah Data" untuk perangkat dengan lebar layar antara 576px dan 991.98px */
        @media (min-width: 576px) and (max-width: 991.98px) {
            .tambahData .btn {
                font-size: 14px;
                padding: 8px 12px;
            }
        }

        /* Tombol "Tambah Data" untuk perangkat dengan lebar layar lebih besar dari 992px */
        @media (min-width: 992px) {
            .tambahData .btn {
                font-size: 16px;
                padding: 10px 15px;
            }
        }

        /* Tombol "Tambah Kategori" untuk perangkat dengan lebar layar lebih kecil dari 576px */
        @media (max-width: 575.98px) {
            .tambahKategori {
                font-size: 12px;
                padding: 5px 10px;
            }
        }

        /* Tombol "Tambah Kategori" untuk perangkat dengan lebar layar antara 576px dan 991.98px */
        @media (min-width: 576px) and (max-width: 991.98px) {
            .tambahKategori {
                font-size: 14px;
                padding: 8px 12px;
            }
        }

        /* Tombol "Tambah Kategori" untuk perangkat dengan lebar layar lebih besar dari 992px */
        @media (min-width: 992px) {
            .tambahKategori {
                font-size: 16px;
                padding: 10px 15px;
            }
        }
    </style>

    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
@endsection
@section('contents')
    <div class="conatiner-fluid content-inner py-0">
        <div class="row">
            <div class="col-md-3">
                <div class="card">

                    <div class="card-body">
                        <h4 class="mb-3">Kategori Barang</h4>
                        <div class="list-group mb-2">
                            @foreach ($kategori as $item2)
    <a href="{{ route('barang_show', $item2->id) }}"
        class="list-group-item {{ $kategorifind && $kategorifind->id == $item2->id ? 'active' : '' }}">
        {{ $item2->nama_kategori }}
    </a>
@endforeach



                        </div>
                        <div class="d-grid mx-auto">

                            <button type="button" class="btn btn-success tambahKategori" data-bs-toggle="modal"
                                data-bs-target="#ModalKategori">Tambah Kategori</button>
                        </div>
                    </div>
                </div>
            </div>




            @if (isset($kategorifind))
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h4>{{ $kategorifind['nama_kategori'] }}</h4>
                                    </div>
                                    <div class="col-lg-6 ">
                                        <div class="text-end">
                                            <a class="btn btn-sm btn-icon text-primary flex-end" title="Edit Kategori"
                                                data-bs-toggle="modal" data-bs-target="#ModalEdit{{ $kategorifind->id }}">
                                                <span class="btn-inner">
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
                                            </a>
                                            <a class="btn btn-sm btn-icon text-danger " title="Delete Kategori"
                                                data-bs-toggle="modal" data-bs-target="#ModalHapus{{ $kategorifind->id }}">
                                                <span class="btn-inner">
                                                    <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                                        <path
                                                            d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826"
                                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                        <path d="M20.708 6.23975H3.75" stroke="currentColor"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                        <path
                                                            d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973"
                                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                    </svg>
                                                </span>
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="modal fade" id="ModalCreate" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Data Barang</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <form action="{{ url('barang') }} " method="POST">
                                        {{ csrf_field() }}
                                        <div class="modal-body">
                                            <div class="form-group mb-3">
                                                <label for="">Kategori Barang</label>
                                                <input type="text" name="kat"
                                                    value="{{ $kategorifind->nama_kategori }}" readonly
                                                    class="form-control">
                                                <input type="hidden" name="kategori_barang_id"
                                                    value="{{ $kategorifind->id }}">
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="form-group mb-3">
                                                        <label for="">Nama Barang</label>
                                                        <input type="text" name="nama_barang" required
                                                            class="form-control">
                                                    </div>

                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group mb-3">
                                                        <label for="">Satuan Barang</label>
                                                        <input type="text" name="satuan_barang" required
                                                            class="form-control">
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-3">
                                                        <label for="">Harga Modal</label>
                                                        <input type="text" name="harga_barang_modal" required
                                                            class="form-control  rp">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-3">
                                                        <label for="">Harga Jual</label>
                                                        <input type="text" name="harga_barang_jual"
                                                            class="form-control  rp"
                                                            placeholder="Kosongan Jika Input Manual">
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-3">
                                                        <label for="">Supplier</label>
                                                        <select id="supplierSelect" name="supplier" required
                                                            class="form-control selectpicker" data-live-search="true">
                                                            <option value="">Pilih supplier</option>
                                                            {{-- @foreach ($suppliers as $supplier)
                                                           <option value="{{ $supplier->id }}">{{ $supplier->nama }}</option>
                                                           @endforeach --}}
                                                            @foreach ($supplier as $item)
                                                                <option value="{{ $item->id }}">{{ $item->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>



                                                <div class="col-lg-3">
                                                    <div class="form-group mb-3">
                                                        <label for="">Stok </label>
                                                        <input type="text" name="stok" required
                                                            class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="form-group mb-3">
                                                        <label for="">Discount % </label>
                                                        <input type="number" max="100" name="disc" required
                                                            class="form-control" value="0">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group mb-3">
                                                <label for="">Keterangan Barang</label>
                                                <textarea class="form-control" id="floatingTextarea" name="keterangan"></textarea>
                                            </div>


                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">save</button>
                                        </div>
                                </div>
                                </form>
                            </div>
                        </div>



                        @foreach ($barang as $data)
                            <div class="modal fade" id="ModalEdit{{ $data->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel{{ $data->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel{{ $data->id }}">Data
                                                Barang
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <form action="{{ route('barang_update', $data->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group mb-3">
                                                    <label for="">Kategori Barang</label>
                                                    <input type="text" name="kat"
                                                        value="{{ $kategorifind->nama_kategori }}" readonly
                                                        class="form-control">
                                                    <input type="hidden" name="kategori_barang_id"
                                                        value="{{ $kategorifind->id }}">
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <div class="form-group mb-3">
                                                            <label for="">Nama Barang</label>
                                                            <input type="text" name="nama_barang" required
                                                                class="form-control" value="{{ $data['nama_barang'] }}">
                                                        </div>

                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group mb-3">
                                                            <label for="">Satuan Barang</label>
                                                            <input type="text" name="satuan_barang" required
                                                                class="form-control"
                                                                value="{{ $data['kategori_satuan'] }}">
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-3">
                                                            <label for="">Harga Modal</label>
                                                            <input type="text" name="harga_barang_modal" required
                                                                class="form-control  rp"
                                                                value="{{ number_format($data['harga_modal'], 0, ',', '.') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-3">
                                                            <label for="">Harga Jual</label>
                                                            <input type="text" name="harga_barang_jual" required
                                                                class="form-control  rp"
                                                                placeholder="Isikan 0 jika tidak ada harga"
                                                                value="{{ number_format($data['harga_barang'], 0, ',', '.') }}">
                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-3">
                                                            <label for="">Supplier</label>
                                                            <select id="supplierSelect" name="supplier" required
                                                                class="form-control selectpicker" data-live-search="true">
                                                                <option value="{{ $data['supplier_id'] }}">
                                                                    {{ $suppaliyerfind->nama }}</option>
                                                                @foreach ($supplier as $item)
                                                                    <option value="{{ $item->id }}">
                                                                        {{ $item->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3">
                                                        <div class="form-group mb-3">
                                                            <label for="">Stok </label>
                                                            <input type="text" name="stok" required
                                                                class="form-control" value="{{ $data['stok'] }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3">
                                                        <div class="form-group mb-3">
                                                            <label for="">Discount % </label>
                                                            <input type="number" max="100" name="disc" required
                                                                class="form-control" value="{{ $data['disc'] }}">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-group mb-3">
                                                    <label for="">Keterangan Barang</label>
                                                    <textarea class="form-control" id="floatingTextarea" name="keterangan">{{ $data['keterangan'] }}</textarea>
                                                </div>


                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">update</button>
                                            </div>
                                    </div>
                                    </form>
                                </div>
                            </div>


                            <div class="modal fade" id="ModalHapus{{ $data->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel{{ $data->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        {{-- <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel{{ $data->id }}">Data
                                                Barang
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div> --}}
                                        <form action="{{ route('barang_destroy', $data->id) }}" method="POST">
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
                                            {{-- <div class="modal-footer">
                                              
                                            </div> --}}
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach





                        <div class="card-body">
                            <div class="mb-2">
                                <div class="text-end">
                                    <!-- Example split danger button -->
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-secondary  tambahData" aria-expanded="false"
                                            data-bs-toggle="modal" data-bs-target="#ModalCreate">
                                            <i class="fas fa-plus"> Tambah Data</i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">

                                <table id="datatable" class="table table-striped" data-toggle="data-table">
                                    <thead>
                                        <tr>
                                            <th>Barang</th>
                                            <th>Harga Jual</th>
                                            <th>Harga Modal</th>
                                            <th>Disc %</th>
                                            <th>Supplier</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($barang as $item)
                                            <tr>
                                                <td>{{ $item->nama_barang }}</td>
                                                <td>Rp {{ number_format($item->harga_barang, 0, ',', '.') }}</td>
                                                <td>Rp {{ number_format($item->harga_modal, 0, ',', '.') }}</td>
                                                <td>{{ $item->disc }}%</td>
                                                <td>{{ $item->suplier ? $item->suplier->nama : '-' }}</td>
                                                <td>{{ $item->keterangan }}</td>

                                                <td>
                                                    <a class="btn btn-sm btn-icon text-primary flex-end"
                                                        title="Edit Kategori" data-bs-toggle="modal"
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
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>






    <div class="modal fade" id="ModalKategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Kategori Barang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ url('kategori') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="">Kategori Barang</label>
                            <input type="text" name="kategori" required class="form-control">
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



    @foreach ($kategori as $data)
        <div class="modal fade" id="ModalEdit{{ $data->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel{{ $data->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel{{ $data->id }}">Data Kategori</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="{{ route('kategori.update', $data->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="">Nama Kategori</label>
                                <input type="text" name="kategori" required class="form-control"
                                    value="{{ $data->nama_kategori }}">
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


    @if (isset($kategorifind))
        <div class="modal fade" id="ModalHapus{{ $kategorifind->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel{{ $kategorifind->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    {{-- <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel{{ $kategorifind->id }}">Data Kategori</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div> --}}
                    <form action="{{ route('kategori.destroy', $kategorifind->id) }}" method="POST">
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
                        {{-- <div class="modal-footer">

                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"
        integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        // maskMoney
        $('.rp').on('keyup', function() {
            $(this).maskMoney({
                prefix: 'Rp ',
                precision: 0,
                thousands: '.',
                decimal: '',
                allowZero: true,
                allowNegative: false
            });
        });
    </script>

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
@endsection
