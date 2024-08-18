<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekognisiDosen extends Model
{
    protected $fillable = [
        'nama',
        'bidang',
        'rekognisi',
        'bukti',
        'wilayah',
        'nasional',
        'internasional',
        'tahun',
        'is_approve'
    ];

    protected function casts(): array
    {
        return [
            'tahun' => 'string',
        ];
    }
}
