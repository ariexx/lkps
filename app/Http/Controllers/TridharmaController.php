<?php

namespace App\Http\Controllers;

use App\Http\Services\Tridharma\PendidikanService;
use App\Http\Services\Tridharma\PenelitianService;
use App\Http\Services\Tridharma\PengabdianMasyarakatService;
use App\Models\KerjasamaPendidikan;
use Illuminate\Http\Request;

class TridharmaController extends Controller
{
    public function __construct(
        public PendidikanService $pendidikanService,
        public PenelitianService $penelitianService,
        public PengabdianMasyarakatService $pengabdianMasyarakat
    )
    {
    }

    public function showPendidikan()
    {
        return $this->pendidikanService->showKerjasamaPendidikan();
    }

    /**
     * @throws \Exception
     */
    public function storePendidikan(Request $request)
    {
        return $this->pendidikanService->storeKerjasamaPendidikan($request);
    }

    public function approveFileKerjasamaPendidikan($id)
    {
        return $this->pendidikanService->approveFileKerjasamaPendidikan($id);
    }

    public function rejectFileKerjasamaPendidikan($id)
    {
        return $this->pendidikanService->rejectFileKerjasamaPendidikan($id);
    }

    public function editKerjasamaPendidikan($id)
    {
        return $this->pendidikanService->editKerjasamaPendidikan($id);
    }

    public function updateKerjasamaPendidikan(Request $request, $id)
    {
        return $this->pendidikanService->updateKerjasamaPendidikan($request, $id);
    }

    public function deleteKerjasamaPendidikan($id)
    {
        return $this->pendidikanService->deleteKerjasamaPendidikan($id);
    }

    public function showPenelitian()
    {
        return $this->penelitianService->showKerjasamaPenelitian();
    }

    public function storePenelitian(Request $request)
    {
        return $this->penelitianService->store($request);
    }

    public function editPenelitian($id)
    {
        return $this->penelitianService->editKerjasamaPenelitian($id);
    }

    public function updateKerjasamaPenelitian(Request $request, $id)
    {
        return $this->penelitianService->updateKerjasamaPenelitian($request, $id);
    }

    public function deleteKerjasamaPenelitian($id)
    {
        return $this->penelitianService->deleteKerjasamaPenelitian($id);
    }

    public function approveFileKerjasamaPenelitian($id)
    {
        return $this->penelitianService->approveFileKerjasamaPenelitian($id);
    }

    public function rejectFileKerjasamaPenelitian($id)
    {
        return $this->penelitianService->rejectFileKerjasamaPenelitian($id);
    }

    public function createPengabdianMasyarakat()
    {
        return $this->pengabdianMasyarakat->createPengabdianMasyarakat();
    }

    public function storePengabdianMasyarakat(Request $request)
    {
        return $this->pengabdianMasyarakat->storePengabdianMasyarakat($request);
    }

    public function showPengabdianMasyarakat()
    {
        return $this->pengabdianMasyarakat->showPengabdianMasyarakat();
    }

    public function editPengabdianMasyarakat($id)
    {
        return $this->pengabdianMasyarakat->editPengabdianMasyarakat($id);
    }

    public function updatePengabdianMasyarakat(Request $request, $id)
    {
        return $this->pengabdianMasyarakat->updatePengabdianMasyarakat($request, $id);
    }

    public function deletePengabdianMasyarakat($id)
    {
        return $this->pengabdianMasyarakat->deletePengabdianMasyarakat($id);
    }

    public function approveFilePengabdianMasyarakat($id)
    {
        return $this->pengabdianMasyarakat->approveFilePengabdianMasyarakat($id);
    }

    public function rejectFilePengabdianMasyarakat($id)
    {
        return $this->pengabdianMasyarakat->rejectFilePengabdianMasyarakat($id);
    }

}
