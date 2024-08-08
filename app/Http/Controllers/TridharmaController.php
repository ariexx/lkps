<?php

namespace App\Http\Controllers;

use App\Http\Services\Tridharma\PendidikanService;
use App\Http\Services\Tridharma\PenelitianService;
use App\Models\KerjasamaPendidikan;
use Illuminate\Http\Request;

class TridharmaController extends Controller
{
    public function __construct(
        public PendidikanService $pendidikanService,
        public PenelitianService $penelitianService
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
}
