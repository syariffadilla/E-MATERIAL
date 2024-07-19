@extends('layouts.apps')

@section('css')
    <style>
        /* Tombol untuk perangkat dengan lebar layar lebih kecil dari 576px */
@media (max-width: 575.98px) {
  .restoreData .btn {
    font-size: 12px;
    padding: 5px 10px;
  }
}

/* Tombol untuk perangkat dengan lebar layar antara 576px dan 991.98px */
@media (min-width: 576px) and (max-width: 991.98px) {
  .restoreData .btn {
    font-size: 14px;
    padding: 8px 12px;
  }
}

/* Tombol untuk perangkat dengan lebar layar lebih besar dari 992px */
@media (min-width: 992px) {
  .restoreData .btn {
    font-size: 16px;
    padding: 10px 15px;
  }
}
    </style>
@endsection

@section('contents')
    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div class="card">
            {{-- <div class="card-header">
          Quote
        </div> --}}
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <img src="{{ asset('img/undraw/trash.svg') }}" alt="trash" class="img-fluid mt-5">
                    </div>
                    <div class="col-sm-6">
                        <h4 class="mb-2 card-title">Catatan :</h4>
                        <ul>
                            <li>Pastikan semua data pada transaksi sudah diexport agar data anda tetap tersimpan</li>
                            <li>Data yang sudah dihapus tidak dapat dikembalikan bagaimanapun caranya</li>
                            <li>Dengan menghapus data secara berkala akan membuat aplikasi terasa ringan saat di jalankan
                            </li>
                            <li>Pastikan aplikasi tidak sedang digunakan oleh kasir saat penghapusan dijalankan</li>
                        </ul>
                        <form action="{{ route('restore.store') }}" method="post">
                          @csrf
                          @method('POST')
                            <div class="form-check ms-2">
                                <input class="form-check-input" type="checkbox" value="1" required
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Saya telah membaca dan memahami catatan tersebut
                                </label>
                            </div>
                            <div class="text-end mt-3 restoreData">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-trash-alt"> Restore Data</i></button>
                            </div>

                        </form>

                    </div>
                    <div class="col-lg-12">
                        <h3 class="mt-4 ms-3 mb-3">History Restore Data</h3>
                        <table id="datatable" class="table table-striped" data-toggle="data-table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tgl Restore</th>
                                    <th scope="col">User</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($restore as $no => $item)
                                    @php
                                        $date = date_create($item->created_at);
                                    @endphp
                                    <tr>
                                        <td scope="row">{{$no+1}}</td>
                                        <td>{{date_format($date, 'd-M-Y')}}</td>
                                        <td>{{ $item->users }}</td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection
