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
            <!-- Bagian kategori dan subkategori seperti sebelumnya -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3">Kategori Barang</h5>
                        <div class="list-group mb-2">
                            <select id="kategori" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                @foreach ($kategori as $kat)
                                    <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                                @endforeach
                            </select>

                        </div>

                        <hr>
                        <h5 class="mb-3">Sub Kategori Barang</h5>
                        <div class="list-group mb-2">
                            <select id="subkategori" class="form-select form-select-sm"
                                aria-label=".form-select-sm example">
                                <option value="">Pilih Kategori terlebih dahulu</option>
                            </select>

                        </div>


                        <hr>
                    </div>
                </div>
            </div>

            <!-- Bagian tabel data barang -->
            @if (isset($kategorifind))
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h4 id="kategoriSubtitle"></h4>
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
                                                <input type="text" name="kat" value="" readonly
                                                    class="form-control" id="kategoriBarangInput">
                                                <input type="hidden" name="kategori_barang_id" value=""
                                                    id="kategoriBarangIdInput">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="">Sub Kategori Barang</label>
                                                <input type="text" name="sub_kat" value="" readonly
                                                    class="form-control" id="subkategoriBarangInput">
                                                <input type="hidden" name="sub_kategori_id" value=""
                                                    id="subkategoriBarangIdInput">
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
                                                <div class="form-group mb-3">
                                                    <label for="">Sub Kategori Barang</label>
                                                    <input type="text" name="kat"
                                                        value="{{ $Subkategorifind->nama_sub_kategori }}" readonly
                                                        class="form-control">
                                                    <input type="hidden" name="kategori_barang_id"
                                                        value="{{ $Subkategorifind->id }}">
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

                                                    <img src="{{ asset('img/info.jpg') }}" alt=""
                                                        width="30%">
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
                                    <div class="btn-group">
                                        <button class="btn btn-light btn-sm dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Export Data
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"
                                                    onclick="return clipboard();">ClipBoard</a></li>
                                            <li><a class="dropdown-item" onclick="return cek_loader();"
                                                    href="{{ route('manager.barang.export', ['id' => $kategorifind->id]) }}">Excel</a>
                                            </li>
                                            <li><a class="dropdown-item" onclick="return cek_loader();"
                                                    href="{{ route('export-barang', ['id' => $kategorifind->id]) }}">Pdf</a>
                                            </li>
                                        </ul>
                                    </div>
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
                                            <th class="hidden">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBody">

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
                            <select id="supplierSelect" name="kategori" required class="form-control selectpicker"
                                data-live-search="true">
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_kategori }}
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

                                <img src="{{ asset('img/info.jpg') }}" alt="" width="30%">
                            </div>
                            <br>
                            <p>Anda yakin ingin menghapus data ini?</p>
                            <div class="text-center mt-2">
                                <button type="submit" class="btn btn-danger">Delete</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">Cancel</button>

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

    <!-- Bagian kategori dan subkategori seperti sebelumnya -->
    <script>
        $(document).ready(function() {
            // Tambahkan variabel global untuk menyimpan nama kategori dan subkategori yang dipilih
            let selectedKategori = "";
            let selectedSubkategori = "";

            // Event listener untuk pemilihan kategori
            $('#kategori').change(function() {
                const kategoriId = $(this).val();
                selectedKategori = $('#kategori option:selected').text();

                if (kategoriId) {
                    // Lakukan permintaan AJAX untuk mendapatkan sub-kategori berdasarkan kategori yang dipilih
                    $.ajax({
                        url: '/getSubkategori/' + kategoriId,
                        type: 'GET',
                        success: function(response) {
                            // Hapus opsi sub-kategori yang lama
                            $('#subkategori').empty();
                            // Tambahkan opsi "Pilih Sub Kategori terlebih dahulu" kembali
                            $('#subkategori').append(
                                '<option value="">Pilih Sub Kategori terlebih dahulu</option>'
                            );
                            // Tambahkan opsi sub-kategori baru berdasarkan data yang diterima dari server
                            $.each(response, function(key, value) {
                                $('#subkategori').append('<option value="' + value.id +
                                    '">' + value.nama_sub_kategori + '</option>');
                            });
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                } else {
                    // Jika tidak ada kategori yang dipilih, hapus opsi sub-kategori
                    $('#subkategori').empty();
                    $('#subkategori').append('<option value="">Pilih Kategori terlebih dahulu</option>');
                }
            });

            $('#subkategori').change(function() {
                const subkategoriId = $(this).val();
                selectedSubkategori = $('#subkategori option:selected').text();

                const kategoriId = $('#kategori').val();

                if (subkategoriId) {
                    // Lakukan permintaan AJAX untuk mendapatkan data barang berdasarkan kategori dan subkategori yang dipilih
                    $.ajax({
                        url: '/getDataBarang/' + kategoriId + '/' + subkategoriId,
                        type: 'GET',
                        success: function(response) {
                            console.log(response);

                            // Update judul kategori dan subkategori sesuai yang dipilih
                            $('#kategoriSubtitle').text(selectedKategori + ' -> ' +
                                selectedSubkategori);

                            // Hapus data tabel yang lama
                            $('#tableBody').empty();

                            // Tambahkan data barang baru berdasarkan data yang diterima dari server
                            $.each(response, function(key, value) {
                                // Format harga_barang dan harga_modal menjadi mata uang Rupiah dengan menambahkan "Rp." di depannya
                                const hargaBarangFormatted = "Rp. " + (value
                                    .harga_barang || 0).toLocaleString('id-ID');
                                const hargaModalFormatted = "Rp. " + (value
                                    .harga_modal || 0).toLocaleString('id-ID');

                                // Check if supplier is defined and has a nama property
                                const supplierNama = value.supplier && value.supplier
                                    .nama ? value.supplier.nama : 'N/A';

                                // Tambahkan data barang ke dalam tabel dengan format mata uang Rupiah
                                $('#tableBody').append('<tr><td>' + value.nama_barang +
                                    '</td><td>' + hargaBarangFormatted +
                                    '</td><td>' + hargaModalFormatted +
                                    '</td><td>' + value.disc +
                                    '</td><td>' + supplierNama +
                                    '</td><td>' + value.keterangan +
                                    '</td><td class="hidden">' +
                                    '<a class="btn btn-sm btn-icon text-primary flex-end" title="Edit Kategori" data-bs-toggle="modal" data-bs-target="#ModalEdit' +
                                    value.id + '">' +
                                    '<span class="btn-inner">' +
                                    '<svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">' +
                                    '<path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>' +
                                    '<path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>' +
                                    '<path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>' +
                                    '</svg>' +
                                    '</span>' +
                                    '</a>' +
                                    '<a class="btn btn-sm btn-icon text-danger " title="Delete Barang" data-bs-toggle="modal" data-bs-target="#ModalHapus' +
                                    value.id + '">' +
                                    '<span class="btn-inner">' +
                                    '<svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">' +
                                    '<path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>' +
                                    '<path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>' +
                                    '<path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>' +
                                    '</svg>' +
                                    '</span>' +
                                    '</a>' +
                                    '</td>' +
                                    '</tr>');
                            });

                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                } else {
                    // Jika tidak ada subkategori yang dipilih, hapus data tabel dan reset judul kategori dan subkategori
                    $('#tableBody').empty();
                    $('#kategoriSubtitle').text('');
                }
            });
        });
    </script>

    <script>
        // Event listener untuk membuka modal tambah data
        $('.tambahData').click(function() {
            const kategoriId = $('#kategori').val();
            const subkategoriId = $('#subkategori').val();
            const kategoriNama = $('#kategori option:selected').text();
            const subkategoriNama = $('#subkategori option:selected').text();

            // Isi nilai ID dan Nama kategori dan subkategori ke dalam input di dalam modal
            $('#kategoriBarangIdInput').val(kategoriId);
            $('#kategoriBarangInput').val(kategoriNama);
            $('#subkategoriBarangIdInput').val(subkategoriId);
            $('#subkategoriBarangInput').val(subkategoriNama);
        });


        // Event listener untuk membuka modal "Sub Kategori Barang"
        $('.tambahKategori').click(function() {
            // Setel nilai ID dan Nama kategori yang dipilih pada input dalam modal "Sub Kategori Barang"
            const kategoriId = $('#kategori').val();
            const kategoriNama = $('#kategori option:selected').text();

            $('#kategoriBarangIdInput').val(kategoriId);
            $('#kategoriBarangInput').val(kategoriNama);
        });
    </script>



    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
@endsection
