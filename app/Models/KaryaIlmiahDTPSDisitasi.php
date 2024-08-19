<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KaryaIlmiahDTPSDisitasi extends Model
{
    protected $fillable = [
        'nama',
        'judul_artikel',
        'jumlah_sitasi',
        'bukti',
        'is_approve',
    ];
}
