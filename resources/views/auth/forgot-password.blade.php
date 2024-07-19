



<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Toko Sumber Bangunan</title>

      <!-- Favicon -->
      <link rel="shortcut icon" href="{{ asset('assets2/images/favicon.ico') }}" />

      <!-- Library / Plugin Css Build -->
      <link rel="stylesheet" href="{{ asset('assets2/css/core/libs.min.css') }}" />


      <!-- Hope Ui Design System Css -->
      <link rel="stylesheet" href="{{ asset('assets2/css/hope-ui.min.css?v=2.0.0') }}" />

      <!-- Custom Css -->
      <link rel="stylesheet" href="{{ asset('assets2/css/custom.min.css?v=2.0.0') }}" />

      <!-- Dark Css -->
      <link rel="stylesheet" href="{{ asset('assets2/css/dark.min.css') }}"/>

      <!-- Customizer Css -->
      <link rel="stylesheet" href="{{ asset('assets2/css/customizer.min.css') }}" />

      <!-- RTL Css -->
      <link rel="stylesheet" href="{{ asset('assets2/css/rtl.min.css') }}"/>


  </head>
  <body class=" " data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">


      <div class="wrapper">
      <section class="login-content">
         <div class="row m-0 align-items-center bg-white vh-100">
            <div class="col-md-6 d-md-block d-none bg-primary p-0 mt-n1 vh-100 overflow-hidden">
               <img src="{{ asset('assets2/images/auth/02.png') }}" class="img-fluid gradient-main animated-scaleX" alt="images">
            </div>
            <div class="col-md-6 p-0">
               <div class="card card-transparent auth-card shadow-none d-flex justify-content-center mb-0">
                  <div class="card-body">
                     <a href="{{ asset('dashboard/index.html') }}" class="navbar-brand d-flex align-items-center mb-3">
                        <!--Logo start-->
                        <!--logo End-->

                        <!--Logo start-->
                        <div class="logo-main">
                            <div class="logo-normal">
                                <svg class="text-primary icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"/>
                                    <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor"/>
                                    <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor"/>
                                    <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor"/>
                                </svg>
                            </div>
                            <div class="logo-mini">
                                <svg class="text-primary icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"/>
                                    <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor"/>
                                    <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor"/>
                                    <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor"/>
                                </svg>
                            </div>
                        </div>
                        <!--logo End-->




                        <h4 class="logo-title ms-3">Toko Sumber Bangunan</h4>
                     </a>
                     <h2 class="mb-2">Reset Password</h2>
                     <p>Enter your email address and we'll send you an email with instructions to reset your password.</p>
                     <div class="row">
                         <div class="col-lg-12">
                             <div class="floating-label form-group">
                                 <form action="{{ route('password.email') }}" method="post">
                                    @csrf
                                    @method('post')
                                 <label for="email" class="form-label">Email</label>
                                 <input type="email" class="form-control" name="email" id="exampleFormControlInput1"
                                 placeholder="name@example.com">
                                </div>
                                {{-- <a class="text-end" href="{{ route('based') }}">Back To Login</a> --}}
                           </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Request Link Password</button> |
                    </form>
                    <a href="{{ route('based') }}">Back To Login</a>
                  </div>
               </div>
               <div class="sign-bg sign-bg-right">
                  <svg width="280" height="230" viewBox="0 0 431 398" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <g opacity="0.05">
                     <rect x="-157.085" y="193.773" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 -157.085 193.773)" fill="#3B8AFF"/>
                     <rect x="7.46875" y="358.327" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 7.46875 358.327)" fill="#3B8AFF"/>
                     <rect x="61.9355" y="138.545" width="310.286" height="77.5714" rx="38.7857" transform="rotate(45 61.9355 138.545)" fill="#3B8AFF"/>
                     <rect x="62.3154" y="-190.173" width="543" height="77.5714" rx="38.7857" transform="rotate(45 62.3154 -190.173)" fill="#3B8AFF"/>
                     </g>
                  </svg>
               </div>
            </div>
         </div>
      </section>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
      </script>
      @include('layouts.swallalert')


      <!--- Bagian lain pada file Anda --->

      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

      <script>
          @if (session('success'))
              Swal.fire({
                  icon: 'success',
                  title: 'Email Terkirim',
                  text: '{{ session('success') }}',
                  // showConfirmButton: true,
                  timer:5000
              });
          @elseif (session('error'))
              Swal.fire({
                  icon: 'error',
                  title: 'Email Tidak Ditemukan',
                  text: '{{ session('error') }}',
                  showConfirmButton: false,
                  timer: 2000
              });
          @endif
      </script>

    <!-- Library Bundle Script -->
    <script src="{{ asset('assets2/js/core/libs.min.js') }}"></script>

    <!-- External Library Bundle Script -->
    <script src="{{ asset('assets2/js/core/external.min.js') }}"></script>

    <!-- Widgetchart Script -->
    {{-- <script src="{{ asset('') }}assets2/js/charts/widgetcharts.js"></script> --}}

    <!-- mapchart Script -->
    {{-- <script src="{{ asset('') }}assets2/js/charts/vectore-chart.js"></script>
    <script src="{{ asset('') }}assets2/js/charts/dashboard.js" ></script> --}}

    <!-- fslightbox Script -->
    {{-- <script src="{{ asset('') }}assets2/js/plugins/fslightbox.js"></script> --}}

    {{-- <!-- Settings Script --> --}}
    {{-- <script src="{{ asset('') }}assets2/js/plugins/setting.js"></script> --}}

    <!-- Slider-tab Script -->
    {{-- <script src="{{ asset('') }}assets2/js/plugins/slider-tabs.js"></script> --}}

    <!-- Form Wizard Script -->
    {{-- <script src="{{ asset('') }}assets2/js/plugins/form-wizard.js"></script> --}}

    <!-- AOS Animation Plugin-->

    <!-- App Script -->
    <script src="{{ asset('assets2/js/hope-ui.js') }}" defer></script>

  </body>
</html>


