<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KerjasamaPenelitian extends Model
{
    protected $fillable = [
        'lembaga',
        'internasional',
        'nasional',
        'lokal',
        'judul',
        'manfaat',
        'durasi',
        'bukti',
        'tahun_kerjasama',
        'is_approved',
    ];

    protected function casts()
    {
        return [
            'durasi' => 'datetime',
        ];
    }
}
