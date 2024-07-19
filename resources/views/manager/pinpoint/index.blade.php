@extends('layouts.apps')
@section('contents')
    <div class="conatiner-fluid content-inner mt-n5 py-0">

        <div class="row">
            <div class="col-md-12">
                <div id="map"></div>
                <div class="text-center">

                    <button class="mt-3 btn btn-primary" onclick="getPinLocation()">Terapkan Lokasi</button>
                    <button class="mt-3 btn btn-success" onclick="handlePosition()">Terapkan Lokasi Saat Ini</button>
                </div>
            </div>
        </div>
    @endsection
    @section('js')
        <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>

        <script>
            function getPosition() {
                return new Promise((resolve, reject) => {
                    navigator.geolocation.getCurrentPosition(resolve, reject);
                });
            }

            async function handlePosition() {
                $("#overlay").fadeIn();
                try {
                    const position = await getPosition();
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    $("#overlay").fadeOut();
                    const result = await Swal.fire({
                        html: "Terapkan Lokasi?",
                        icon: "info",
                        buttonsStyling: false,
                        showCancelButton: true,
                        confirmButtonText: "Ok",
                        cancelButtonText: 'Batal',
                        customClass: {
                            confirmButton: "btn btn-primary me-3",
                            cancelButton: 'btn btn-danger'
                        }
                    });

                    if (result.isConfirmed) {
                        const href = "{{ route('pinpoint.create') }}?lat=" + lat + "&lng=" + lng;
                        $("#overlay").fadeOut();
                        window.location.href = href;
                    }
                } catch (error) {
                    $("#overlay").fadeOut();
                    console.error(error);
                    // Handle error here
                }
            }

            var map;
            var marker;

            // Inisialisasi peta
            function initMap() {
                var initialLocation = L.latLng("{{ $pinPoint->lat }}", "{{ $pinPoint->lng }}"); // Koordinat lokasi awal
                map = L.map('map').setView(initialLocation, 10);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);
                marker = L.marker(initialLocation, {
                    draggable: true
                }).addTo(map);
            }
            initMap();

            // Mendapatkan lokasi pin saat tombol diklik
            function getPinLocation() {
                var pinLocation = marker.getLatLng();
                var lat = pinLocation.lat.toFixed(6);
                var lng = pinLocation.lng.toFixed(6);
                Swal.fire({
                    html: "Terapkan Lokasi?",
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
                    var href = "{{ route('pinpoint.create') }}?lat=" + lat + "&lng=" + lng;
                    if (result.isConfirmed) {
                        $("#overlay").fadeIn();
                        window.location.href = href;
                    }
                });
            }
        </script>
    @endsection


    @section('css')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
        <style>
            #map {
                width: 100%;
                height: 500px;
            }
        </style>
    @endsection
