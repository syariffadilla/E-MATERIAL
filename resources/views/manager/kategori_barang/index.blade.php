@extends('layouts.apps')
@section('contents')
    <div class="conatiner-fluid content-inner mt-n5 py-0">

        <div class="row">
            <div class="col-md-3">
                <div class="card h-90">
                    <div class="card-body">
                        <h5 class="mb-3">Kategori Barang</h5>
                        <div class="d-grid mx-auto">
                            <button type="button" class="btn btn-success btn-sm tambahKategori" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Tambah Kategori</button>
                            <hr>
                        </div>
                        <div class="list-group mb-2 ">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-smooth-scroll="true"
                                        class="scrollspy-example bg-body-tertiary" tabindex="0">

                                        @foreach ($kategori as $item2)
                                            <a href="{{ route('setting_kategori.index') }}?id={{ $item2->id }}"
                                                class="list-group-item {{ $kategorifind && $kategorifind->id == $item2->id ? 'active' : '' }}">
                                                {{ $item2->nama_kategori }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>


                        </div>

                        <p class="mt-3">Catatan :</p>
                        <p class="mt-3">
                        <ul>
                            <li>Pilih Kategori untuk melihat sub kategori didalamnya.</li>
                            <li>Scroll untuk melihat kategori lainnya.</li>
                            <li>Kategori yang aktif akan berwarna biru.</li>
                        </ul>
                        </p>


                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h4 class="mb-3 card-title">{{ $kategorifind->nama_kategori }}</h4>
                                    </div>
                                    <div class="col-md-4 text-end">

                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#modaleditkat{{ $kategorifind->id }}">Edit</button>
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#modalhapuskat{{ $kategorifind->id }}"
                                            class="btn btn-sm
                                            btn-danger">Hapus</button>

                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <div class="text-end">

                                        <button class="btn btn-sm btn-success mt-3 mb-3" data-bs-toggle="modal"
                                            data-bs-target="#ModalSubKategori">Tambah Sub Kategori</button>
                                    </div>
                                    <table id="datatable" class="table table-striped" data-toggle="data-table">
                                        <thead>
                                            <tr>
                                                <th>Sub Kategori</th>
                                                <th>Jumlah Barang</th>

                                                <th class="hidden">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody id="tableBody">
                                            @foreach ($sub_kategori as $item)
                                                <tr>
                                                    <td>{{ $item->nama_sub_kategori }}</td>
                                                    <td>{{ $item->barang()->count() }} barang</td>

                                                    <td>
                                                        <button type="button" data-bs-toggle="modal"
                                                            data-bs-target="#modaleditsubkat{{ $item->id }}"
                                                            class="btn btn-sm btn-primary">Edit Sub Kategori</button>
                                                        <button type="button" data-bs-toggle="modal"
                                                            data-bs-target="#modalhapussubkat{{ $item->id }}"
                                                            class="btn btn-sm btn-danger">Hapus Sub Kategori</button>
                                                    </td>

                                                </tr>

                                                <!-- Modal Edit SubKateogri-->
                                                <div class="modal fade" id="modaleditsubkat{{ $item->id }}"
                                                    tabindex="-1" aria-labelledby="modaleditkatLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="modaleditkatLabel">Edit Sub
                                                                    Kategori Barang</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form
                                                                action="{{ route('setting_kategori.update', ['setting_kategori' => $item->id]) }}"
                                                                method="POST">
                                                                {{ csrf_field() }}
                                                                @method('PUT')
                                                                <div class="modal-body">
                                                                    <div class="form-group mb-3">
                                                                        <label for="">Sub Kategori Barang</label>
                                                                        <input type="text" name="subkategori"
                                                                            value="{{ $item->nama_sub_kategori }}"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">save</button>
                                                                </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- Modal Hapyus Kateogri-->
                                                <div class="modal fade" id="modalhapussubkat{{ $item->id }}"
                                                    tabindex="-1" aria-labelledby="modaleditkatLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="modaleditkatLabel">Hapus
                                                                    Kategori Barang</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form
                                                                action="{{ route('setting_kategori.destroy', ['setting_kategori' => $item->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="modal-body">
                                                                    <div class="form-group mb-3">
                                                                        <label for="">Kategori Barang</label>
                                                                        <input type="text" name="subkategori" readonly
                                                                            value="{{ $item->nama_sub_kategori }}"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Delete</button>
                                                                </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
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


        <!-- Modal Sub Kategori Barang -->
        <div class="modal fade" id="ModalSubKategori" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Sub Kategori Barang</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('subKategori.add') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="">Kategori</label>
                                <select id="supplierSelect" name="kategori" @readonly(true) required
                                    class="form-control selectpicker" data-live-search="true">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($kategori as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($item->id == $kategorifind->id) selected @endif>{{ $item->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Sub Kategori Barang</label>
                                <input type="text" name="SubKategori" required class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kategori Barang</h1>
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

                    </form>
                </div>
            </div>
        </div>


        <!-- Modal Edit Kategori-->
        <div class="modal fade" id="modaleditkat{{ $kategorifind->id }}" tabindex="-1"
            aria-labelledby="modaleditkatLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modaleditkatLabel">Edit Kategori Barang</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('kategori.update_manager', ['id' => $kategorifind->id]) }}" method="POST">
                        {{ csrf_field() }}
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="">Kategori Barang</label>
                                <input type="text" name="kategori" value="{{ $kategorifind->nama_kategori }}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>




        <!-- Modal Hapyus Sub Kategori-->
        <div class="modal fade" id="modalhapuskat{{ $kategorifind->id }}" tabindex="-1"
            aria-labelledby="modaleditkatLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modaleditkatLabel">Hapus Kategori Barang</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('kategori.destroy_manager', ['id' => $kategorifind->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="">Kategori Barang</label>
                                <input type="text" name="kategori" readonly
                                    value="{{ $kategorifind->nama_kategori }}" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    @endsection
    @section('js')
    @endsection
