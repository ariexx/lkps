<?php

namespace App\Http\Controllers;

use App\Http\Services\PenelitianDTPSMelibatkanMahasiswaService;
use App\Http\Services\PenelitianDTPSService;
use Illuminate\Http\Request;

class KinerjaDosenController extends Controller
{
    public function __construct(
        public PenelitianDTPSMelibatkanMahasiswaService $penelitianDTPSMelibatkanMahasiswaService,
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
}
