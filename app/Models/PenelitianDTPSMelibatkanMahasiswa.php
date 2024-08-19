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
    ];
}
