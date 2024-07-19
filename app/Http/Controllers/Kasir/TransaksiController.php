<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Barang;
use App\Models\Detail_transaksi;
use App\Models\Transaksi;
use App\Models\Pelanggan;
use DateTime;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */


            public function index()
        {
            $data['title'] = [
                'title' => 'Pemakaian',
                'keterangan' => 'Pastikan Pemakaian Dilakukan Dengan Benar !!'
            ];
            $data['user'] = Auth::user();
            $data['transaksi'] = Transaksi::whereDate('tgl_transaksi', date('Y-m-d'))->get();
            $data['barang'] = Barang::with('kategori')->get();
            $pelanggan = Pelanggan::select('pelanggan')->get();
            $nama_pelanggan = [];

            foreach ($pelanggan as $key => $value) {
                $nama_pelanggan[$key] = $value->pelanggan;
            }

            $data['pelanggan'] = json_encode($nama_pelanggan);

            return view('kasir.transaksi.index', $data);
        }


        public function savetransaksi(Request $request)
        {
            DB::beginTransaction();
        
            try {
                $invoice = $request->input('invoice');
                $tanggal_beli = $request->input('tanggal_beli');
        
                $nama_barang = $request->input('nama_barang');
                $stok_barang = $request->input('stok_barang');
                $barang_id = $request->input('barang_id');
                $jumlah_barang = $request->input('jumlah_barang');
                $sisaStok = $request->input('sisaStok'); // Pastikan nama variabel sesuai dengan input
        
                $intruksi = $request->input('intruksi');
                $user = Auth::user();
        
                $idtrx = time();
        
                $transaksi = Transaksi::create([
                    'id' => $idtrx,
                    'no_transaksi' => $invoice,
                    'kasir' => $user->name,
                    'tgl_transaksi' => $tanggal_beli,
                ]);
        
                foreach ($nama_barang as $index => $nama) {
                    $detailTransaksi = new Detail_transaksi();
                    $detailTransaksi->transaksi_id = $transaksi->id;
                    $detailTransaksi->data_barang_id = $barang_id[$index];
                    $detailTransaksi->nama_barang = $nama;
                    $detailTransaksi->stok_barang = $stok_barang[$index];
                    $detailTransaksi->jumlah_barang = (float)$jumlah_barang[$index];
                    $detailTransaksi->sisaStok = $sisaStok[$index];
                    $detailTransaksi->save();
                }
        
                foreach ($jumlah_barang as $index => $jumlah) {
                    $barang = Barang::find($barang_id[$index]);
                    if ($barang) {
                        $barang->stok -= (float)$jumlah;
                        $barang->save();
                    }
                }
        
                DB::commit();
        
                if ($intruksi === 'save') {
                    Session::flash('status', 'Penjualan berhasil disimpan');
                    Session::flash('color', 'success');
                    return redirect()->back();
                } else if ($intruksi === 'print') {
                    return redirect()->route('cetakstruk', ['id' => $invoice]);
                } else if ($intruksi === 'cetakSuratJalan') {
                    // Parameter $nama_pelanggan, $alamat, $no_hp tidak ada di request
                    return redirect()->route('cetakSuratJalan', [
                        'id' => $invoice,
                        'nama' => 'Nama Pelanggan',
                        'alamat' => 'Alamat',
                        'no_hp' => 'No HP'
                    ]);
                }
        
            } catch (\Exception $e) {
                DB::rollback();
                Session::flash('status', 'Terjadi kesalahan. Penjualan gagal disimpan.');
                Session::flash('color', 'error');
                return redirect()->back();
            }
        }
        
        // public function savetransaksi(Request $request){

        //     @dd($request);
        //     try {

        //     $invoice = $request->input('invoice');
        //     $tanggal_beli = $request->input('tanggal_beli');

        //     $nama_barang = $request->input('nama_barang');
        //     $stok = $request->input('stok');
        //     $barang_id = $request->input('barang_id');
        //     $stok_barang = $request->input('stok_barang');
        //     $jumlah_barang = $request->input('jumlah_barang');
        //     $total_barang = $request->input('total_barang');
        //     $intruksi = $request->input('intruksi');
        //     $kembalian = str_replace(["Rp", " ", "."], "", $request->input('kembalian'));

        //     $user = Auth::user();
            

        //     $idtrx = time();

        //     $transaksi = Transaksi::create([
        //         'id' => $idtrx,
        //         'no_transaksi' => $invoice,
        //         // 'pelanggan' => $nama_pelanggan,
        //         // 'alamat' => $alamat,
        //         // 'no_hp' => $no_hp,
        //         'kasir' => $user->name,
        //         'tgl_transaksi' => $user,
              
        //     ]);

        //     foreach ($nama_barang as $index => $nama) {
        //         $detailTransaksi = new Detail_transaksi();
        //         $detailTransaksi->transaksi_id = $transaksi->id;
        //         $detailTransaksi->data_barang_id = $barang_id[$index];
        //         $detailTransaksi->nama_barang = $nama;
        //         $detailTransaksi->stok_barang = $stok_barang[$index]; // Add this if you want to save the initial stock
        //         $detailTransaksi->jumlah = (float)$jumlah_barang[$index]; // Cast to float for the quantity
        //         $detailTransaksi->sisa_stok = $sisaStok[$index]; // Add this line to save the remaining stock
        //         $detailTransaksi->save();
        //     }
            


        //     foreach ($jumlah_barang as $index => $jumlah) {
        //         $barang = Barang::find($barang_id[$index]);
        //         if ($barang) {
        //             $barang->stok -= (float)$jumlah;
        //             $barang->save();
        //         }
        //     }


        //         if ($intruksi === 'save') {
        //             // Set session untuk SweetAlert
        //             Session::flash('status', 'Penjualan berhasil disimpan');
        //             Session::flash('color', 'success');
        //             return redirect()->back();
        //         } else if ($intruksi === 'print') {
        //             $id = $invoice;
        //             return redirect()->route('cetakstruk', ['id' => $id]);
        //         } else if ($intruksi === 'cetakSuratJalan') {
        //             return redirect()->route('cetakSuratJalan', [
        //                 'id' => $invoice,
        //                 'nama' => $nama_pelanggan,
        //                 'alamat' => $alamat,
        //                 'no_hp' => $no_hp
        //             ]);

        //         }

        //     } catch (\Exception $e) {
        //         // Rollback transaksi jika terjadi kesalahan
        //         DB::rollback();

        //         // Set session untuk SweetAlert dengan pesan kesalahan
        //         Session::flash('status', 'Terjadi kesalahan. Penjualan gagal disimpan.');
        //         Session::flash('color', 'error');
        //         return redirect()->back();
        //     }
        // }


            // Autocomplete
            public function autocomplete(Request $request)
                {
                        $data = Barang::join('kategori_barang', 'data_barang.kategori_barang_id', '=', 'kategori_barang.id')
                        ->join('sub_kategori', 'data_barang.sub_kategori_id', '=', 'sub_kategori.id')
                            ->select('data_barang.*', 'kategori_barang.nama_kategori')
                            ->where('nama_barang', 'LIKE', '%' . $request->search . '%')
                            ->where('kategori_barang.is_active', 1)
                            ->where('sub_kategori.is_active', 1)
                            ->get();
                    if ($request->search == "") {
                        $data = [];
                    }
                    return response()->json($data);
                }

                public function autocompletePelanggan(Request $request)
                {
                    $search = $request->input('search');

                    $data = Pelanggan::where('pelanggan', 'LIKE', '%' . $search . '%')
                        ->select('pelanggan', 'nomor_telepon', 'alamat')
                        ->get();

                    if ($search == "") {
                        $data = [];
                    }

                    return response()->json($data);
                }


            public function tambahButtonBarang(Request $request)
            {
                $barang = Barang::find($request->id);

                return response()->json([
                    'id' => $barang->id,
                    'nama_barang' => $barang->nama_barang,
                    // 'harga' => $barang->harga_barang,
                    // 'hargaModal' => $barang->harga_modal,
                    // 'disc' => $barang->disc,
                    'stok' => $barang->stok,
                    'kategori_satuan' => $barang->kategori_satuan
                ]);
            }

            public function store(Request $request)
            {
            $user = Auth::user();
            $date = new DateTime();
            $tanggalIndonesia = $date->format('Y-m-d');

            $transaksiData = $request->input('transaksiData');
            $invoice = $request->input('invoice');
            $pelanggan = $request->input('pelanggan');
            $bayar = $request->input('bayar');
            $kembalian = $request->input('kembalian');
            $total_transaksi = $request->input('total_transaksi');
            $keterangan = $request->input('keterangan');
            $no_tlfn = $request->input('NoPelanggan');
            $alamatPelanggan = $request->input('alamatPelanggan');
            $nama_barang = $request->input('nama_barang');
            $stok = $request->input('stok');


            $existingPelanggan = Pelanggan::where('pelanggan', $pelanggan)
                ->where('alamat', $alamatPelanggan)
                ->where('no_tlfn', $no_tlfn)
                ->first();


            try {
                // Jika data pelanggan sudah ada, update total_cost-nya
                if ($existingPelanggan) {
                    $existingPelanggan->total_cost += $total_transaksi;
                    $existingPelanggan->save();
                } else {
                    // Jika data pelanggan belum ada, tambahkan data baru
                    $newPelanggan = new Pelanggan();
                    $newPelanggan->pelanggan = $pelanggan;
                    $newPelanggan->no_tlfn = $no_tlfn;
                    $newPelanggan->pelanggan = $pelanggan;
                    $newPelanggan->alamat = $alamatPelanggan;
                    $newPelanggan->no_tlfn = $no_tlfn;
                    $newPelanggan->total_cost = $total_transaksi;
                    $newPelanggan->save();
                }

                $idtrx = time();

                // Simpan transaksi
                $transaksi = Transaksi::create([
                    'id' => $idtrx,
                    'no_transaksi' => $invoice,
                    'pelanggan' => $pelanggan,
                    'total_transaksi' => $total_transaksi,
                    'tgl_transaksi' => $tanggalIndonesia,
                    'kasir' => $user->name,
                    'bayar' => $bayar,
                    'kembalian' => $kembalian,
                    'keterangan' => $keterangan
                ]);

                // Simpan detail transaksi
                foreach ($transaksiData as $data) {
                    $detailTransaksi = new Detail_transaksi();
                    $detailTransaksi->transaksi_id = $transaksi->id;
                    $detailTransaksi->data_barang_id = $data['id_barang'];
                    $detailTransaksi->nama_barang = $data['nama_barang'];
                    $detailTransaksi->stok = $data['stok'];
                    $detailTransaksi->harga_barang = $data['harga_barang'];
                    $detailTransaksi->jumlah = $data['jumlah'];
                    $detailTransaksi->disc = $data['disc'];
                    $detailTransaksi->save();
                }

                // Set session untuk SweetAlert
                Session::flash('status', 'Data berhasil disimpan');
                Session::flash('color', 'success');

                return response()->json(['message' => 'Data berhasil disimpan']);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data'], 500);
                Session::flash('status', 'Terjadi kesalahan saat menyimpan data');
                Session::flash('color', 'error');
            }
            }


            public function struk(Request $request)
            {
                // $data['user'] = Auth::user();
                // $data['title'] = [
                //     'title' => 'Detail Penjualan',
                //     'keterangan' => 'Detail Penjualan'
                // ];

                // // Ambil data transaksi berdasarkan nomor transaksi
                // $data['transaksi'] = Transaksi::where('no_transaksi', $noTransaksi)->first();

                // // Cek apakah data transaksi ditemukan
                // if (!$data['transaksi']) {
                //     // Tampilkan pesan error atau redirect ke halaman lain
                //     // Misalnya:
                //     session()->flash('color', 'warning');
                //     session()->flash('status', 'Penjualan Tidak Ditemukan!');
                //     return redirect()->back();
                // }

                // $data['detailTransaksi'] = Detail_transaksi::join('data_barang', 'detail_transaksi.data_barang_id', '=', 'data_barang.id')
                //     ->where('detail_transaksi.transaksi_id', $data['transaksi']->id)
                //     ->select('detail_transaksi.*', 'data_barang.nama_barang')
                //     ->get();

                // Tampilkan tampilan detail dengan data transaksi dan detail transaksi
                return view('kasir.transaksi.struk');
            }




            /**
            * Remove the specified resource from storage.
            */
            public function destroy(string $id)
            {
                // Implement the code to delete a resource based on the given ID
            }

}
