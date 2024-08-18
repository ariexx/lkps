<?php

namespace App\Http\Controllers;

use App\Http\Services\DosenIndustriPraktisi;
use App\Http\Services\DosenIndustriPraktisiService;
use App\Http\Services\DosenPembimbingUtamaTugasAkhirService;
use App\Http\Services\DosenTetapPerguruanTinggiService;
use App\Http\Services\DosenTidakTetapService;
use App\Http\Services\EWMPService;
use App\Http\Services\RekognisiDosenService;
use App\Models\DosenTetapPerguruanTinggi;
use Illuminate\Http\Request;

class SumberDayaManusiaController extends Controller
{
    public function __construct
    (
        public DosenTetapPerguruanTinggiService $dosenTetapPerguruanTinggiService,
        public DosenPembimbingUtamaTugasAkhirService $dosenPembimbingUtamaTugasAkhirService,
        public EWMPService $ewmpService,
        public DosenTidakTetapService $dosenTidakTetapService,
        public DosenIndustriPraktisiService $dosenIndustriPraktisiService,
        public RekognisiDosenService $rekognisiDosenService,
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

    public function showDosenTidakTetap()
    {
        return $this->dosenTidakTetapService->showDosenTidakTetap();
    }

    public function createDosenTidakTetap()
    {
        return $this->dosenTidakTetapService->createDosenTidakTetap();
    }

    public function storeDosenTidakTetap(Request $request)
    {
        return $this->dosenTidakTetapService->storeDosenTidakTetap($request->all());
    }

    public function editDosenTidakTetap($id)
    {
        return $this->dosenTidakTetapService->editDosenTidakTetap($id);
    }

    public function updateDosenTidakTetap(Request $request, $id)
    {
        return $this->dosenTidakTetapService->updateDosenTidakTetap($request->all(), $id);
    }

    public function deleteDosenTidakTetap($id)
    {
        return $this->dosenTidakTetapService->deleteDosenTidakTetap($id);
    }

    public function approveDosenTidakTetap($id)
    {
        return $this->dosenTidakTetapService->approveDosenTidakTetap($id);
    }

    public function rejectDosenTidakTetap($id)
    {
        return $this->dosenTidakTetapService->rejectDosenTidakTetap($id);
    }

    public function showDosenIndustriPraktisi()
    {
        return $this->dosenIndustriPraktisiService->showDosenIndustriPraktisi();
    }

    public function createDosenIndustriPraktisi()
    {
        return $this->dosenIndustriPraktisiService->createDosenIndustriPraktisi();
    }

    public function storeDosenIndustriPraktisi(Request $request)
    {
        return $this->dosenIndustriPraktisiService->storeDosenIndustriPraktisi($request->all());
    }

    public function editDosenIndustriPraktisi($id)
    {
        return $this->dosenIndustriPraktisiService->editDosenIndustriPraktisi($id);
    }

    public function updateDosenIndustriPraktisi(Request $request, $id)
    {
        return $this->dosenIndustriPraktisiService->updateDosenIndustriPraktisi($request->all(), $id);
    }

    public function deleteDosenIndustriPraktisi($id)
    {
        return $this->dosenIndustriPraktisiService->deleteDosenIndustriPraktisi($id);
    }

    public function approveDosenIndustriPraktisi($id)
    {
        return $this->dosenIndustriPraktisiService->approveDosenIndustriPraktisi($id);
    }

    public function rejectDosenIndustriPraktisi($id)
    {
        return $this->dosenIndustriPraktisiService->rejectDosenIndustriPraktisi($id);
    }

    public function showRekognisiDosen()
    {
        return $this->rekognisiDosenService->showRekognisiDosen();
    }

    public function createRekognisiDosen()
    {
        return $this->rekognisiDosenService->createRekognisiDosen();
    }

    public function storeRekognisiDosen(Request $request)
    {
        return $this->rekognisiDosenService->storeRekognisiDosen($request->all());
    }

    public function editRekognisiDosen($id)
    {
        return $this->rekognisiDosenService->editRekognisiDosen($id);
    }

    public function updateRekognisiDosen(Request $request, $id)
    {
        return $this->rekognisiDosenService->updateRekognisiDosen($request->all(), $id);
    }

    public function deleteRekognisiDosen($id)
    {
        return $this->rekognisiDosenService->deleteRekognisiDosen($id);
    }

    public function approveRekognisiDosen($id)
    {
        return $this->rekognisiDosenService->approveRekognisiDosen($id);
    }

    public function rejectRekognisiDosen($id)
    {
        return $this->rekognisiDosenService->rejectRekognisiDosen($id);
    }
}
