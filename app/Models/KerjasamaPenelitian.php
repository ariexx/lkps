<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function getDurasiAttribute()
    {
        return Carbon::parse($this->attributes['durasi'])->format('Y-m-d');
    }
}
