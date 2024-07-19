<?php

namespace App\Http\Controllers\Manager;

use App\Models\Barang;
use App\Models\Suplier;
use App\Models\Kategori;
use App\Models\DataBarang;
use App\Exports\StokExport;
use App\Models\ProfileToko;
use App\Models\SubKategori;
use Illuminate\Http\Request;
use App\Models\KategoriBarang;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;


class StokBarangManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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


        $data['user'] = Auth::user();
        $data['title'] = [
            'title' => 'Stok',
            'keterangan' => 'Di menu ini anda dapat melihat stok barang yang akan habis dan menambahkan Stok barang'
        ];

        return view('manager.stok_barang.index', $data);
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
        return view('manager.stok_barang.index', $data);
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

        return redirect()->to('stokbarangmanager/?kategori=' . $stok->kategori_barang_id . '&subkategori=' . $stok->sub_kategori_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function generateSTOK($id)
    {


        $data['kategoriFirst'] = KategoriBarang::find($id);
        $data['profil'] = ProfileToko::find(1);

        if ($data['kategoriFirst']) {
            $data['barangs'] = Barang::where('kategori_barang_id', $data['kategoriFirst']->id)
                ->where('is_active', 1)
                ->with('suplier', 'kategori') // Include the 'kategori' relationship
                ->get();
        } else {
            $data['barangs'] = collect(); // Provide an empty collection if $kategoriFirst is null
        }


        $pdf = PDF::loadView('manager.stok_barang.pdf', $data);
        return $pdf->download('Data-Stok-Barang.pdf');
    }
    public function exportExcel()
    {
        // get all data stock from database
        $supplier = Suplier::all();
        $data = DataBarang::where('is_active', 1)
            ->with('supplier')
            ->orderBy('nama_barang', 'asc')
            ->get([
                'id',
                'nama_barang',
                'current_stok',
                'supplier_id',
                'keterangan',
            ]);

        $data->map(function ($item) use ($supplier) {
            // Get supplier name
            $item->supplier_id = $supplier->where('id', $item->supplier_id)->first()->nama;
            return $item;
        });

        if ($data->isEmpty()) {
            return response()->json(['message' => 'No data to export'], 404);
        }
        // Mengonversi data menjadi file Excel
        return Excel::download(new StokExport($data), 'Data_Stok_Barang.xlsx');
    }
}
