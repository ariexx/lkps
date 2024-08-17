<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EWMP extends Model
{
    protected $table = 'ewmps';

    protected $fillable = [
        'name',
        'dtps',
        'ps_diakreditasi',
        'ps_lain_didalam_pt',
        'pt_lain_diluar_pt',
        'penelitian',
        'pkm',
        'tugas_tambahan',
        'is_approve'
    ];

    public function getAll()
    {
        return $this->get();
    }

    public function jumlah()
    {
        return $this->ps_diakreditasi + $this->ps_lain_didalam_pt + $this->pt_lain_diluar_pt + $this->penelitian + $this->tugas_tambahan + $this->pkm;
    }

    public function rataRata()
    {
        return $this->jumlah() / 2;
    }

    public function rataRataJumlah()
    {
        $data = collect($this->get());
        $total = $data->sum(function($item) { return $item->jumlah(); });
        $totalData = $data->count();

        return $totalData ? $total / $totalData : 0;
    }

    public function rataRataSKS()
    {
        $data = collect($this->get());
        $totalData = $data->count();

        if ($totalData == 0) {
            return 0;
        }

        $total = $data->sum(function($item) { return $item->rataRata(); });

        return $total / $totalData;
    }

    public function getRataRataJumlahAttribute()
    {
        return $this->rataRataJumlah();
    }

    public function getRataRataSKSAttribute()
    {
        return $this->rataRataSKS();
    }
}
