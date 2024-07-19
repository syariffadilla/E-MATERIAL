@extends('layouts.apps')
@section('contents')
    <div class="conatiner-fluid content-inner mt-n5 py-0">

        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3">Kategori Barang</h5>
                        <div class="list-group mb-2">
                            <select id="kategori" class="form-select form-select-sg js-example-basic-single"
                                aria-label=".form-select-sm example">
                                @foreach ($kategori as $kat)
                                    <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                                @endforeach
                            </select>

                        </div>

                        <hr>
                        <h5 class="mb-3">Sub Kategori Barang</h5>
                        <div class="list-group mb-2">
                            <select id="subkategori" class="form-select form-select-sm js-example-basic-single"
                                aria-label=".form-select-sm example">
                                <option value="">Pilih Kategori terlebih dahulu</option>
                            </select>

                        </div>


                        <hr>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="mb-3 card-title">Daftar Stok Barang</h4>
                                    </div>
                                    <div class="col-md-6 text-end">

                                        <div class="btn-group">
                                            <button class="btn btn-light btn-sm dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Export Data
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="#"
                                                        onclick="return clipboard();">ClipBoard</a>
                                                </li>
                                                <li>
                                                    <button id="exportExcel" type="button" class="dropdown-item"
                                                        href="">Excel</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table id="datatable" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Barang</th>
                                                <th>Stok</th>
                                                {{-- <th>Presentase</th> --}}
                                                <th>Supplier</th>
                                                <th>Keterangan</th>
                                                <th class="hidden">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody id="tableBody">
                                            <!-- Data barang akan ditambahkan secara dinamis melalui JavaScript -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="Modaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="" id="formedit" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah
                                Stok Barang</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h3 class="mb-3" id="nama_barang"></h3>
                            <div class="input-group mb-3">
                                <input type="text" name="stok" class="form-control"
                                    placeholder="Masukkan Jumlah Barang" aria-label="Masukkan Jumlah Barang" required
                                    aria-describedby="basic-addon2">
                                <span class="input-group-text" id="kategori_satuan"></span>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="reset"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Reset Stok
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endsection
    @section('js')
        <script>
            $(document).on('click', '.edit', function() {
                var dataValueString = $(this).data('value');
                var url = "{{ route('stokbarangmanager.update', '') }}/" + dataValueString.id;

                $('#formedit').attr('action', url);
                $('#kategori_satuan').text(dataValueString.kategori_satuan);
                $('#nama_barang').text(dataValueString.nama_barang);


                $('#Modaledit').modal('show');

            });
            $(document).ready(function() {
                // alert(Subkategorifind);
                $('.js-example-basic-single').select2();

                @if (isset($Subkategorifind->id))
                    var Subkategorifind = '{{ $Subkategorifind->id }}';
                    $.ajax({
                        url: '/getSubkategori/' + $('#kategori').val(),
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

                            // Setel nilai Subkategorifind hanya jika itu tidak null atau undefined
                            $('#subkategori').val(Subkategorifind).change();
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                @endif
                $('.loader').click(function(e) {
                    e.preventDefault(); // Prevent the default link behavior

                    $("#overlay").fadeIn();

                    var link = $(this).attr('href');

                    // Simulate a click on the download link using window.location.href
                    window.location.href = link;

                    setTimeout(function() {
                        $("#overlay").fadeOut();
                    }, 3000);
                });
            });




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

        <!-- Bagian kategori dan subkategori seperti sebelumnya -->
        <script>
            // $(document).ready(function() {
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
                            $.each(response, function(key, value) {
                                // Format stok dengan satuan
                                const stokS = value.stok + ' ' + value.kategori_satuan;

                                // Check if supplier is defined and has a nama property
                                const supplierNama = value.supplier && value.supplier
                                    .nama ? value.supplier.nama : '-';

                                // Create a new table row element
                                const newRow = $('<tr>');

                                // Add data to the new row
                                newRow.append($('<td>').text(value.nama_barang));
                                newRow.append($('<td>').text(stokS));
                                newRow.append($('<td>').text(supplierNama));
                                newRow.append($('<td>').text(value.keterangan));

                                // Create an edit button with data attributes
                                const editButton = $('<button>')
                                    .addClass(
                                        'btn btn-sm btn-icon text-primary flex-end edit')
                                    .attr('data-bs-toggle', 'modal')
                                    .attr('data-bs-target', '#exampleModal' + value.id)
                                    .attr('data-value', JSON.stringify(response[key]));
                                editButton.append(
                                    $('<span>').addClass('btn-inner').html(
                                        '<svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">' +
                                        '<path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>' +
                                        '<path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>' +
                                        '<path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>' +
                                        '</svg>'
                                    )
                                );

                                newRow.append($('<td>').addClass('hidden').append(
                                    editButton));

                                // Append the new row to the table body
                                $('#tableBody').append(newRow);
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

            $(document).on('click', '.btn[data-bs-toggle="modal"]', function() {
                const itemId = $(this).data('item-id');
                const modalId = '#exampleModal' + itemId;
                // Use modalId to show the corresponding modal
                $(modalId).modal('show');
            });


            // });
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

        {{-- Export --}}

        <script>
            // Export data to excel
            document.addEventListener('DOMContentLoaded', function() {
                const exportButton = document.getElementById('exportExcel');

                exportButton.addEventListener('click', function() {
                    Swal.fire({
                        html: "Data berhasil diexport! Klik oke untuk melanjutkan.",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    }).then(function() {
                        // Setelah pengguna menekan tombol "Ok" pada SweetAlert,
                        // maka kita akan mengarahkan ke rute export.
                        window.location.href = 'manager/stok/export';
                    });
                });
            });
        </script>
    @endsection
