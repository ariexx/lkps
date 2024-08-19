<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HKIBuku extends Model
{
    protected $table = 'hki_bukus';

    protected $fillable = [
        'luaran_dan_pkm',
        'tahun',
        'keterangan',
        'bukti',
        'is_approve',
    ];
}
