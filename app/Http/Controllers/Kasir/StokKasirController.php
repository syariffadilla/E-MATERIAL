<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\SubKategori;

class StokKasirController extends Controller
{
    public function index(Request $request)
    {

        $data['kategori'] = Kategori::all();

        if ($request->kategori) {
            $data['kategorifind'] = Kategori::where('is_active', 1)->where('id', $request->kategori)->first();
            $data['Subkategorifind'] = SubKategori::where('is_active', 1)->where('id', $request->subkategori)->where('kategori_id', $data['kategorifind']->id)->first();
    
        } else {
            $data['kategorifind'] = Kategori::where('is_active', 1)->first();
            $data['Subkategorifind'] = SubKategori::where('is_active', 1)->where('kategori_id', $data['kategorifind']->id)->first();
    
        }
    
   
        $data['user'] = AUTH::user();
        $data['title'] = [
            'title' => 'Stok',
            'keterangan' => 'Di menu ini anda dapat melihat stok barang yang akan habis dan menambahkan Stok barang'
        ];
        return view('kasir.stok.index', $data);
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

        $data['kategoriFirst'] = KategoriBarang::find($id);
        $data['kategori'] = KategoriBarang::all();
        $data['barang'] = Barang::where('kategori_barang_id', $data['kategoriFirst']->id)->where('is_active', 1)->get();
        $data['user'] = AUTH::user();
        $data['title'] = [
            'title' => 'Stok',
            'keterangan' => 'Di menu ini anda dapat melihat stok barang yang akan habis dan menambahkan Stok barang'
        ];
        return view('kasir.stok.index', $data);
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
        $stok = Barang::find($id);
        $curent = $request->stok + $stok->stok;

        if ($request->reset == 1) {

        $user = Barang::find($id);
        $user->stok = $request->stok;
        $user->current_stok = $request->stok;

        $user->save();
        } else {

        $user = Barang::find($id);
        $user->stok = $curent;
        $user->current_stok = $curent;

        $user->save();
        }



        $request->session()->flash('color', 'success');
        $request->session()->flash('status', 'Stok berhasil ditambahkan');

        return redirect()->to('stokbarangkasir/?kategori='.$stok->kategori_barang_id.'&subkategori='.$stok->sub_kategori_id);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
