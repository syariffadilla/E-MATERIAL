<?php

// app/Models/Barang.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'data_barang';
    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_barang_id', 'id');
    }

    public function suplier()
    {
        return $this->belongsTo(Suplier::class, 'supplier_id', 'id');
    }

    public function subKategori()
    {
        return $this->belongsTo(sub_katageori::class, 'sub_kategori_id', 'id');
    }
}
