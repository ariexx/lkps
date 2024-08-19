<?php

namespace App\Http\Controllers;

use App\Http\Services\CapaianPembelajaranService;
use App\Http\Services\IntegrasiKegiatanPenelitianService;
use App\Http\Services\KepuasanMahasiswaService;
use App\Models\CapaianPembelajaran;
use App\Models\KepuasanMahasiswa;
use Illuminate\Http\Request;

class PendidikanController extends Controller
{
    public function __construct(
        public CapaianPembelajaranService $capaianPembelajaran,
        public IntegrasiKegiatanPenelitianService $integrasiKegiatanPenelitian,
        public KepuasanMahasiswaService $kepuasanMahasiswa
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

    public function showKepuasanMahasiswa()
    {
        return $this->kepuasanMahasiswa->showKepuasanMahasiswa();
    }

    public function createKepuasanMahasiswa()
    {
        return $this->kepuasanMahasiswa->createKepuasanMahasiswa();
    }

    public function storeKepuasanMahasiswa(Request $request)
    {
        return $this->kepuasanMahasiswa->storeKepuasanMahasiswa($request);
    }

    public function editKepuasanMahasiswa($id)
    {
        return $this->kepuasanMahasiswa->editKepuasanMahasiswa($id);
    }

    public function updateKepuasanMahasiswa(Request $request, $id)
    {
        return $this->kepuasanMahasiswa->updateKepuasanMahasiswa($request, $id);
    }

    public function deleteKepuasanMahasiswa($id)
    {
        return $this->kepuasanMahasiswa->deleteKepuasanMahasiswa($id);
    }

    public function approveKepuasanMahasiswa($id)
    {
        return $this->kepuasanMahasiswa->approveKepuasanMahasiswa($id);
    }

    public function rejectKepuasanMahasiswa($id)
    {
        return $this->kepuasanMahasiswa->rejectKepuasanMahasiswa($id);
    }

}
