<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PKMDTPSMelibatkanMahasiswa extends Model
{
    protected $fillable = [
        'nama_dosen',
        'tema_pkm',
        'nama_mahasiswa',
        'judul_kegiatan',
        'tahun',
        'bukti',
        'is_approve',
    ];
}
