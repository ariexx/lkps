<?php

namespace App\Http\Controllers;

use App\Http\Services\DosenPembimbingUtamaTugasAkhirService;
use App\Http\Services\DosenTetapPerguruanTinggiService;
use App\Http\Services\EWMPService;
use App\Models\DosenTetapPerguruanTinggi;
use Illuminate\Http\Request;

class SumberDayaManusiaController extends Controller
{
    public function __construct
    (
        public DosenTetapPerguruanTinggiService $dosenTetapPerguruanTinggiService,
        public DosenPembimbingUtamaTugasAkhirService $dosenPembimbingUtamaTugasAkhirService,
        public EWMPService $ewmpService
    )
    {
    }

    public function createDosenTetapPerguruanTinggi()
    {
        return $this->dosenTetapPerguruanTinggiService->createDosenTetapPerguruanTinggi();
    }

    public function showDosenTetapPerguruanTinggi()
    {
        return $this->dosenTetapPerguruanTinggiService->showDosenTetapPerguruanTinggi();
    }

    public function storeDosenTetapPerguruanTinggi(Request $request)
    {
        return $this->dosenTetapPerguruanTinggiService->storeDosenTetapPerguruanTinggi($request->all());
    }

    public function editDosenTetapPerguruanTinggi($id)
    {
        return $this->dosenTetapPerguruanTinggiService->editDosenTetapPerguruanTinggi($id);
    }

    public function updateDosenTetapPerguruanTinggi(Request $request, $id)
    {
        return $this->dosenTetapPerguruanTinggiService->updateDosenTetapPerguruanTinggi($request->all(), $id);
    }

    public function deleteDosenTetapPerguruanTinggi($id)
    {
        return $this->dosenTetapPerguruanTinggiService->deleteDosenTetapPerguruanTinggi($id);
    }

    public function approveDosenTetapPerguruanTinggi($id)
    {
        return $this->dosenTetapPerguruanTinggiService->approveDosenTetapPerguruanTinggi($id);
    }

    public function rejectDosenTetapPerguruanTinggi($id)
    {
        return $this->dosenTetapPerguruanTinggiService->rejectDosenTetapPerguruanTinggi($id);
    }

    public function showDosenPembimbingUtamaTugasAkhir()
    {
        return $this->dosenPembimbingUtamaTugasAkhirService->showDosenPembimbingUtamaTugasAkhir();
    }

    public function createDosenPembimbingUtamaTugasAkhir()
    {
        return $this->dosenPembimbingUtamaTugasAkhirService->createDosenPembimbingUtamaTugasAkhir();
    }

    public function storeDosenPembimbingUtamaTugasAkhir(Request $request)
    {
        return $this->dosenPembimbingUtamaTugasAkhirService->storeDosenPembimbingUtamaTugasAkhir($request->all());
    }

    public function editDosenPembimbingUtamaTugasAkhir($id)
    {
        return $this->dosenPembimbingUtamaTugasAkhirService->editDosenPembimbingUtamaTugasAkhir($id);
    }

    public function updateDosenPembimbingUtamaTugasAkhir(Request $request, $id)
    {
        return $this->dosenPembimbingUtamaTugasAkhirService->updateDosenPembimbingUtamaTugasAkhir($request->all(), $id);
    }

    public function deleteDosenPembimbingUtamaTugasAkhir($id)
    {
        return $this->dosenPembimbingUtamaTugasAkhirService->deleteDosenPembimbingUtamaTugasAkhir($id);
    }

    public function approveDosenPembimbingUtamaTugasAkhir($id)
    {
        return $this->dosenPembimbingUtamaTugasAkhirService->approveDosenPembimbingUtamaTugasAkhir($id);
    }

    public function rejectDosenPembimbingUtamaTugasAkhir($id)
    {
        return $this->dosenPembimbingUtamaTugasAkhirService->rejectDosenPembimbingUtamaTugasAkhir($id);
    }

    public function showEWMP()
    {
        return $this->ewmpService->showEWMP();
    }

    public function createEWMP()
    {
        return $this->ewmpService->createEWMP();
    }

    public function storeEWMP(Request $request)
    {
        return $this->ewmpService->storeEWMP($request->all());
    }

    public function editEWMP($id)
    {
        return $this->ewmpService->editEWMP($id);
    }

    public function updateEWMP(Request $request, $id)
    {
        return $this->ewmpService->updateEWMP($request->all(), $id);
    }

    public function deleteEWMP($id)
    {
        return $this->ewmpService->deleteEWMP($id);
    }

    public function approveEWMP($id)
    {
        return $this->ewmpService->approveEWMP($id);
    }

    public function rejectEWMP($id)
    {
        return $this->ewmpService->rejectEWMP($id);
    }

}
