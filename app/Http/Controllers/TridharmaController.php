<?php

namespace App\Http\Controllers;

use App\Http\Services\Tridharma\PendidikanService;
use App\Models\KerjasamaPendidikan;
use Illuminate\Http\Request;

class TridharmaController extends Controller
{
    public function __construct(
        public PendidikanService $pendidikanService
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

    public function editKerjasamaPendidikan($id)
    {
        return $this->pendidikanService->editKerjasamaPendidikan($id);
    }

    public function updateKerjasamaPendidikan(Request $request, $id)
    {
        return $this->pendidikanService->updateKerjasamaPendidikan($request, $id);
    }

    public function delete($id)
    {
        return $this->pendidikanService->deleteKerjasamaPendidikan($id);
    }
}
