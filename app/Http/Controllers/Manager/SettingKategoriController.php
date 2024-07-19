<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriBarang;
use App\Models\SubKategori;
use Illuminate\Support\Facades\Auth;

class SettingKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(isset($request->id)){
            $data['kategorifind'] = KategoriBarang::where('is_active', 1)
            ->orderBy('nama_kategori', 'asc')->where('id', $request->id)->first();

        }else{
            $data['kategorifind'] = KategoriBarang::where('is_active', 1)
            ->orderBy('nama_kategori', 'asc')->first();

        }

        $data['kategori'] = KategoriBarang::where('is_active', 1)
        ->orderBy('nama_kategori', 'asc')
        ->get();

        if ($data['kategorifind']) {
            $data['sub_kategori'] = SubKategori::where('kategori_id', $data['kategorifind']->id)
                ->where('is_active', 1)
                ->orderBy('nama_sub_kategori', 'asc')
                ->get();
        } else {
            $data['barang'] = collect(); // Provide an empty collection if $kategoriFirst is null
        }

        $data['user'] = Auth::user();
        $data['title'] = [
            'title' => 'Setting Kategori',
            'keterangan' => 'Di menu ini anda dapat melihat Kategori Barang yang akan habis dan menambahkan Kategori Barang'
        ];

        return view('manager.kategori_barang.index', $data);
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
    public function update(Request $request, string $setting_kategori)
{
    // Temukan data berdasarkan ID
    $data = SubKategori::find($setting_kategori);

    // Periksa apakah nama sudah ada dalam tabel SubKategori
    $existingData = SubKategori::where('nama_sub_kategori', $request->subkategori)->first();

    if ($existingData && $existingData->id !== $data->id) {
        // Nama sudah ada dan tidak sama dengan data yang sedang diubah
        return redirect()->back()->with('error', 'Nama sudah ada dalam database.');
    }

    // Nama belum ada atau sama dengan data yang sedang diubah, simpan data
    $data->nama_sub_kategori = $request->subkategori;
    $data->save();

    // Redirect dengan pesan sukses jika berhasil
    return redirect()->route('setting_kategori.index')->with('success', 'Data berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $setting_kategori)
    {
        $data = SubKategori::find($setting_kategori);

        if (!$data) {
            // Data tidak ditemukan
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        // Set is_active menjadi 0 untuk menghapus data
        $data->is_active = 0;
        $data->save();

        // Redirect dengan pesan sukses jika berhasil
        return redirect()->route('setting_kategori.index')->with('success', 'Data berhasil dihapus.');
    }

}
