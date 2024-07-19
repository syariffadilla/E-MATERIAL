<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Transaksi;
use App\Models\Kategori;
use App\Models\ProfileToko;
use App\Models\User;
use App\Models\Detail_transaksi;
use App\Models\PoinPelanggan;
use App\Models\Suplier;
use Illuminate\Support\Facades\Auth;

class DashboardManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $data['title'] = [
            'title' => 'Beranda',
            'keterangan' => 'Selamat datang di aplikasi E Cashier Version 1.1.0'
        ];

        $data['user'] = Auth::user();
        $data['jumlahuser'] = User::where('role_is', 2)->count();
        // $data['jumlahKategori'] = Kategori::all()->count();
        $data['jumlahSupplier'] = Suplier::all()->count();
        // @dd($data['jumlahSupplier']);

        //mengambil data pelanggan
        $data['pelanggan'] = PoinPelanggan::all()->count();
        $data['totalBarang'] = Barang::where('is_active', 1)->count();
        // @dd($data['totalBarang']);

        
        // // Menghitung total transaksi per bulan
        // $tanggalAwal = Carbon::now()->startOfMonth();
        // $tanggalAkhir = Carbon::now()->endOfMonth();
        // $data['totalTransaksiBulan'] = Transaksi::whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])->sum('total_transaksi') ?? 0;
        // $data['transaksiCountBulan'] = Transaksi::whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])->count();

        // // Menghitung total transaksi per tahun
        // $tahunIni = Carbon::now()->year;
        // $tanggalAwalTahun = Carbon::create($tahunIni, 1, 1)->startOfYear();
        // $tanggalAkhirTahun = Carbon::create($tahunIni, 12, 31)->endOfYear();
        // $data['totalTransaksiTahun'] = Transaksi::whereBetween('created_at', [$tanggalAwalTahun, $tanggalAkhirTahun])->sum('total_transaksi') ?? 0;
        // $data['transaksiCountTahun'] = Transaksi::whereBetween('created_at', [$tanggalAwalTahun, $tanggalAkhirTahun])->count();

        // // Mengambil harga modal per hari
        // // $tanggalHariIni = Carbon::today();
        // // $data['hargaModalHari'] = Detail_transaksi::whereDate('created_at', $tanggalHariIni)->sum('harga_modal');

        // // Mengambil harga modal per bulan
        // $tanggalAwalBulan = Carbon::now()->startOfMonth();
        // $tanggalAkhirBulan = Carbon::now()->endOfMonth();
        // $data['hargaModalBulan'] = Detail_transaksi::whereBetween('created_at', [$tanggalAwalBulan, $tanggalAkhirBulan])->sum('harga_modal');

        // // Mengambil harga modal per tahun
        // $tahunIni = Carbon::now()->year;
        // $tanggalAwalTahun = Carbon::create($tahunIni, 1, 1)->startOfYear();
        // $tanggalAkhirTahun = Carbon::create($tahunIni, 12, 31)->endOfYear();
        // $data['hargaModalTahun'] = Detail_transaksi::whereBetween('created_at', [$tanggalAwalTahun, $tanggalAkhirTahun])->sum('harga_modal');

        // // Mengambil harga modal hari kemarin
        // $tanggalKemarin = Carbon::yesterday();
        // $data['hargaModalHariKemarin'] = Detail_transaksi::whereDate('created_at', $tanggalKemarin)->sum('harga_modal');

        // // Mengambil harga modal bulan kemarin
        // $tanggalAwalBulanKemarin = Carbon::now()->subMonth()->startOfMonth();
        // $tanggalAkhirBulanKemarin = Carbon::now()->subMonth()->endOfMonth();
        // $data['hargaModalBulanKemarin'] = Detail_transaksi::whereBetween('created_at', [$tanggalAwalBulanKemarin, $tanggalAkhirBulanKemarin])->sum('harga_modal');

        // // Mengambil harga modal tahun kemarin
        // $tahunKemarin = Carbon::now()->subYear()->year;
        // $tanggalAwalTahunKemarin = Carbon::create($tahunKemarin, 1, 1)->startOfYear();
        // $tanggalAkhirTahunKemarin = Carbon::create($tahunKemarin, 12, 31)->endOfYear();
        // $data['hargaModalTahunKemarin'] = Detail_transaksi::whereBetween('created_at', [$tanggalAwalTahunKemarin, $tanggalAkhirTahunKemarin])->sum('harga_modal');


        // //menghitung keuntungan
        // $data['keuntunganHariIni'] = $data['totalTransaksi'] - $data['hargaModalHari'];
        // $data['keuntunganBulanIni'] = $data['totalTransaksiBulan'] - $data['hargaModalBulan'];
        // $data['keuntunganTahunIni'] = $data['totalTransaksiTahun'] - $data['hargaModalTahun'];

        // // Mengambil data harga modal per bulan
        // $data['hargaModalBulanChart'] = Detail_transaksi::selectRaw('DATE_FORMAT(created_at, "%b") AS bulan, SUM(harga_modal) AS total_harga_modal')
        //     ->groupBy('bulan')
        //     ->get();

        // // Menginisialisasi array untuk categories (key) dan data (value)
        // $categories = [];
        // $dataHargaModal = [];
        // $dataModal = [];

        // // Mengisi array categories, dataHargaModal, dan dataModal
        // foreach ($data['hargaModalBulanChart'] as $item) {
        //     $categories[] = $item->bulan;
        //     $dataHargaModal[] = $item->total_harga_modal;
        //     $dataModal[] = $item->total_harga_modal - $data['keuntunganBulanIni'];
        // }

        // // Membuat array untuk digunakan pada chart
        // $chartDataModal = [
        //     'categories' => $categories,
        //     'dataHargaModal' => $dataHargaModal,
        //     'dataKeuntungan' => $dataModal,
        // ];

        // Mengirimkan data chart modal dan categories ke view
        // $data['chartDataModal'] = $chartDataModal;
        // $data['categories'] = $categories;


        return view('manager.index', $data);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
