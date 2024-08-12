<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DosenTetapPerguruanTinggi extends Model
{
    protected $fillable = [
        'nama',
        'nidn',
        'pendidikan_magister',
        'pendidikan_doktor',
        'bidang_keahlian',
        'kesesuaian',
        'jabatan_akademik',
        'sertifikat_pendidik',
        'sertifikat_kompetensi',
        'mata_kuliah_ps_diakreditasi',
        'kesesuaian_bidang_keahlian',
        'mata_kuliah_ps_lain',
        'user_id',
        'is_approve'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getAll(): object
    {
        return $this->get();
    }

}
