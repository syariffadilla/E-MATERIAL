<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class KategoriController extends Controller
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
         $kategori = Kategori::all();
        return view('barang.index',$data, compact('kategori'));
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
        $kategori = new Kategori;
         $kategori->nama_kategori = $request->input('kategori');
         $kategori->is_active = 1;
         $kategori->save();

        $request->session()->flash('color', 'success');
        $request->session()->flash('status', 'Kategori berhasil ditambahkan');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        dd($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {

        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = Kategori::findOrFail($id);
        $data->nama_kategori = $request->kategori;
        $data->save();

        $request->session()->flash('color', 'success');
        $request->session()->flash('status', 'Kategori berhasil diubah');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
{
    $data = Kategori::findOrFail($id);
    $data->update(['is_active' => 0]);

    $request->session()->flash('color', 'success');
    $request->session()->flash('status', 'Kategori berhasil dihapus');

    return redirect()->route('setting_kategori.index');
}

}
