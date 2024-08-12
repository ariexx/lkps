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
        return $this->jumlah();
    }

    public function rataRataJumlah()
    {
        $data = $this->get()->toArray();
        $total = array_sum(array_map(function($item) { return $item->jumlah(); }, $data));
        $totalData = count($data);

        return $totalData ? $total / $totalData : 0;
    }

    public function rataRataSKS()
    {
        $data = $this->get()->toArray();
        $totalData = count($data);

        if ($totalData == 0) {
            return 0;
        }

        $total = array_sum(array_map(function($item) { return $item->rataRata(); }, $data));

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
