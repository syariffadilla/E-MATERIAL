<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\DetailTransaksi;
use League\Csv\Writer;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Models\Transaksi;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransaksiExport;
use App\Models\Detail_transaksi;

class PenjualanManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['no'] = 1;
        $data['user'] = AUTH::user();
        $data['title'] = [
            'title' => 'History Pemakaian',
            'keterangan' => 'Di menu ini anda dapat melihat Pemakaian barang hari ini dan masa lampau'
        ];

        $data['awal'] = $request->input('awal');
        $data['akhir'] = $request->input('akhir');

        if ($data['awal'] && $data['akhir']) {
            $data['transaksi'] = Transaksi::whereBetween('tgl_transaksi', [$data['awal'], $data['akhir']])->get();
            $data['tanggal'] = date('d/m/Y', strtotime($data['awal'])) . ' - ' . date('d/m/Y', strtotime($data['akhir']));
        } else {
            $data['transaksi'] = Transaksi::whereDate('tgl_transaksi', Carbon::today())->get();
            $data['tanggal'] = date('d/m/Y');
        }
       
     
        // dd($data['transaksi'])

        return view('manager.penjualan.index', $data);
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

        $data['detailTransaksi'] = Detail_transaksi::join('data_barang', 'detail_transaksi.data_barang_id', '=', 'data_barang.id')
        ->where('detail_transaksi.transaksi_id', $data['transaksi']->id)
        ->select('detail_transaksi.*', 'data_barang.nama_barang')
        ->get();


        dd( $data['detailTransaksi'] );






        // Tampilkan tampilan detail dengan data transaksi dan detail transaksi
        return view('manager.penjualan.detail', $data);
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
// public function generatePDF2()
//     {
//         // $data[''] =


//         $data = [
//             'transaksi' => Transaksi::get()

//         ];

//         $pdf = PDF::loadView('manager.penjualan.pdf', $data);

//         return $pdf->download('penjualan.pdf');
//     }

public function generatePDF2(Request $request)
{
    // $data[''] =


    $data['awal'] = $request->input('awal');
    $data['akhir'] = $request->input('akhir');



    if ($data['awal'] && $data['akhir']) {
    $tanggal2 =  $data['awal'] . '/' . $data['akhir'];
    }else {
        $tanggal2 = date('d/m/Y');
    }


    if ($data['awal'] && $data['akhir']) {
        $data['transaksi'] = Transaksi::whereBetween('tgl_transaksi', [$data['awal'], $data['akhir']])->get();
        $data['tanggal'] = date('d/m/Y', strtotime($data['awal'])) . ' - ' . date('d/m/Y', strtotime($data['akhir']));
    } else {
        $data['transaksi'] = Transaksi::whereDate('tgl_transaksi', Carbon::today())->get();
        $data['tanggal'] = date('d/m/Y');
    }

    $pdf = PDF::loadView('manager.penjualan.pdf', $data);

    return $pdf->download('Laporan-Penjualan-'  . $tanggal2 . '.pdf');

}



}
