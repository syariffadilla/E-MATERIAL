<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suplier;
use Illuminate\Support\Facades\Auth;

class SuplayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        {
            $data['point'] = Suplier::all();
            $data['user'] = AUTH::user();
            $data['suplayerfind'] = Suplier::first();

            $data['title'] = [
                'title' => 'Supplier',
                'keterangan' => 'Di menu ini anda dapat melihat dan mereset total pelanggan membeli.'
            ];
            return view('kasir.suplayer.index', $data);
        }
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
        $data = new Suplier();
        // $data = Suplayer::findOrFail($id);
        $data->nama = $request->input('nama');
        $data->alamat = $request->input('alamat');
        $data->no_tlp = $request->input('no_tlp');
        $data->save();

            $request->session()->flash('color', 'success');
            $request->session()->flash('status', 'Supplier Berhasil Ditambahkan');
        return redirect('/suplayer');

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
    public function update(Request $request, $id)
    {

        $data = Suplier::findOrFail($id);
        $data->nama = $request->nama;
        $data->alamat = $request->alamat;
        $data->no_tlp = $request->no_tlp;
        $data->update();
            $request->session()->flash('color', 'success');
            $request->session()->flash('status', 'Supplier Berhasil Ditambahkan');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Suplier::findOrFail($id);
        if ($data->delete()) {
            session()->flash('color', 'success');
            session()->flash('status', 'Supplier Berhasil Dihapus');
        } else {
            session()->flash('color', 'warning');
            session()->flash('status', 'Gagal menghapus Supplier');
        }
        return redirect()->back();
    }
}
