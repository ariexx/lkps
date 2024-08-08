<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PengabdianMasyarakat extends Model
{
    protected $fillable = [
        'lembaga',
        'internasional',
        'nasional',
        'lokal',
        'judul',
        'manfaat',
        'waktu',
        'bukti',
        'tahun_berakhir_kerjasama',
        'is_approved',
    ];

    protected function casts()
    {
        return [
            'waktu' => 'date',
        ];
    }

    public function getWaktuAttribute()
    {
        return Carbon::parse($this->attributes['waktu'])->format('Y-m-d');
    }
}
