<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HKITeknologi extends Model
{
    protected $table = 'hki_teknologis';
    protected $fillable = [
        'luaran_dan_pkm',
        'tahun',
        'keterangan',
        'bukti',
        'is_approve',
    ];
}
