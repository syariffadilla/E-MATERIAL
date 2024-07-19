<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKategori extends Model
{
    use HasFactory;


    use HasFactory;

    protected $table = 'sub_kategori';
    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }

    public function barang()
    {
        return $this->hasMany(Barang::class, 'sub_kategori_id', 'id');
    }
}
