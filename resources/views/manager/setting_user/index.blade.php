@extends('layouts.apps')
@section('contents')
    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div class="card">
            {{-- <div class="card-header">
          Quote
        </div> --}}
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="mb-2 card-title">Daftar Pengguna :</h4>
                        <div class="text-end mb-2">
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-plus"> Tambah
                                Pengguna</i></button>
                        </div>
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped" data-toggle="data-table">

                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengguna as $no => $item)
                                    <tr>
                                        <th scope="row">{{ $no + 1 }}</th>
                                        <td>{{ $item['name'] }}</td>
                                        <td>{{ $item['email'] }}</td>
                                        <td>
                                            @if ($item['role_is'] == 1)
                                                Manager
                                            @else
                                                Kasir
                                            @endif
                                        </td>
                                        <td>
                                          
                                                <div style="float:center;">
                                                    <a class="btn btn-sm btn-icon text-primary flex-end"
                                                        href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{$item['id']}}">
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
                                                    @if ($item['id'] != 1)
                                                    <a class="btn btn-sm btn-icon text-danger" data-bs-toggle="tooltip"
                                                        title="Delete User" href="#" onclick="return deleteTable('{{$item['id']}}')">
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
                                                    @endif
                                                </div>
                                          
                                        </td>
                                    </tr>


                                     <!-- Modal -->
        <div class="modal fade" id="exampleModal{{ $item['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pengguna</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('setting_users.update', $item['id']) }}" method="post">
                            @csrf

                            <div class="mb-3">
                                <label for="exampleInputNama1" class="form-label">Nama</label>
                                <input type="text" class="form-control" value="{{ $item['name'] }}" name="name" id="exampleInputNama1"
                                    aria-describedby="NamaHelp" required>

                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" value="{{ $item['email'] }}" required>
                                <div id="emailHelp" class="form-text">Pastikan email belum pernah didaftarkan.</div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" minlength="8"
                                    id="exampleInputPassword1">
                                <div id="exampleInputPassword1" class="form-text">Kosongkan jika tidak ingin mengganti password.
                                </div>
                            </div>
                            <div class="container">

                                <label class="form-label">Role</label>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-check">
                                            <input class="form-check-input" name="role" type="radio" value="1"
                                            @if ($item['role_is'] == 1)
                                                checked
                                            @endif
                                                 id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Manager
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-check">
                                            <input class="form-check-input" name="role" type="radio" value="2"
                                            @if ($item['role_is'] == 2)
                                            checked
                                        @endif  id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Kasir
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
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
    @endsection
    @section('modal')
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"> <i class="fas fa-plus"></i> Tambah Pengguna</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('setting_users.create') }}" method="post">
                            @csrf

                            <div class="mb-3">
                                <label for="exampleInputNama1" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="name" id="exampleInputNama1"
                                    aria-describedby="NamaHelp" required>

                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" required>
                                <div id="emailHelp" class="form-text">Pastikan email belum pernah didaftarkan.</div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" minlength="8"
                                    id="exampleInputPassword1" required>
                                <div id="exampleInputPassword1" class="form-text">Input password untuk akses masuk akun.
                                </div>
                            </div>
                            <div class="container">

                                <label class="form-label">Role</label>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-check">
                                            <input class="form-check-input" name="role" type="radio" value="1"
                                                 id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Manager
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-check">
                                            <input class="form-check-input" name="role" type="radio" value="2"
                                                checked  id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Kasir
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    @endsection
    @section('js')
        @if ($errors->has('email'))
            <script>
                $(document).ready(function() {
                    Swal.fire(
                        'Warning',
                        `Email sudah digunakan silahkan gunakan email lain.`,
                        `warning`
                    )
                });
            </script>
        @endif


        <script>
              function deleteTable(idval) {
                Swal.fire({
                    html: "Hapus user?",
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
                    var href = "{{route('setting_users.delete')}}?id=" + idval;
                    if (result.isConfirmed) {
                        $("#overlay").fadeIn();
                        window.location.href = href;
                    }
                });
            }
        </script>
    @endsection
