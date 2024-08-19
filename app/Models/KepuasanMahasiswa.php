<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KepuasanMahasiswa extends Model
{
    protected $fillable = [
        'aspek',
        'sangat_baik',
        'baik',
        'cukup',
        'kurang',
        'rencana_tindak_lanjut',
        'is_approve',
    ];
}
