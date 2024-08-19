<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukJasaMasyarakat extends Model
{
    protected $fillable = [
        'nama',
        'nama_produk',
        'deskripsi',
        'bukti',
        'is_approve',
    ];
}
