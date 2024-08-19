<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntegrasiKegiatanPenelitian extends Model
{
    protected $fillable = [
        'judul',
        'nama_dosen',
        'mata_kuliah',
        'bentuk_integrasi',
        'tahun',
        'bukti',
        'is_approve',
    ];
}
