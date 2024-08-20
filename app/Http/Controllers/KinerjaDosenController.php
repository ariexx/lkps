<?php

namespace App\Http\Controllers;

use App\Http\Services\PenelitianDTPSMelibatkanMahasiswaService;
use App\Http\Services\PenelitianDTPSService;
use App\Http\Services\PKMDTPSMelibatkanMahasiswaService;
use App\Http\Services\RekognisiDosenService;
use Illuminate\Http\Request;

class KinerjaDosenController extends Controller
{
    public function __construct(
        public PenelitianDTPSMelibatkanMahasiswaService $penelitianDTPSMelibatkanMahasiswaService,
        public PKMDTPSMelibatkanMahasiswaService $pkmDTPSMelibatkanMahasiswaService,
        public RekognisiDosenService $rekognisiDosenService,
    )
    {
    }

    public function showPenelitianDTPS()
    {
        return $this->penelitianDTPSMelibatkanMahasiswaService->showPenelitianDTPSMelibatkanMahasiswa();
    }

    public function createPenelitianDTPS()
    {
        return $this->penelitianDTPSMelibatkanMahasiswaService->createPenelitianDTPSMelibatkanMahasiswa();
    }

    public function storePenelitianDTPS(Request $request)
    {
        return $this->penelitianDTPSMelibatkanMahasiswaService->storePenelitianDTPSMelibatkanMahasiswa($request);
    }

    public function editPenelitianDTPS($id)
    {
        return $this->penelitianDTPSMelibatkanMahasiswaService->editPenelitianDTPSMelibatkanMahasiswa($id);
    }

    public function updatePenelitianDTPS(Request $request, $id)
    {
        return $this->penelitianDTPSMelibatkanMahasiswaService->updatePenelitianDTPSMelibatkanMahasiswa($request, $id);
    }

    public function deletePenelitianDTPS($id)
    {
        return $this->penelitianDTPSMelibatkanMahasiswaService->deletePenelitianDTPSMelibatkanMahasiswa($id);
    }

    public function showPKMDTPS()
    {
        return $this->pkmDTPSMelibatkanMahasiswaService->showPKMDTPSYangMelibatkanMahasiswa();
    }

    public function createPKMDTPS()
    {
        return $this->pkmDTPSMelibatkanMahasiswaService->createPKMDTPSYangMelibatkanMahasiswa();
    }

    public function storePKMDTPS(Request $request)
    {
        return $this->pkmDTPSMelibatkanMahasiswaService->storePKMDTPSYangMelibatkanMahasiswa($request);
    }

    public function editPKMDTPS($id)
    {
        return $this->pkmDTPSMelibatkanMahasiswaService->editPKMDTPSYangMelibatkanMahasiswa($id);
    }

    public function updatePKMDTPS(Request $request, $id)
    {
        return $this->pkmDTPSMelibatkanMahasiswaService->updatePKMDTPSYangMelibatkanMahasiswa($request, $id);
    }

    public function deletePKMDTPS($id)
    {
        return $this->pkmDTPSMelibatkanMahasiswaService->deletePKMDTPSYangMelibatkanMahasiswa($id);
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

}
