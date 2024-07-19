<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>E-Material</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets2/images/favicon.ico') }}" />

    <!-- Library / Plugin Css Build -->
    <link rel="stylesheet" href="{{ asset('assets2/css/core/libs.min.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">


    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css"
        integrity="sha512-rqQltXRuHxtPWhktpAZxLHUVJ3Eombn3hvk9PHjV/N5DMUYnzKPC1i3ub0mEXgFzsaZNeJcoE0YHq0j/GFsdGg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" />

    <!-- Aos Animation Css -->
    <link rel="stylesheet" href="{{ asset('assets2/vendor/aos/dist/aos.css') }}" />

    <!-- Hope Ui Design System Css -->
    <link rel="stylesheet" href="{{ asset('assets2/css/hope-ui.min.css?v=2.0.0') }}" />

    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('assets2/css/custom.min.css?v=2.0.0') }}" />

    <!-- Dark Css -->
    <link rel="stylesheet" href="{{ asset('assets2/css/dark.min.css') }}" />

    <!-- Customizer Css -->
    <link rel="stylesheet" href="{{ asset('assets2/css/customizer.min.css') }}" />

    <!-- RTL Css -->


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets2/css/rtl.min.css') }}" />
    <style>
        #overlay {
            position: fixed;
            top: 0;
            z-index: 2000;
            width: 100%;
            height: 100%;
            display: none;
            background: rgba(0, 0, 0, 0.6);
        }

        .cv-spinner {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px #ddd solid;
            border-top: 4px #2e93e6 solid;
            border-radius: 50%;
            animation: sp-anime 0.8s infinite linear;
        }

        @keyframes sp-anime {
            100% {
                transform: rotate(360deg);
            }
        }

        .is-hide {
            display: none;
        }
    </style>
    @yield('css')


    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="{{ asset('img/SumberBangunan.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
</head>

<body class="  ">


    <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>


    @include('layouts.aside')
    <main class="main-content">

        @include('layouts.navs')

        @yield('contents')

        <!-- Footer Section Start -->

        <!-- Footer Section End -->
    </main>
    <footer class="footer">
        <div class="footer-body">
            <ul class="left-panel list-inline mb-0 p-0">
                <li class="list-inline-item"><a href="{{ asset('dashboard/extra/privacy-policy.html') }}">Privacy
                        Policy</a>
                </li>
                <li class="list-inline-item')}}<a href="{{ asset('dashboard/extra/terms-of-service.html') }}">Terms of
                    Use</a>
                </li>
            </ul>
            <div class="right-panel">
                ©
                <script>
                    document.write(new Date().getFullYear())
                </script> E Kasir, Made with
                <span class="">
                    <svg class="icon-15" width="15" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M15.85 2.50065C16.481 2.50065 17.111 2.58965 17.71 2.79065C21.401 3.99065 22.731 8.04065 21.62 11.5806C20.99 13.3896 19.96 15.0406 18.611 16.3896C16.68 18.2596 14.561 19.9196 12.28 21.3496L12.03 21.5006L11.77 21.3396C9.48102 19.9196 7.35002 18.2596 5.40102 16.3796C4.06102 15.0306 3.03002 13.3896 2.39002 11.5806C1.26002 8.04065 2.59002 3.99065 6.32102 2.76965C6.61102 2.66965 6.91002 2.59965 7.21002 2.56065H7.33002C7.61102 2.51965 7.89002 2.50065 8.17002 2.50065H8.28002C8.91002 2.51965 9.52002 2.62965 10.111 2.83065H10.17C10.21 2.84965 10.24 2.87065 10.26 2.88965C10.481 2.96065 10.69 3.04065 10.89 3.15065L11.27 3.32065C11.3618 3.36962 11.4649 3.44445 11.554 3.50912C11.6104 3.55009 11.6612 3.58699 11.7 3.61065C11.7163 3.62028 11.7329 3.62996 11.7496 3.63972C11.8354 3.68977 11.9247 3.74191 12 3.79965C13.111 2.95065 14.46 2.49065 15.85 2.50065ZM18.51 9.70065C18.92 9.68965 19.27 9.36065 19.3 8.93965V8.82065C19.33 7.41965 18.481 6.15065 17.19 5.66065C16.78 5.51965 16.33 5.74065 16.18 6.16065C16.04 6.58065 16.26 7.04065 16.68 7.18965C17.321 7.42965 17.75 8.06065 17.75 8.75965V8.79065C17.731 9.01965 17.8 9.24065 17.94 9.41065C18.08 9.58065 18.29 9.67965 18.51 9.70065Z"
                            fill="currentColor"></path>
                    </svg>
                </span> by <a href="https://iqonic.design/">X Mood</a>.
            </div>
        </div>
    </footer>
    @include('layouts.settingsTheme')

    @yield('modal')


    <script src="../assets2/js/plugins/fslightbox.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Library Bundle Script -->
    <script src="{{ asset('assets2/js/core/libs.min.js') }}"></script>

    <!-- External Library Bundle Script -->
    <script src="{{ asset('assets2/js/core/external.min.js') }}"></script>

    <!-- Widgetchart Script -->
    <script src="{{ asset('assets2/js/charts/widgetcharts.js') }}"></script>

    <!-- mapchart Script -->
    <script src="{{ asset('assets2/js/charts/vectore-chart.js') }}"></script>
    <script src="{{ asset('assets2/js/charts/dashboard.js') }}"></script>

    <!-- fslightbox Script -->

    <!-- Settings Script -->
    <script src="{{ asset('assets2/js/plugins/setting.js') }}"></script>

    <!-- Slider-tab Script -->
    <script src="{{ asset('assets2/js/plugins/slider-tabs.js') }}"></script>

    <!-- Form Wizard Script -->
    <script src="{{ asset('assets2/js/plugins/form-wizard.js') }}"></script>

    <!-- AOS Animation Plugin-->
    <script src="{{ asset('assets2/vendor/aos/dist/aos.js') }}"></script>

    <!-- App Script -->
    <script src="{{ asset('assets2/js/hope-ui.js') }}" defer></script>


    {{-- pwa --}}
    <script src="{{ asset('/sw.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>  
    <script>
        if (!navigator.serviceWorker.controller) {
            navigator.serviceWorker.register("/sw.js").then(function(reg) {
                console.log("Service worker has been registered for scope: " + reg.scope);
            });
        }
    </script>


    <script>
        function cek_loader() {
            // alert('ok');
            $("#overlay").fadeIn();
        }
    </script>
    @yield('js')
    @include('layouts.swallalert')
</body>

</html>
