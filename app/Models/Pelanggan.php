<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $table = 'poin_pelanggan';
    protected $fillable = ['pelanggan', 'total_cost', 'no_tlfn', 'alamat'];

}
