<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PoinPelanggan;
use App\Exports\TransaksiExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Illuminate\Support\Facades\Auth;
use App\Exports\PelangganExport;

class PelangganManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['point'] = PoinPelanggan::all();
        $data['user'] = AUTH::user();
        $data['title'] = [
            'title' => 'Pelanggan',
            'keterangan' => 'Di menu ini anda dapat melihat dan mereset total pelanggan membeli.'
        ];
        return view('manager.pelanggan.index', $data);
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
    public function show(Request $request)
    {
        $data = PoinPelanggan::find($request->id);
        $data->total_cost = 0;
        $data->save();

        $request->session()->flash('color', 'success');
        $request->session()->flash('status', 'Total pembelian berhasil di reset');

        return redirect()->back();
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

    public function exportExcel()
    {

        return Excel::download(new PelangganExport, 'Laporan-Pelanggan.xlsx');
    }

    public function exportCSV()
    {
        return Excel::download(new PelangganExport(), 'pelanggan.csv');
    }

    public function generatePDF()
    {
       


        $data = [
            'pelanggan' => PoinPelanggan::get()

        ];

        $pdf = PDF::loadView('manager.pelanggan.pdf', $data);

        return $pdf->download('pelanggan.pdf');

    }

}
