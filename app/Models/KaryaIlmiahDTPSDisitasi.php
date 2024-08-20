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
        'user_id'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->user_id = auth()->id();
        });
    }
}
