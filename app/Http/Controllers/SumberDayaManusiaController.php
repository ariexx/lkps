<?php

namespace App\Http\Controllers;

use App\Http\Services\DosenIndustriPraktisiService;
use App\Http\Services\DosenPembimbingUtamaTugasAkhirService;
use App\Http\Services\DosenTetapPerguruanTinggiService;
use App\Http\Services\DosenTidakTetapService;
use App\Http\Services\EWMPService;
use App\Http\Services\HKIBukuService;
use App\Http\Services\HKIHakCiptaService;
use App\Http\Services\HKIPatenService;
use App\Http\Services\HKITeknologiService;
use App\Http\Services\PagelaranIlmiahService;
use App\Http\Services\PenelitianDTPSService;
use App\Http\Services\PKMDTPSService;
use App\Http\Services\PublikasiIlmiahDTPSService;
use App\Http\Services\RekognisiDosenService;
use App\Models\DosenTetapPerguruanTinggi;
use App\Models\HKIPaten;
use App\Models\PublikasiIlmiahDTPS;
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
        public PenelitianDTPSService $penelitianDTPSService,
        public PKMDTPSService $pkmDtpsService,
        public PublikasiIlmiahDTPSService $publikasiIlmiahDTPSService,
        public HKIPatenService $HKIPaten,
        public HKIHakCiptaService $HKIHakCiptaService,
        public HKITeknologiService $HKITeknologiService,
        public HKIBukuService $HKIBukuService,
        public PagelaranIlmiahService $pagelaranIlmiahService
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
        return $this->rekognisiDosenService->storeRekognisiDosen($request);
    }

    public function editRekognisiDosen($id)
    {
        return $this->rekognisiDosenService->editRekognisiDosen($id);
    }

    public function updateRekognisiDosen(Request $request, $id)
    {
        return $this->rekognisiDosenService->updateRekognisiDosen($request, $id);
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

    public function showPenelitianDTPS()
    {
        return $this->penelitianDTPSService->showPenelitianDTPS();
    }

    public function createPenelitianDTPS()
    {
        return $this->penelitianDTPSService->createPenelitianDTPS();
    }

    public function storePenelitianDTPS(Request $request)
    {
        return $this->penelitianDTPSService->storePenelitianDTPS($request->all());
    }

    public function editPenelitianDTPS($id)
    {
        return $this->penelitianDTPSService->editPenelitianDTPS($id);
    }

    public function updatePenelitianDTPS(Request $request, $id)
    {
        return $this->penelitianDTPSService->updatePenelitianDTPS($request->all(), $id);
    }

    public function deletePenelitianDTPS($id)
    {
        return $this->penelitianDTPSService->deletePenelitianDTPS($id);
    }

    public function approvePenelitianDTPS($id)
    {
        return $this->penelitianDTPSService->approvePenelitianDTPS($id);
    }

    public function rejectPenelitianDTPS($id)
    {
        return $this->penelitianDTPSService->rejectPenelitianDTPS($id);
    }

    public function showPKMDTPS()
    {
        return $this->pkmDtpsService->showPKMDTPS();
    }

    public function createPKMDTPS()
    {
        return $this->pkmDtpsService->createPKMDTPS();
    }

    public function storePKMDTPS(Request $request)
    {
        return $this->pkmDtpsService->storePKMDTPS($request->all());
    }

    public function editPKMDTPS($id)
    {
        return $this->pkmDtpsService->editPKMDTPS($id);
    }

    public function updatePKMDTPS(Request $request, $id)
    {
        return $this->pkmDtpsService->updatePKMDTPS($request->all(), $id);
    }

    public function deletePKMDTPS($id)
    {
        return $this->pkmDtpsService->deletePKMDTPS($id);
    }

    public function approvePKMDTPS($id)
    {
        return $this->pkmDtpsService->approvePKMDTPS($id);
    }

    public function rejectPKMDTPS($id)
    {
        return $this->pkmDtpsService->rejectPKMDTPS($id);
    }

    public function showPublikasiIlmiahDTPS()
    {
        return $this->publikasiIlmiahDTPSService->showPublikasiIlmiahDTPS();
    }

    public function createPublikasiIlmiahDTPS()
    {
        return $this->publikasiIlmiahDTPSService->createPublikasiIlmiahDTPS();
    }

    public function storePublikasiIlmiahDTPS(Request $request)
    {
        return $this->publikasiIlmiahDTPSService->storePublikasiIlmiahDTPS($request->all());
    }

    public function editPublikasiIlmiahDTPS($id)
    {
        return $this->publikasiIlmiahDTPSService->editPublikasiIlmiahDTPS($id);
    }

    public function updatePublikasiIlmiahDTPS(Request $request, $id)
    {
        return $this->publikasiIlmiahDTPSService->updatePublikasiIlmiahDTPS($request->all(), $id);
    }

    public function deletePublikasiIlmiahDTPS($id)
    {
        return $this->publikasiIlmiahDTPSService->deletePublikasiIlmiahDTPS($id);
    }

    public function approvePublikasiIlmiahDTPS($id)
    {
        return $this->publikasiIlmiahDTPSService->approvePublikasiIlmiahDTPS($id);
    }

    public function rejectPublikasiIlmiahDTPS($id)
    {
        return $this->publikasiIlmiahDTPSService->rejectPublikasiIlmiahDTPS($id);
    }

    public function showLuaranPenelitianDTPSBagian1()
    {
        return $this->HKIPaten->showLuaranPenelitianDTPSBagian1();
    }

    public function createLuaranPenelitianDTPSBagian1()
    {
        return $this->HKIPaten->createLuaranPenelitianDTPSBagian1();
    }

    public function storeLuaranPenelitianDTPSBagian1(Request $request)
    {
        return $this->HKIPaten->storeLuaranPenelitianDTPSBagian1($request);
    }

    public function editLuaranPenelitianDTPSBagian1($id)
    {
        return $this->HKIPaten->editLuaranPenelitianDTPSBagian1($id);
    }

    public function updateLuaranPenelitianDTPSBagian1(Request $request, $id)
    {
        return $this->HKIPaten->updateLuaranPenelitianDTPSBagian1($request, $id);
    }

    public function deleteLuaranPenelitianDTPSBagian1($id)
    {
        return $this->HKIPaten->deleteLuaranPenelitianDTPSBagian1($id);
    }

    public function approveLuaranPenelitianDTPSBagian1($id)
    {
        return $this->HKIPaten->approveLuaranPenelitianDTPSBagian1($id);
    }

    public function rejectLuaranPenelitianDTPSBagian1($id)
    {
        return $this->HKIPaten->rejectLuaranPenelitianDTPSBagian1($id);
    }

    public function showLuaranPenelitianDTPSBagian2()
    {
        return $this->HKIHakCiptaService->showLuaranPenelitianDTPSBagian2();
    }

    public function createLuaranPenelitianDTPSBagian2()
    {
        return $this->HKIHakCiptaService->createLuaranPenelitianDTPSBagian2();
    }

    public function storeLuaranPenelitianDTPSBagian2(Request $request)
    {
        return $this->HKIHakCiptaService->storeLuaranPenelitianDTPSBagian2($request);
    }

    public function editLuaranPenelitianDTPSBagian2($id)
    {
        return $this->HKIHakCiptaService->editLuaranPenelitianDTPSBagian2($id);
    }

    public function updateLuaranPenelitianDTPSBagian2(Request $request, $id)
    {
        return $this->HKIHakCiptaService->updateLuaranPenelitianDTPSBagian2($request, $id);
    }

    public function deleteLuaranPenelitianDTPSBagian2($id)
    {
        return $this->HKIHakCiptaService->deleteLuaranPenelitianDTPSBagian2($id);
    }

    public function approveLuaranPenelitianDTPSBagian2($id)
    {
        return $this->HKIHakCiptaService->approveLuaranPenelitianDTPSBagian2($id);
    }

    public function rejectLuaranPenelitianDTPSBagian2($id)
    {
        return $this->HKIHakCiptaService->rejectLuaranPenelitianDTPSBagian2($id);
    }

    public function showLuaranPenelitianDTPSBagian3()
    {
        return $this->HKITeknologiService->showLuaranPenelitianDTPSBagian3();
    }

    public function createLuaranPenelitianDTPSBagian3()
    {
        return $this->HKITeknologiService->createLuaranPenelitianDTPSBagian3();
    }

    public function storeLuaranPenelitianDTPSBagian3(Request $request)
    {
        return $this->HKITeknologiService->storeLuaranPenelitianDTPSBagian3($request);
    }

    public function editLuaranPenelitianDTPSBagian3($id)
    {
        return $this->HKITeknologiService->editLuaranPenelitianDTPSBagian3($id);
    }

    public function updateLuaranPenelitianDTPSBagian3(Request $request, $id)
    {
        return $this->HKITeknologiService->updateLuaranPenelitianDTPSBagian3($request, $id);
    }

    public function deleteLuaranPenelitianDTPSBagian3($id)
    {
        return $this->HKITeknologiService->deleteLuaranPenelitianDTPSBagian3($id);
    }

    public function approveLuaranPenelitianDTPSBagian3($id)
    {
        return $this->HKITeknologiService->approveLuaranPenelitianDTPSBagian3($id);
    }

    public function rejectLuaranPenelitianDTPSBagian3($id)
    {
        return $this->HKITeknologiService->rejectLuaranPenelitianDTPSBagian3($id);
    }

    public function showLuaranPenelitianDTPSBagian4()
    {
        return $this->HKIBukuService->showLuaranPenelitianDTPSBagian4();
    }

    public function createLuaranPenelitianDTPSBagian4()
    {
        return $this->HKIBukuService->createLuaranPenelitianDTPSBagian4();
    }

    public function storeLuaranPenelitianDTPSBagian4(Request $request)
    {
        return $this->HKIBukuService->storeLuaranPenelitianDTPSBagian4($request);
    }

    public function editLuaranPenelitianDTPSBagian4($id)
    {
        return $this->HKIBukuService->editLuaranPenelitianDTPSBagian4($id);
    }

    public function updateLuaranPenelitianDTPSBagian4(Request $request, $id)
    {
        return $this->HKIBukuService->updateLuaranPenelitianDTPSBagian4($request, $id);
    }

    public function deleteLuaranPenelitianDTPSBagian4($id)
    {
        return $this->HKIBukuService->deleteLuaranPenelitianDTPSBagian4($id);
    }

    public function approveLuaranPenelitianDTPSBagian4($id)
    {
        return $this->HKIBukuService->approveLuaranPenelitianDTPSBagian4($id);
    }

    public function rejectLuaranPenelitianDTPSBagian4($id)
    {
        return $this->HKIBukuService->rejectLuaranPenelitianDTPSBagian4($id);
    }

    public function showPagelaranIlmiahDTPS()
    {
        return $this->pagelaranIlmiahService->showPagelaranIlmiahDTPS();
    }

    public function createPagelaranIlmiahDTPS()
    {
        return $this->pagelaranIlmiahService->createPagelaranIlmiahDTPS();
    }

    public function storePagelaranIlmiahDTPS(Request $request)
    {
        return $this->pagelaranIlmiahService->storePagelaranIlmiahDTPS($request);
    }

    public function editPagelaranIlmiahDTPS($id)
    {
        return $this->pagelaranIlmiahService->editPagelaranIlmiahDTPS($id);
    }

    public function updatePagelaranIlmiahDTPS(Request $request, $id)
    {
        return $this->pagelaranIlmiahService->updatePagelaranIlmiahDTPS($request, $id);
    }

    public function deletePagelaranIlmiahDTPS($id)
    {
        return $this->pagelaranIlmiahService->deletePagelaranIlmiahDTPS($id);
    }

    public function approvePagelaranIlmiahDTPS($id)
    {
        return $this->pagelaranIlmiahService->approvePagelaranIlmiahDTPS($id);
    }

    public function rejectPagelaranIlmiahDTPS($id)
    {
        return $this->pagelaranIlmiahService->rejectPagelaranIlmiahDTPS($id);
    }

}
