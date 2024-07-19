<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DataBarang extends Model
{
    use HasFactory;

    protected $table = 'data_barang';

    public function KategoriBarang(): BelongsTo
    {
        return $this->belongsTo(KategoriBarang::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Suplier::class, 'supplier_id');
    }
}
