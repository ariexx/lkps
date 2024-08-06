<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KerjasamaPendidikan extends Model
{
    protected $fillable = [
        'lembaga_mitra',
        'internasional',
        'nasional',
        'lokal',
        'judul_kegiatan',
        'manfaat_ps_diakreditasi',
        'waktu_dan_durasi',
        'bukti_kerjasama',
        'tahun_berakhir_kerjasama',
        'is_approved'
    ];
}
