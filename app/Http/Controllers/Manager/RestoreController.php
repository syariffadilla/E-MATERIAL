<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RestoreData;
use App\Models\DataBarang;
use App\Models\Transaksi;
use App\Models\PoinPelanggan;
use App\Models\KategoriBarang;
use App\Models\SubKategori;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\Auth;

class RestoreController extends Controller
{
    public function index()
    {
        $data['user'] = AUTH::user(); 
        $data['restore'] = RestoreData::all();
        $data['title'] = [
            'title' => 'Restore Data',
            'keterangan' => 'Di menu ini anda dapat menghapus seluruh data transaksi secara permanent'
        ];
        return view('manager.restore.index', $data);
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
        DetailTransaksi::where('transaksi_id', "!=" , 0)->delete();
        Transaksi::where('id', "!=" , 0)->delete();
        DataBarang::where('is_active', 0)->delete();
        SubKategori::where('is_active', 0)->delete();
        KategoriBarang::where('is_active', 0)->delete();
        PoinPelanggan::where('total_cost', 0)->delete();

        $user = AUTH::user(); 
        $save = new RestoreData;
        $save->users = $user->name;
        $save->save();

        $request->session()->flash('color', 'success');
        $request->session()->flash('status', 'Data berhasil dihapus');

        return redirect()->back();
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
