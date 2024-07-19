<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;


class BarangExport implements FromCollection, WithHeadings
{
    use Exportable;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function map($data): array
    {
      
        return $data;
    }

    public function headings(): array
    {
        return [
            'id',
            'nama_barang',
            // 'current_stok',
            'disc',
            'stok',
            'harga_barang',
            'harga_modal',
            'supplier',
            'keterangan'
        ];
    }
}
