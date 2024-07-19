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
    <div class="container-fluid content-inner mt-n5 py-0">
        <div class="card">
            {{-- <div class="card-header">
          Quote
        </div> --}}
            <form action="{{route('profile_toko.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="text-center">

                                <img src="{{ asset('logo/'. $profile->logo) }}" id="imagePreview" alt="trash"
                                width="50%">
                            </div>
                            <div class="mt-3 text-center">
                                <label class="form-label" for="imageInput">Upload Logo Disini</label>
                                <input type="file" id="imageInput" name="logo" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama Toko</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    name="nama_toko" value="{{$profile->nama_toko}}">

                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">No Telepon</label>
                                <input type="nohp" class="form-control" id="exampleInputEmail1"
                                    name="telp" value="{{$profile->telp}}">

                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Alamat Toko</label>

                                <textarea class="form-control" name="alamat" placeholder="Alamat Toko" id="floatingTextarea2" style="height: 100px">{{$profile->alamat}}</textarea>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary" id="save">Simpan</button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('#save').on('click', function(){
            $("#overlay").fadeIn();
        });
        // Get the input element and image preview element
        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');

        // Add an event listener to the input element
        imageInput.addEventListener('change', function(event) {
            // Check if any file is selected
            if (event.target.files && event.target.files[0]) {
                // Get the selected file
                const file = event.target.files[0];

                // Check if the selected file is an image
                if (file.type.match('image.*')) {
                    // Create a FileReader object
                    const reader = new FileReader();

                    // Set a callback function when FileReader has finished reading the file
                    reader.onload = function(e) {
                        // Set the source of the image preview to the read data
                        imagePreview.src = e.target.result;
                    };

                    // Read the selected file as a Data URL
                    reader.readAsDataURL(file);
                } else {
                    // Display an error message for non-image files
                    // alert('Please select an/ image file.');
                    Swal.fire({
                        icon: 'error',
                        title: 'Peringatan',
                        text: 'Upload file gambar jpg/jpeg/png',
                        // showConfirmButton: true,
                        // timer: 5000
                    });
                    // Clear the input field
                    imageInput.value = '';
                    // Reset the image preview source
                    imagePreview.src = '{{ asset("logo/". $profile->logo) }}';
                }
            }
        });
    </script>
@endsection
