<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $fillable = ['no_transaksi', 'tgl_transaksi', 'kasir'];

    public function detailTransaksi()
    {
        return $this->hasMany(Detail_transaksi::class, 'transaksi_id');
    }
}
