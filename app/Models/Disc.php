<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dics extends Model
{
    use HasFactory;

    protected $table = 'disc_barang';
    protected $guarded = ['id'];
}
