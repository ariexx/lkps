<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenelitianDTPSMelibatkanMahasiswa extends Model
{
    protected $fillable = [
        'nama_dosen',
        'tema_penelitian',
        'nama_mahasiswa',
        'judul_kegiatan',
        'tahun',
        'bukti',
        'is_approve',
        'user_id'
    ];

    //before create append user_id to auth()->id()
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->user_id = auth()->id();
        });
    }
}
