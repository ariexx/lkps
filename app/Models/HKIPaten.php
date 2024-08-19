<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HKIPaten extends Model
{
    protected $table = 'hki_patens';

    protected $fillable = [
        'luaran_dan_pkm',
        'tahun',
        'keterangan',
        'bukti',
        'is_approve',
    ];
}
