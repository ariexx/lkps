<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenggunaanDana extends Model
{
    protected $fillable = [
        'jenis_penggunaan',
        'unit_ts',
        'unit_ts1',
        'unit_ts2',
        'program_ts',
        'program_ts1',
        'program_ts2',
        'is_approve',
    ];
}
