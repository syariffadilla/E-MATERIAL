<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Suplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Termwind\Components\Dd;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['user'] = AUTH::user();
        $data['title'] = [
            'title' => 'Data Barang',
            'keterangan' => 'Di menu ini anda dapat menghapus seluruh data transaksi secara permanent'
        ];
        $data['kategorifind'] = Kategori::first();
        $data['kategorifind'] = Kategori::first();
        $data['suppaliyerfind'] = Suplier::first();
        $data['supplier'] = Suplier::all();

       if ($data['kategorifind']) {
        $barang = Barang::where('kategori_barang_id', $data['kategorifind']->id)
            ->where('is_active', 1)
            ->with('suplier')
            ->get();
    } else {
        $barang = collect(); // Empty collection if $data['kategorifind'] is null
    }



        $kategori = Kategori::all();
        return view('barang.index', $data, compact('barang', 'kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $data['user'] = AUTH::user();
        // return view('barang.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // @dd($request);
        $data_barang = new Barang;
        $data_barang->nama_barang = $request->input('nama_barang');
        $data_barang->kategori_barang_id = $request->input('kategori_barang_id');
        $data_barang->sub_kategori_id = $request->input('sub_kategori_id');
        $data_barang->stok = $request->input('stok');
        $data_barang->current_stok = $request->input('stok');
        // $data_barang->disc = $request->input('disc');
        // $harga_jual = $request->harga_barang_jual ? str_replace(['Rp', '.', ' '], '', $request->harga_barang_jual) : 0;
        // // $data_barang->harga_barang = (int)$harga_jual;
        // $harga_modal = str_replace(['Rp', '.', ' '], '', $request->harga_barang_modal);
        // $data_barang->harga_modal = (int)$harga_modal;
        // $data_barang->harga_modal = str_replace(".", "", $request->harga_barang_modal);
        $data_barang->keterangan = $request->input('keterangan');
        $data_barang->supplier_id = $request->input('supplier');
        $data_barang->kategori_satuan = $request->input('satuan_barang');
        $data_barang->is_active = 1;
        $data_barang->save();

        $request->session()->flash('color', 'success');
        $request->session()->flash('status', 'Barang berhasil ditambahkan');

        return redirect()->back();
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data['user'] = AUTH::user();
        $data['title'] = [
            'title' => 'Data Barang',
            'keterangan' => 'Di menu ini anda dapat menghapus seluruh data transaksi secara permanent'
        ];
        $data['kategorifind'] = Kategori::find($id);
        $data['kategori'] = Kategori::all();
        // dd($data);
        if ($data['kategorifind']) {
            $data['barang'] = Barang::where('kategori_barang_id', $data['kategorifind']->id)->where('is_active', 1)->get();
        } else {
            $data['barang'] = collect(); // Empty collection if $data['kategorifind'] is null
        }
        $data['supplier'] = Suplier::all();
        $data['suppaliyerfind'] = Suplier::first();
        return view('barang.index', $data);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kategori = Kategori::all();
        $data = Barang::findOrFail($id);
        $data->nama_barang = $request->input('nama_barang');
       
        $data->stok = $request->input('stok');
        $data->current_stok = $request->input('stok');
        // $data->disc = $request->input('disc');
        // $harga_jual = $request->harga_barang_jual ? str_replace(['Rp', '.', ' '], '', $request->harga_barang_jual) : 0;
        // $data->harga_barang = (int)$harga_jual;
        // $harga_modal = str_replace(['Rp', '.', ' '], '', $request->harga_barang_modal);
        // $data->harga_modal = (int)$harga_modal;
        // // $data->harga_modal = str_replace(".", "", $request->harga_barang_modal);
        $data->keterangan = $request->input('keterangan');
        $data->supplier_id = $request->input('supplier');
        $data->kategori_satuan = $request->input('satuan_barang');
        $data->is_active = 1;
        $data->save();

        $request->session()->flash('color', 'success');
        $request->session()->flash('status', 'Barang berhasil diedit');

        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $data = Barang::find($id)->update(['is_active' => 0]);


        $request->session()->flash('color', 'success');
        $request->session()->flash('status', 'Barang berhasil dihapus');

        return redirect()->back();
    }
}
