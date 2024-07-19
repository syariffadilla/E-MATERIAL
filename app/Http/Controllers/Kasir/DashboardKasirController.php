<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\PoinPelanggan;
use App\Models\Detail_transaksi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransaksiExport;


class DashboardKasirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data['user'] = AUTH::user();
        $data['transaksi'] = DB::table('transaksi')
        ->whereDate('tgl_transaksi', Carbon::today())
        ->orderBy('no_transaksi', 'desc') 
        ->paginate(10);
    
                            $data['no'] = 1;
        $data['title'] = [
            'title' => 'Penjualan',
            'keterangan' => 'Selamat datang di aplikasi E Cashier'

        ];


        return view('kasir.dashboard.index', $data);
    }
    public function Pelanggan()
    {
        $data['point'] = PoinPelanggan::all();
        $data['user'] = AUTH::user();
        $data['title'] = [
            'title' => 'Pelanggan',
            'keterangan' => 'Di menu ini anda dapat melihat dan mereset total pelanggan membeli.'
        ];
        // var_dump();
        // Die;
        return view('pelanggan.index', $data);

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
    public function show(Request $request)
    {
        $noTransaksi = $request->input('noTransaksi');
        $data['user'] = Auth::user();
        $data['title'] = [
            'title' => 'Detail Penjualan',
            'keterangan' => 'Detail Penjualan'
        ];

        // Ambil data transaksi berdasarkan nomor transaksi
        $data['transaksi'] = Transaksi::where('no_transaksi', $noTransaksi)->first();



        // var_dump($dataw);
        // die;

        // Cek apakah data transaksi ditemukan
        if (!$data['transaksi']) {
            // Tampilkan pesan error atau redirect ke halaman lain
            // Misalnya:
            $request->session()->flash('color', 'warning');
            $request->session()->flash('status', 'Penjualan Tidak Di Temukan!');
            return redirect()->back();
        }

        $data['detail'] = Detail_transaksi::join('data_barang', 'detail_transaksi.data_barang_id', '=', 'data_barang.id')
        ->where('detail_transaksi.transaksi_id', $data['transaksi']->id)
        ->select('detail_transaksi.*', 'data_barang.nama_barang')
        ->get();

        // Tampilkan tampilan detail dengan data transaksi dan detail transaksi
        return view('kasir.transaksi.detail', $data);
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
    public function deleteData($id)
    {
        // Lakukan logika penghapusan data sesuai dengan kebutuhan aplikasi Anda
        // Contoh:
        $data = Transaksi::find($id);
        if ($data) {
            $data->delete();
            return response()->json(['message' => 'Data berhasil dihapus'], 200);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }


    public function exportExcel(Request $request)
{
    $awal = $request->input('awal');
    $akhir = $request->input('akhir');
    // Logika export Excel berdasarkan data yang sesuai dengan tanggal
    $tanggal = $awal . '-' . $akhir;
    return Excel::download(new TransaksiExport($awal, $akhir), 'Laporan-Penjualan-' . $tanggal . '.xlsx');
}
}
