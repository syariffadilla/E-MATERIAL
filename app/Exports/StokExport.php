<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\Barang;
use App\Models\KategoriBarang;

class StokExport implements FromView
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        $data['kategoriFirst'] = KategoriBarang::find($this->id);

        if ($data['kategoriFirst']) {
            $data['barangs'] = Barang::where('is_active', 1)
            ->orderBy('nama_barang', 'asc')
                ->with('suplier', 'kategori') // Include the 'kategori' relationship
                ->get();
                // where('kategori_barang_id', $data['kategoriFirst']->id)
                // ->
        } else {
            $data['barangs'] = collect(); // Provide an empty collection if $kategoriFirst is null
        }

        return view('export.manager.stokbarang', [
            'data' => $data,
            'no' => 1 // Set the initial number as per your requirement
        ]);
    }
}
