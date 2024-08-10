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
    <form action="{{ route('savetransaksi') }}" method="post">
        @csrf
        <div class="conatiner-fluid content-inner mt-n5 py-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card   rounded">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h4 class="mb-2" id="invoice">Invoice
                                        #INV{{ date('Ymd') }}{{ $transaksi->count() + 1 }}
                                        <input required type="hidden" name="invoice"
                                            value="INV{{ date('Ymd') }}{{ $transaksi->count() + 1 }}">
                                    </h4>
                                    Tanggal Pemakaian: {{ $tanggalIndonesia }}
                                    <input required type="hidden" name="tanggal_beli" value=" {{ $tanggalIndonesia }}">
                                </div>
                                <div class="col-sm-6">

                                    <!-- <div class="mb-3 row">

                                                                            <label for="pelanggan"
                                                                                class="col-sm-4 col-form-label text-dark text-end">Pembeli</label>

                                                                            <div class="col-sm-8">
                                                                                <input required type="text" class="form-control" placeholder="Input disini"
                                                                                    id="pelanggan" data-pelanggan="{{ $pelanggan }}" name="nama_pelanggan"
                                                                                    required>

                                                                                <div data-bs-spy="scroll" data-bs-root-margin="0px 0px -40%"
                                                                                    data-bs-smooth-scroll="true" class="scrollspy-example z-3 position-absolute"
                                                                                    tabindex="0">

                                                                                    <ul class="list-group" id="namePelanggan">

                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 row">

                                                                            <label for="pelanggan" class="col-sm-4 col-form-label text-dark text-end">No
                                                                                Hp</label>

                                                                            <div class="col-sm-8">
                                                                                <input type="text" maxlength="10" class="form-control"
                                                                                    placeholder="Input disini" name="no_hp">

                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 row">

                                                                            <label for="pelanggan" class="col-sm-4 col-form-label text-dark text-end">Alamat
                                                                                Pembeli</label>

                                                                            <div class="col-sm-8">
                                                                                <textarea class="form-control" aria-label="With textarea" name="alamat"></textarea>

                                                                            </div>
                                                                        </div>

                                     -->

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 mt-4">
                                    <div class="table-responsive">
                                        <table class="table" id="tabel-barang-utama">
                                            <thead>
                                                <tr>
                                                    <th style="width: 300px;">Nama Barang</th>
                                                    <th style="width: 100px;">Stok</th>
                                                    <th style="width: 80px;">Jumlah</th>
                                                    <th style="width: 80px;">Stok Akhir</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                                {{-- Otomatis Menggunakan Ajax funtion tambahCart() --}}
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
                                                <tr>
                                                    <td>
                                                    </td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center">
                                                        <!-- <button type="button" class="btn btn-sm btn-info"
                                                                                                id="add_manual"><i class="fas fa-plus"></i>
                                                                                                Tambah Manual</button> -->
                                                        <button type="button" class="btn btn-sm btn-secondary"
                                                            data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                            id="tembah-modal-barang">
                                                            <i class="fas fa-plus"></i> Tambah (F2)
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p>Catatan :</p>
                                        <p class="mb-0 mt-4">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <li data-kasir="{{ $user->name }}" id="kasir">Dibuat Oleh Pegawai :
                                                    {{ $user->name }}</li>
                                                <li>Perhatikan Kembali Sebelum Mengklik Save !</li>
                                                <li>Pastikan stok barang terinput sesuai .</li>

                                            </div>
                                        </div>
                                        </p>
                                        <div class="d-flex justify-content-center mt-4 float-end">

                                            <button type="submit" class="btn btn-primary" name="intruksi" value="save"
                                                id="save-button">
                                                Save (F6) </i></button>
                                        </div>
                                        <div class="d-flex justify-content-center mt-4">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('modal')
    <!-- Modal Tambah Barang -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Daftar Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="row justify-content-center">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <h6 class="card-title">Cari Nama Barang</h6>
                                        <input required type="text" class="form-control" id="search"
                                            placeholder="Masukkan Nama Barang">
                                    </div>
                                    <p class="card-title">Harap Pastikan Stok Cukup!</p>

                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive mt-4">

                                    <div class="container">

                                        <table class="table table-striped mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Kategori</th>
                                                    <th>Nama</th>
                                                    <th>Stok</th>

                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody-cart">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    {{-- <h4 id="pesan-slug" class="text-info text-center">Silahkan Cari Barang</h4> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close (ESC)</button>
                </div>
            </div>
        </div>
    </div>
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

