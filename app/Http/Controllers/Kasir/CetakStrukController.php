<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Detail_transaksi;
use App\Models\ProfileToko;
use Illuminate\Support\Facades\Auth;

class CetakStrukController extends Controller
{
   public function cetakstruk($id){
    $data['transaksi'] = Transaksi::where('no_transaksi', $id)->first();
    $data['detail'] = Detail_transaksi::where('transaksi_id',$data['transaksi']->id)->get();
    $data['user'] = AUTH::user();
   $data['profil'] = ProfileToko::find(1);

    // dd(session('user'));
    return view('kasir.transaksi.struk', $data);
   }


   public function show($id) {
    $data['transaksi'] = Transaksi::find($id);
    $data['detail'] = Detail_transaksi::where('transaksi_id', $data['transaksi']->id)->get();
    $data['user'] = Auth::user();
//    $data['profil'] = ProfileToko::find(1);


    $data['title'] = [
        'title' => 'Penjualan',
        'keterangan' => 'Selamat datang di aplikasi E Cashier'

    ];

    // dd( $data['detail']);

    return view('kasir.transaksi.detail', $data);
}
public function SuratJalan($id) {
    $data['transaksi'] = Transaksi::where('no_transaksi', $id)->first();
    $data['detail'] = Detail_transaksi::where('transaksi_id', $data['transaksi']->id)->get();
    $data['user'] = Auth::user();
    $data['profil'] = ProfileToko::find(1);
    // $data['nama_pelanggan'] = $nama;
    // $data['alamat'] = $alamat;
    // $data['no_hp'] = $no_hp;

    // dd( $data['nama_pelanggan'], $data['alamat'], $data['no_hp'], $data['transaksi'],$data['detail'],);

    $data['title'] = [
        'title' => 'Penjualan',
        'keterangan' => 'Selamat datang di aplikasi E Cashier'
    ];

    return view('kasir.transaksi.suratjalan', $data);
}
}
