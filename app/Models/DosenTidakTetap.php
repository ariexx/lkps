<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DosenTidakTetap extends Model
{
    protected $table = 'dosen_tidak_tetaps';
    protected $fillable = [
        'nama',
        'nidn',
        'pendidikan_terakhir',
        'bidang_keahlian',
        'jabatan',
        'sertifikat_pendidik',
        'sertifikat_kompetensi',
        'mata_kuliah',
        'kesesuaian_bidang',
        'user_id'
    ];

    public function getAll(): object
    {
        return $this->get();
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