@section('js')
    <script>
        document.addEventListener('keydown', function(event) {
            if (event.key === 'F2') {
                event.preventDefault(); // Mencegah fungsi default F2 jika diperlukan
                var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {
                    keyboard: true
                });
                myModal.show(); // Tampilkan modal ketika F2 ditekan
            }

            if (event.key === 'F6') {
                event.preventDefault(); // Mencegah fungsi default F6 jika diperlukan
                document.getElementById('save-button').click(); // Simulasikan klik tombol Save
            }
        });
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"
        integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).on('keyup', '.rp', function() {
            $('.rp').maskMoney({
                thousands: '.',
                decimal: ',',
                precision: 0
            });
        });
        $(document).on('keyup', '.harga-barang', function() {

            var jumlah = $(this).closest('td').nextAll().eq(1).find('input').val();

            // var diskon = harga * (discFix / 100);

            // console.log(hasil);
            // console.log($(this).closest('td').nextAll().eq(2).find('input').val(1));
            $(this).closest('td').nextAll().eq(2).find('input').val(hasil.toLocaleString('id-ID'));
            $(this).closest('td').nextAll().eq(2).find('div').text('Rp. ' + hasil.toLocaleString('id-ID'));
            // ('Rp. ' + hasil.toLocaleString('id-ID'));

            hitungTotalSemua();

        });
        $(document).on('keyup', '.discount-barang', function() {
            //var hargaAwal = $(this).closest('td').prevAll().eq(0).find('input').val();
            //var harga = parseFloat(hargaAwal.replace(/\./g, "").replace(/,/g, "."));
            // var disc = parseFloat($(this).val().replace(/\./g, "").replace(/,/g, "."));
            var jumlah = $(this).closest('td').nextAll().eq(0).find('input').val();
            // var discFix = parseFloat(disc);
            // var diskon = harga * (discFix / 100);

            var hargaSetelahDiskon = harga - disc;
            var hasil = hargaSetelahDiskon * jumlah;


            $(this).closest('td').nextAll().eq(1).find('input').val(hasil.toLocaleString('id-ID'));
            $(this).closest('td').nextAll().eq(1).find('div').text('Rp. ' + hasil.toLocaleString('id-ID'));

            hitungTotalSemua();

        });

        $(document).on('keyup', '.jumlah-cart', function() {
            // var hargaAwal = $(this).closest('td').prevAll().eq(1).find('input').val();
            //var harga = parseFloat(hargaAwal.replace(/\./g, "").replace(/,/g, "."));
            //var disc = $(this).closest('td').prevAll().eq(0).find('input').val();
            var jumlah = $(this).val();
            var stok = $(this).data('stok');
            var kategori_satuan = $(this).data('kategori_satuan');
            // var discFix = parseFloat(disc.replace(/\./g, "").replace(/,/g, "."));
            if (stok) {
                if (jumlah > stok) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Peringatan',
                        text: 'Stok barang yang tersedia hanya ' + stok + ' ' + kategori_satuan +
                            ', silahkan input jumlah barang kembali',
                        showConfirmButton: true,
                    });
                    $(this).val(0);
                    $(this).closest('td').nextAll().eq(0).find('input').val(0);
                    $(this).closest('td').nextAll().eq(0).find('div').text('Rp. 0');
                    return hitungTotalSemua();

                }
            }
            // var diskon = harga * (discFix / 100);
            if (isNaN(discFix)) {
                discFix = 0;
            }
            // alert(discFix);
            // // Menghitung harga setelah diskon
            // var hargaSetelahDiskon = harga - discFix;
            //var hasil = hargaSetelahDiskon * jumlah;

            $(this).closest('td').nextAll().eq(0).find('input').val(hasil.toLocaleString('id-ID'));
            $(this).closest('td').nextAll().eq(0).find('div').text('Rp. ' + hasil.toLocaleString('id-ID'));

            return hitungTotalSemua();
        });

        $(document).on('keyup', '.cekstok', function() {
            const jumlah = parseInt(input.value);
            const stok = parseInt(input.getAttribute('data-stok'));
            const kategori_satuan = input.getAttribute('data-kategori_satuan');
            if (jumlah > stok) {
                Swal.fire({
                    icon: 'info',
                    title: 'Peringatan',
                    text: 'Stok barang yang tersedia hanya ' + stok + ' ' + kategori_satuan +
                        ', silahkan input jumlah barang kembali',
                    showConfirmButton: true,
                });

                var closestTd = input.closest('td');
                var nextTdInput = closestTd.nextElementSibling.querySelector('input');
                nextTdInput.value = 0;
                hitungTotalSemua();
                return input.value = 0;
            }
        });
    </script>
    <script>
        $('#add_manual').on('click', function() {

            var inner = `  <tr>
                <td class="text-center col-5">
                                <textarea aria-label="With textarea" name="nama_barang[]" rows="3" cols="30"></textarea>
                                <input required type="hidden" name="barang_id[]" value="1" />
                            </td>

                                    <td class="text-center col-4" id="harga_barang_cart" name="harga_barang_cart">
                                        <div class="input-group">
                                            <input required type="text" aria-label="Input Harga Barang" class="rp harga-barang" name="harga_barang[]" placeholder="Harga Jual">

                                            </div>
                                            <hr>
                                            <div class="input-group ">

                                                <input required type="text" aria-label="Input Harga Barang" class="rp" name="harga_modal[]" placeholder="Harga Modal">
                                                </div>

                                    </td>
                                    <td class="text-center col-5">
                                        <input required type="text" value="0" name="disc_barang[]" class="rp discount-barang"></td>
                                    <td class="text-center form-group form-group-alt" >
                                        <input required type="text" class="form-control form-control-sm jumlah-cart" max="100" name="jumlah_barang[]">
                                    </td>
                                    <td class="text-center col-5">
                                        <div class="text"></div>
                                        <input required type="hidden" name="total_barang[]" class="form-control" readonly />

                                    </td>
                                    <td class="col-2">
                                        <button type="button" class="btn btn-link" id="hapus-barang-cart">
                                            <svg class="icon-32" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M14.3955 9.59497L9.60352 14.387" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M14.3971 14.3898L9.60107 9.59277" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.3345 2.75024H7.66549C4.64449 2.75024 2.75049 4.88924 2.75049 7.91624V16.0842C2.75049 19.1112 4.63549 21.2502 7.66549 21.2502H16.3335C19.3645 21.2502 21.2505 19.1112 21.2505 16.0842V7.91624C21.2505 4.88924 19.3645 2.75024 16.3345 2.75024Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                                                                </td>
                            </tr>`;
            $('#tbody').append(inner);

        })
    </script>

    <script>
        function autocomplete(pelanggan, list) {
            pelanggan.addEventListener('input', function() {
                closeList();
                var inputValue = this.value.toUpperCase();
                this.value = inputValue;
                if (!this.value) return;
                for (var i = 0; i < list.length; i++) {
                    if (list[i].toUpperCase().indexOf(this.value.toUpperCase()) !== -1) {
                        var suggestion = document.createElement('li');
                        suggestion.className = "list-group-item suggestion";
                        suggestion.innerHTML = `<a href="#" class="suggestion">${list[i]}</a>`;
                        suggestion.addEventListener('click', function() {
                            pelanggan.value = this.innerText;
                            closeList();
                        });
                        document.getElementById('namePelanggan').appendChild(suggestion);
                    }
                }
            });

            function closeList() {
                var suggestions = document.getElementsByClassName('suggestion');
                while (suggestions.length > 0) {
                    suggestions[0].parentNode.removeChild(suggestions[0]);
                }
            }
        }

        // Get the existing names from the dataset attribute
        var pelangganData = JSON.parse(document.getElementById('pelanggan').dataset.pelanggan);

        // Call the autocomplete function with the input element and the existing names array
        autocomplete(document.getElementById('pelanggan'), pelangganData);
    </script>

    <script>
        $('#search').on("keyup", async function() {
            var inputan = $(this).val();
            var tbody = document.getElementById('tbody-cart');
            tbody.innerHTML = "";

            if (inputan != "") {
                var path = "{{ route('autocomplete') }}?search=" + inputan;

                try {
                    var data = await $.ajax({
                        url: path,
                        type: 'GET',
                        contentType: 'application/json'
                    });

                    // cek setiap data apakah sudah ada di dalam tabel atau belum
                    data.forEach(element => {
                        if (!$(`#${element.id}`).length) {
                            const row = tbody.insertRow();
                            row.id = element.id;
                            row.innerHTML = `<tr>
                                    <td>${element.nama_kategori}</td>
                                    <td>${element.nama_barang}</td>
                                    <td>${element.stok}</td>

                                    <td>
                                        <button type="button" onclick="tambahCart('${element.id}')" class="btn btn-link" id="tambah-barang">
                                            <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12.0001 8.32739V15.6537" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M15.6668 11.9904H8.3335" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M16.6857 2H7.31429C4.04762 2 2 4.31208 2 7.58516V16.4148C2 19.6879 4.0381 22 7.31429 22H16.6857C19.9619 22 22 19.6879 22 16.4148V7.58516C22 4.31208 19.9619 2 16.6857 2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>`;
                            // Menonaktifkan tombol tambah jika stok barang = 0
                            if (element.stok === 0) {
                                const tambahButton = row.querySelector('#tambah-barang');
                                tambahButton.disabled = true;
                            }
                        }
                    });

                } catch (error) {
                    console.log(error);

                }
            }
        });
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function tambahCart(id) {
            // Kirim AJAX request untuk mendapatkan data barang dengan id tertentu
            $.ajax({
                url: '/tambah-barang-button',
                method: 'GET',
                dataType: 'json',
                data: {
                    id: id
                },
                success: function(data) {
                    // console.log(data);
                    // Buat elemen baru untuk tabel
                    const stokBarang = data.stok;
                    const newRow = document.createElement('tr');
                    if (data.harga === 0) {
                        // console.log(data);
                        newRow.innerHTML = `
                        <td class="text-center col-5">
                                    <h6 class="mb-0 nama_barang_cart" data-id="${id}" name="nama_barang_cart">${data.nama_barang}</h6>
                                        <input required type="hidden" name="nama_barang[]" value='${data.nama_barang}' />
                                        <input required type="hidden" name="barang_id[]" value="${data.id}" />
                                </td>
                               <h6 class="mb-0 stok_barang_cart" data-id="${id}" name="stok_barang_cart">${data.stok}</h6>
                                        <input required type="hidden" name="stok[]" value='${data.stok}' />
                                        <input required type="hidden" name="barang_id[]" value="${data.id}" />
                                </td>
                                <td class="text-center col-5 form-group form-group-alt" id="jumlah_cart" name="jumlah_cart">
                                    <input required type="text" class="form-control form-control-sm jumlah-cart cekstok" step="0.1" name="jumlah_barang[]" data-stok="${data.stok}" data-kategori_satuan="${data.kategori_satuan}" >
                                </td>
                                <td class="text-center col-5">
                                    <div class="text"></div>
                                        <input required type="hidden" name="total_barang[]" class="form-control" readonly />
                                </td>
                                <td class="col-2">
                                    <button type="button" class="btn btn-link" id="hapus-barang-cart">
                                            <svg class="icon-32" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M14.3955 9.59497L9.60352 14.387" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M14.3971 14.3898L9.60107 9.59277" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.3345 2.75024H7.66549C4.64449 2.75024 2.75049 4.88924 2.75049 7.91624V16.0842C2.75049 19.1112 4.63549 21.2502 7.66549 21.2502H16.3335C19.3645 21.2502 21.2505 19.1112 21.2505 16.0842V7.91624C21.2505 4.88924 19.3645 2.75024 16.3345 2.75024Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                                                                </td>

                                `;

                    } else {
                        console.log(data);
                        newRow.innerHTML = `
    <td class="col-5">
        <h6 class="mb-0 nama_barang_cart" data-id="${id}" name="nama_barang_cart">${data.nama_barang}</h6>
        <input required type="hidden" name="nama_barang[]" value='${data.nama_barang}' />
        <input required type="hidden" name="barang_id[]" value="${id}" />
    </td>
    <td class="col-5">
        <h6 class="mb-0 stok_cart" name="stok_cart">${data.stok}</h6>
        <input required type="hidden" name="stok_barang[]" value='${data.stok}' />
    </td>
    <td class="text-center col-5 form-group form-group-alt" id="jumlah_cart" name="jumlah_cart">
    <input required type="text" class="form-control form-control-sm total_barang" name="jumlah_barang[]" data-harga="${data.harga}" data-disc="${data.disc}" data-stok="${data.stok}" data-kategori_satuan="${data.kategori_satuan}">
    </td>
    <td class="text-center col-5">
        <div class="text">Masukkan jumlah barang</div>
        <input required type="hidden" name="sisaStok[]" class="form-control sisaStok"  readonly />
    </td>

    <td class="col-2">
        <button type="button" class="btn btn-link" id="hapus-barang-cart">
            <svg class="icon-32" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14.3955 9.59497L9.60352 14.387" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M14.3971 14.3898L9.60107 9.59277" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M16.3345 2.75024H7.66549C4.64449 2.75024 2.75049 4.88924 2.75049 7.91624V16.0842C2.75049 19.1112 4.63549 21.2502 7.66549 21.2502H16.3335C19.3645 21.2502 21.2505 19.1112 21.2505 16.0842V7.91624C21.2505 4.88924 19.3645 2.75024 16.3345 2.75024Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </button>
    </td>
`;

                    }



                    // Ambil elemen tbody tabel dan tambahkan elemen baru
                    const tbody = document.querySelector('#tabel-barang-utama tbody');
                    tbody.appendChild(newRow);

                    // Tampilkan modal konfirmasi
                    $('#exampleModal').modal('hide');
                    $('#konfirmasiModal').modal('show');
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }
    </script>



    <script>
        // Fungsi untuk menghitung stok total
        function hitungStokTotal(input) {
            const stokAwal = parseFloat(input.getAttribute('data-stok'));
            const jumlahBarang = parseFloat(input.value);

            // Pengecekan apakah input kosong
            if (isNaN(jumlahBarang)) {
                const sisaStokElement = input.closest('tr').querySelector('.text');
                const sisaStokInput = input.closest('tr').querySelector('.sisaStok');

                if (sisaStokElement) {
                    sisaStokElement.textContent = 'Inputkan Stok'; // Pesan jika input kosong
                }

                if (sisaStokInput) {
                    sisaStokInput.value = ''; // Kosongkan nilai sisa stok jika input kosong
                }
                return; // Keluar dari fungsi jika input kosong
            }

            const sisaStok = stokAwal - jumlahBarang;

            const sisaStokElement = input.closest('tr').querySelector('.text');
            const sisaStokInput = input.closest('tr').querySelector('.sisaStok');

            if (sisaStokElement) {
                sisaStokElement.textContent = sisaStok >= 0 ? sisaStok : 'Stok tidak cukup';
            }

            if (sisaStokInput) {
                sisaStokInput.value = sisaStok >= 0 ? sisaStok : 0; // Pastikan tidak ada nilai negatif
            }
        }

        // Event listener menggunakan jQuery
        $(document).on('keyup', '.total_barang', function() {
            hitungStokTotal(this); // Panggil fungsi dengan elemen input sebagai argumen
        });





        function updateTotal(input) {

            const jumlah = parseFloat(input.value);
            const stok = parseFloat(input.getAttribute('data-stok'));
            const kategori_satuan = input.getAttribute('data-kategori_satuan');
            if (jumlah > stok) {
                Swal.fire({
                    icon: 'info',
                    title: 'Peringatan',
                    text: 'Stok barang yang tersedia hanya ' + stok + ' ' + kategori_satuan +
                        ', silahkan input jumlah barang kembali',
                    showConfirmButton: true,
                });

                var closestTd = input.closest('td');
                var nextTdInput = closestTd.nextElementSibling.querySelector('input');
                nextTdInput.value = 0;
                hitungTotalSemua();
                return input.value = 0;
            }


            const harga = parseFloat(input.getAttribute('data-harga'));
            const disc = parseFloat(input.getAttribute('data-disc'));
            let total;

            // if (harga === 0) {
            //     const manualHarga =
            //     //  parseFloat($('#harga_input_manual').val().replace(/\./g, ''));
            //     total = jumlah * manualHarga * (1 - disc / 100);
            //     alert(total);
            // } else {
            total = jumlah * harga * (1 - disc / 100);
            // }

            var closestTd = input.closest('td');
            var nextTdInput = closestTd.nextElementSibling.querySelector('input');
            var nextTdDiv = closestTd.nextElementSibling.querySelector('div');

            nextTdInput.value = total.toLocaleString('id-ID');
            nextTdDiv.textContent = 'Rp. ' + total.toLocaleString('id-ID');


            return hitungTotalSemua();

        }

        function hitungTotalSemua() {

            var totalSemua = 0;
            $('input[name="total_barang[]"]').each(function() {
                var value_barang = $(this).val();
                const totalBaris = parseInt(value_barang.replace(/\./g, ''));
                totalSemua = totalSemua + totalBaris;
            });
            var total = 'Rp. ' + totalSemua.toLocaleString('id-ID');
            document.querySelector('#total-semua').value = total;

        }


        $('#bayar').on('keyup', function() {
            const bayar = parseFloat($(this).val().replace(/\D/g, ''));
            const totalSemua = parseInt(document.querySelector('#total-semua').value.replace(/[^\d]/g, ''));
            const kembalian = bayar - totalSemua;
            document.querySelector('#kembalian').value = 'Rp. ' + kembalian.toLocaleString('id-ID');


        });

        $(document).on('click', '#hapus-barang-cart', function() {
            $(this).closest('tr').remove();



            // Kurangi total semua
            hitungTotalSemua();

        });
    </script>






    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection
