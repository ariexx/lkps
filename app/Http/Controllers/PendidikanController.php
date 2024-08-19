<?php

namespace App\Http\Controllers;

use App\Http\Services\CapaianPembelajaranService;
use App\Http\Services\IntegrasiKegiatanPenelitianService;
use App\Models\CapaianPembelajaran;
use Illuminate\Http\Request;

class PendidikanController extends Controller
{
    public function __construct(
        public CapaianPembelajaranService $capaianPembelajaran,
        public IntegrasiKegiatanPenelitianService $integrasiKegiatanPenelitian,
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

    public function showIntegrasiKegiatanPenelitianPKMDalamPembelajaran()
    {
        return $this->integrasiKegiatanPenelitian->showIntegrasiKegiatanPenelitianPKMDalamPembelajaran();
    }

    public function createIntegrasiKegiatanPenelitianPKMDalamPembelajaran()
    {
        return $this->integrasiKegiatanPenelitian->createIntegrasiKegiatanPenelitianPKMDalamPembelajaran();
    }

    public function storeIntegrasiKegiatanPenelitianPKMDalamPembelajaran(Request $request)
    {
        return $this->integrasiKegiatanPenelitian->storeIntegrasiKegiatanPenelitianPKMDalamPembelajaran($request);
    }

    public function editIntegrasiKegiatanPenelitianPKMDalamPembelajaran($id)
    {
        return $this->integrasiKegiatanPenelitian->editIntegrasiKegiatanPenelitianPKMDalamPembelajaran($id);
    }

    public function updateIntegrasiKegiatanPenelitianPKMDalamPembelajaran(Request $request, $id)
    {
        return $this->integrasiKegiatanPenelitian->updateIntegrasiKegiatanPenelitianPKMDalamPembelajaran($request, $id);
    }

    public function deleteIntegrasiKegiatanPenelitianPKMDalamPembelajaran($id)
    {
        return $this->integrasiKegiatanPenelitian->deleteIntegrasiKegiatanPenelitianPKMDalamPembelajaran($id);
    }

    public function approveIntegrasiKegiatanPenelitianPKMDalamPembelajaran($id)
    {
        return $this->integrasiKegiatanPenelitian->approveIntegrasiKegiatanPenelitianPKMDalamPembelajaran($id);
    }

    public function rejectIntegrasiKegiatanPenelitianPKMDalamPembelajaran($id)
    {
        return $this->integrasiKegiatanPenelitian->rejectIntegrasiKegiatanPenelitianPKMDalamPembelajaran($id);
    }

}
