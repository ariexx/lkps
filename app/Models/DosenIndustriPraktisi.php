<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DosenIndustriPraktisi extends Model
{
    protected $table = 'dosen_industri_praktisis';
    protected $fillable = [
        'nama',
        'nidn',
        'perusahaan',
        'pendidikan_terakhir',
        'bidang_keahlian',
        'sertifikat_kompetensi',
        'mata_kuliah',
        'bobot_kredit',
        'user_id',
        'is_approve'
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
