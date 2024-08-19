<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HKIHakCipta extends Model
{
    protected $table = 'hki_hak_ciptas';

    protected $fillable = [
        'luaran_dan_pkm',
        'tahun',
        'keterangan',
        'bukti',
        'is_approve',
    ];
}
