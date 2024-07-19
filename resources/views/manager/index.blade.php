@extends('layouts.apps')
@section('contents')
    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-md-12 col-lg-12">

                <div class="row row-cols-1">
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body"> 
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="bg-info text-white rounded p-3">
                                        <i class="fas fa-boxes"></i>
                                    </div>
                                    <div class="text-end">
                                       Jumlah Barang
                                        <h2 class="counter">{{ $totalBarang }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="bg-warning text-white rounded p-3">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="text-end">
                                       Total Pelanggan
                                        <h2 class="counter">{{ $pelanggan }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="bg-success text-white rounded p-3">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                    <div class="text-end">
                                        Jumlah User
                                        <h2 class="counter">{{ $jumlahuser }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="bg-success text-white rounded p-3">
                                        <i class="fas fa-people-carry"></i>
                                    </div>
                                    <div class="text-end">
                             
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
  
            {{-- <div id="d-main" class="d-main col-md-12 col-lg-8">
        <canvas id="transaksiChart"></canvas>
    </div> --}}

            <!-- 
                </div>
            </div>

        </div>
    </div>
    </div>
    </div>

@endsection


@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @include('manager.chart.dmain')
@endsection
