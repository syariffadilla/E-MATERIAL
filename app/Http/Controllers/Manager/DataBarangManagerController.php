<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use App\Models\Suplier;
use App\Models\Kategori;
use App\Models\DataBarang;
use App\Models\SubKategori;
use Illuminate\Http\Request;
use App\Exports\BarangExport;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class DataBarangManagerController extends Controller
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
        $data['kategorifind'] = Kategori::where('is_active', 1)->first();
        $data['Subkategorifind'] = SubKategori::where('is_active', 1)->where('kategori_id', $data['kategorifind']->id)->first();
        $data['suppaliyerfind'] = Suplier::first();
        $data['supplier'] = Suplier::all();


        $kategori = Kategori::where('is_active', 1)->get();
        // dd($data);
        return view('manager.data_barang.index', $data, compact('kategori'));
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
    public function storeSubKategori(Request $request)
    {
        // @dd($request);
        $data_barang = new SubKategori();
        $data_barang->nama_sub_kategori = $request->input('SubKategori');
        $data_barang->kategori_id = $request->input('kategori');
        $data_barang->is_active = 1;

        $data_barang->save();
        return redirect('/databarangmanager');
    }

    /**
     * Display the specified resource.
     */
    public function show($kategori, $sub_kategori)
    {
        $data['user'] = AUTH::user();
        $data['title'] = [
            'title' => 'Data Barang',
            'keterangan' => 'Di menu ini anda dapat menghapus seluruh data transaksi secara permanent'
        ];
        $data['kategorifind'] = Kategori::where('id', $kategori)->where('is_active', 1)->first();
        $data['Subkategorifind'] = SubKategori::where('id', $sub_kategori)->where('is_active', 1)->where('kategori_id', $data['kategorifind']->id)->first();
        $data['suppaliyerfind'] = Suplier::first();
        $data['supplier'] = Suplier::all();


        $kategori = Kategori::where('is_active', 1)->get();
        // dd($data);
        return view('manager.data_barang.index', $data, compact('kategori'));
    }


    // Di dalam DataBarangManagerController
    public function getSubkategori($kategoriId)
    {
        // Ambil subkategori berdasarkan kategori yang dipilih
        $subkategori = SubKategori::where('kategori_id', $kategoriId)->where('is_active', 1)->get();
        return response()->json($subkategori);
    }

    // Di dalam DataBarangManagerController
    public function getDataBarang($kategoriId, $subkategoriId)
    {
        // @dd($kategoriId);
        // Ambil data barang berdasarkan kategori dan subkategori yang dipilih
        $barang = Barang::where('kategori_barang_id', $kategoriId)
            ->where('sub_kategori_id', $subkategoriId)
            ->where('is_active', 1)
            ->with('suplier')
            ->get();

        // @dd($barang);
        return response()->json($barang);
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

        $kategori = Kategori::all();
        $data = Barang::findOrFail($id);
        $data->nama_barang = $request->input('nama_barang');
        $data->kategori_barang_id = $request->input('kategori_barang_id');
        $data->stok = $request->input('stok');
        $data->current_stok = $request->input('stok');
        // $data->disc = $request->input('disc');
        // $data->harga_barang = intval(str_replace(".", "", $request->harga_barang_jual));
        // $data->harga_modal = intval(str_replace(".", "", $request->harga_barang_modal));
        $data->supplier_id = $request->input('supplier');
        $data->keterangan = $request->input('keterangan');
        $data->kategori_satuan = $request->input('satuan_barang');
        $data->is_active = 1;
        $data->save();
        return redirect()->route("barang_show",);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Barang::find($id)->update(['is_active' => 0]);

        return redirect()->back();
    }

    // Export PDF
    public function generateBarang($id)
    {

        $data['kategoriFirst'] = Kategori::find($id);

        if ($data['kategoriFirst']) {
            $data['barangs'] = Barang::where('kategori_barang_id', $data['kategoriFirst']->id)
                ->where('is_active', 1)
                ->with('suplier', 'kategori') // Include the 'kategori' relationship
                ->get();
        } else {
            $data['barangs'] = collect(); // Provide an empty collection if $kategoriFirst is null
        }


        $pdf = PDF::loadView('manager.data_barang.pdf', $data);

        return $pdf->download('databarang.pdf');
    }

    public function exportExcel()
    {
        // Mengambil data dari model Barang dengan relasi supplier
        // Get supplier data
        $supplier = Suplier::all();
        $data = DataBarang::where('is_active', 1)
        ->orderBy('nama_barang', 'asc')
            ->with('supplier')
            ->get([
                'id',
                'nama_barang',
                // 'current_stok',
                // 'disc',
                'stok',
                // 'harga_barang',
                // 'harga_modal',
                'supplier_id',
                'keterangan',
            ]);
            // dd($data[0]);
        $data->map(function ($item) use ($supplier) {
            // Get supplier name
            $item->supplier_id = $supplier->where('id', $item->supplier_id)->first()->nama;
            return $item;
        });

        if ($data->isEmpty()) {
            return response()->json(['message' => 'No data to export'], 404);
        }
// dd($data[10]);
        // Mengonversi data menjadi file Excel
        return Excel::download(new BarangExport($data), 'Data_Barang.xlsx');
    }
}
