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
        return $this->ps_diakreditasi + $this->ps_lain_didalam_pt + $this->pt_lain_diluar_pt + $this->penelitian + $this->tugas_tambahan;
    }

    public function rataRata()
    {
        return $this->jumlah() / 2;
    }

    public function rataRataJumlah()
    {
        $data = $this->get();
        $total = 0;
        foreach ($data as $item) {
            $total += $item->jumlah();
        }

        return $total;
    }

    public function rataRataSKS()
    {
        $data = $this->get();
        $total = 0;
        foreach ($data as $item) {
            $total += $item->rataRata();
        }

        return $total;
    }
    
}
