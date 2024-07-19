<!DOCTYPE html>
<html lang="en">

<head>
    <title>E-Material</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('logo/'. $profile->logo) }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/animate/animate.css') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/css-hamburgers/hamburgers.min.css') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/select2/select2.min.css') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/util.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css') }}" />
    <!--===============================================================================================-->
    <style>
        .password-toggle {
            position: relative;
        }

        .password-toggle .toggle-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
     <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .h-custom {
            height: calc(100% - 73px);
        }

        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }
    </style>
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
</head>

<body>
    <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="{{ asset('logo/'. $profile->logo) }}" alt="IMG" />
                </div>
                
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    @method('post')
                    <span class="login100-form-title">Welcome To E Si-LCA</span>

                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="email" placeholder="Email" />
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password"  name="password" placeholder="Password" id="password" />

                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                        <input type="hidden" name="jarak" id="jarak">

                    </div>
                    <div class="text-right mr-3">
                        <label for="togglePassword" class="toggle-icon">
                            Lihat Password
                        </label>
                        <input class="toggle-checkbox" type="checkbox" id="togglePassword" />
                    </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">Login</button>
                    </div>

                    <div class="text-center p-t-12">
                        <span class="txt1"> Forgot </span>
                        <a class="txt2" href="{{ route('password.request') }}"> Username / Password? </a>
                    </div>

                    <div class="text-center p-t-136">
                        <!-- <a class="txt2" href="#">
                Create your Account
                <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
              </a> -->
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--===============================================================================================-->
    <script src="{{ asset('assets/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets/vendor/select2/select2.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets/vendor/tilt/tilt.jquery.min.js') }}"></script>
    <script>
        $(".js-tilt").tilt({
            scale: 1.1,
        });

        $(document).ready(function() {
            $("#togglePassword").on("change", function() {
                var passwordField = $("#password");
                var passwordFieldType = passwordField.attr("type");

                if ($(this).is(":checked")) {
                    passwordField.attr("type", "text");
                } else {
                    passwordField.attr("type", "password");
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @include('layouts.swallalert')
    <script>
        function fadeInOverlay() {
            var overlay = document.getElementById('overlay');
            overlay.style.display = 'block';
            overlay.style.opacity = '0';

            var opacity = 0;
            var interval = setInterval(function() {
                opacity += 0.1;
                overlay.style.opacity = opacity;
                if (opacity >= 1) {
                    clearInterval(interval);
                }
            }, 30);
        }

        function fadeOutOverlay() {
            var overlay = document.getElementById('overlay');

            var opacity = 1;
            var interval = setInterval(function() {
                opacity -= 0.1;
                overlay.style.opacity = opacity;
                if (opacity <= 0) {
                    clearInterval(interval);
                    overlay.style.display = 'none';
                }
            }, 30);
        }
    </script>
    <script>
        function calculateDistance(lat1, lng1, lat2, lng2) {
            const earthRadius = 6371; // Radius bumi dalam kilometer
            const toRadians = (degrees) => degrees * (Math.PI / 180);

            const latDiff = toRadians(lat2 - lat1);
            const lngDiff = toRadians(lng2 - lng1);

            const a =
                Math.sin(latDiff / 2) * Math.sin(latDiff / 2) +
                Math.cos(toRadians(lat1)) * Math.cos(toRadians(lat2)) *
                Math.sin(lngDiff / 2) * Math.sin(lngDiff / 2);

            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

            const distance = earthRadius * c * 1000; // Mengonversi ke meter

            return distance.toFixed(2);
        }

        function getCurrentLocation() {

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const lat1 = position.coords.latitude; // Latitude perangkat
                        const lng1 = position.coords.longitude; // Longitude perangkat

                        // Koordinat titik lain
                        const lat2 = "{{ $pin->lat }}"; // Latitude titik 2
                        const lng2 = "{{ $pin->lng }}"; // Longitude titik 2

                        const distance = calculateDistance(lat1, lng1, lat2, lng2);
                        // alert('Jarak antara perangkat dan titik: ' + distance + ' meter');
                        document.getElementById('jarak').value = distance;
                        fadeOutOverlay();
                    },
                    function(error) {
                        alert('Gagal mendapatkan lokasi: ' + error.message);
                        fadeOutOverlay();
                    }
                );
            } else {
                alert('Geolocation tidak didukung oleh browser.');
                fadeOutOverlay();
            }
        }

        // Panggil fungsi untuk mendapatkan lokasi saat halaman web dimuat
        document.addEventListener('DOMContentLoaded', function() {
            fadeInOverlay();
            getCurrentLocation();
        });
    </script>
</body>

</html>
