<?php

namespace App\Exports;

use App\Models\Transaksi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;


class TransasksiExportKasir implements FromView
{
    public function view(): View
    {
        $transaksiData = Transaksi::whereDate('tgl_transaksi', now()->format('Y-m-d'))->get();
        $no = 1;

        // Format nilai total pembelian menjadi rupiah
        foreach ($transaksiData as $trx) {
            $trx->total_cost = 'Rp ' . number_format($trx->total_cost, 0, ',', '.');
        }

        return view('export.manager.penjualan', [
            'transaksiData' => $transaksiData,
            'no' => 1
        ]);
    }
}
