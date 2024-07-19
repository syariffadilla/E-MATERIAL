<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori_barang';
    protected $guarded = ['id'];

    public function barang()
    {
        return $this->hasMany(Barang::class, 'kategori_barang_id', 'id');
    }
}
