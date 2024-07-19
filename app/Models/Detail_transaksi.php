<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_transaksi extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi';
    protected $fillable = ['transaksi_id', 'nama_barang', 'stok_barang', 'sisaStok', 'data_barang_id', 'jumlah_barang'];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }
}
