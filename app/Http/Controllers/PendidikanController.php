<?php

namespace App\Http\Controllers;

use App\Http\Services\CapaianPembelajaranService;
use App\Models\CapaianPembelajaran;
use Illuminate\Http\Request;

class PendidikanController extends Controller
{
    public function __construct(
        public CapaianPembelajaranService $capaianPembelajaran,
    )
    {
    }

    public function showKurikulumCapaianPembelajaranDanRencanaPembelajaran()
    {
        return $this->capaianPembelajaran->showKurikulumCapaianPembelajaranDanRencanaPembelajaran();
    }

    public function createKurikulumCapaianPembelajaranDanRencanaPembelajaran()
    {
        return $this->capaianPembelajaran->createKurikulumCapaianPembelajaranDanRencanaPembelajaran();
    }

    public function storeKurikulumCapaianPembelajaranDanRencanaPembelajaran(Request $request)
    {
        return $this->capaianPembelajaran->storeKurikulumCapaianPembelajaranDanRencanaPembelajaran($request);
    }

    public function editKurikulumCapaianPembelajaranDanRencanaPembelajaran($id)
    {
        return $this->capaianPembelajaran->editKurikulumCapaianPembelajaranDanRencanaPembelajaran($id);
    }

    public function updateKurikulumCapaianPembelajaranDanRencanaPembelajaran(Request $request, $id)
    {
        return $this->capaianPembelajaran->updateKurikulumCapaianPembelajaranDanRencanaPembelajaran($request, $id);
    }

    public function deleteKurikulumCapaianPembelajaranDanRencanaPembelajaran($id)
    {
        return $this->capaianPembelajaran->deleteKurikulumCapaianPembelajaranDanRencanaPembelajaran($id);
    }

    public function approveKurikulumCapaianPembelajaranDanRencanaPembelajaran($id)
    {
        return $this->capaianPembelajaran->approveKurikulumCapaianPembelajaranDanRencanaPembelajaran($id);
    }

    public function rejectKurikulumCapaianPembelajaranDanRencanaPembelajaran($id)
    {
        return $this->capaianPembelajaran->rejectKurikulumCapaianPembelajaranDanRencanaPembelajaran($id);
    }
}
