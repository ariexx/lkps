<?php

namespace App\Http\Controllers;

use App\Http\Services\PenelitianDTPSMelibatkanMahasiswaService;
use App\Http\Services\PenelitianDTPSService;
use App\Http\Services\PKMDTPSMelibatkanMahasiswaService;
use Illuminate\Http\Request;

class KinerjaDosenController extends Controller
{
    public function __construct(
        public PenelitianDTPSMelibatkanMahasiswaService $penelitianDTPSMelibatkanMahasiswaService,
        public PKMDTPSMelibatkanMahasiswaService $pkmDTPSMelibatkanMahasiswaService,
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
}
