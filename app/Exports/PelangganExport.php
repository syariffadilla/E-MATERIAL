<?php

namespace App\Exports;

use App\Models\PoinPelanggan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;


class PelangganExport implements FromView
{
    public function view(): View
    {
        $transaksiData = PoinPelanggan::all();
        $no = 1;

        // Format nilai total pembelian menjadi rupiah
        foreach ($transaksiData as $trx) {
            $trx->total_cost = 'Rp ' . number_format($trx->total_cost, 0, ',', '.');
        }

        return view('export.manager.pelanggan', [
            'transaksiData' => $transaksiData,
            'no' => $no
        ]);
    }
}
