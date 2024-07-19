<?php

namespace App\Exports;

use App\Models\Transaksi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TransaksiExport implements FromView
{

    protected $awal;
    protected $akhir;

    public function __construct($awal, $akhir)
    {
        $this->awal = $awal;
        $this->akhir = $akhir;
    }

    public function view(): View
{
    $transaksiData = [];


    if ($this->awal && $this->akhir) {
        $transaksiData = Transaksi::whereBetween('tgl_transaksi', [$this->awal, $this->akhir])->get();
    } else {
        $transaksiData = Transaksi::whereDate('tgl_transaksi', now()->format('Y-m-d'))->get();
    }


    return view('export.manager.penjualan', [
        'transaksiData' => $transaksiData,
        'no' => 1
    ]);
}

}
