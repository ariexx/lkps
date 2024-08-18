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

    //before submitted set wilayah to always 0
    public static function boot()
    {
        parent::boot();
//        static::creating(function ($model) {
//            $model->wilayah = 0;
//            $model->nasional = 0;
//        });
    }
}
