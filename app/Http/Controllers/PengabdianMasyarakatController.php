<?php

namespace App\Http\Controllers;

use App\Http\Services\PenelitianDTPSMelibatkanMahasiswaService;
use App\Http\Services\PKMDTPSMelibatkanMahasiswaService;
use App\Models\PKMDTPSMelibatkanMahasiswa;
use Illuminate\Http\Request;

class PengabdianMasyarakatController extends Controller
{
    public function __construct(
        public PenelitianDTPSMelibatkanMahasiswaService $penelitianDTPSMelibatkanMahasiswa,
        public PKMDTPSMelibatkanMahasiswaService $pkmDTPSMelibatkanMahasiswa
    )
    {
    }

    public function showPenelitianDTPSMelibatkanMahasiswa()
    {
        return $this->penelitianDTPSMelibatkanMahasiswa->showPenelitianDTPSMelibatkanMahasiswa();
    }

    public function createPenelitianDTPSMelibatkanMahasiswa()
    {
        return $this->penelitianDTPSMelibatkanMahasiswa->createPenelitianDTPSMelibatkanMahasiswa();
    }

    public function storePenelitianDTPSMelibatkanMahasiswa(Request $request)
    {
        return $this->penelitianDTPSMelibatkanMahasiswa->storePenelitianDTPSMelibatkanMahasiswa($request);
    }

    public function editPenelitianDTPSMelibatkanMahasiswa($id)
    {
        return $this->penelitianDTPSMelibatkanMahasiswa->editPenelitianDTPSMelibatkanMahasiswa($id);
    }

    public function updatePenelitianDTPSMelibatkanMahasiswa(Request $request, $id)
    {
        return $this->penelitianDTPSMelibatkanMahasiswa->updatePenelitianDTPSMelibatkanMahasiswa($request, $id);
    }

    public function deletePenelitianDTPSMelibatkanMahasiswa($id)
    {
        return $this->penelitianDTPSMelibatkanMahasiswa->deletePenelitianDTPSMelibatkanMahasiswa($id);
    }

    public function approvePenelitianDTPSMelibatkanMahasiswa($id)
    {
        return $this->penelitianDTPSMelibatkanMahasiswa->approvePenelitianDTPSMelibatkanMahasiswa($id);
    }

    public function rejectPenelitianDTPSMelibatkanMahasiswa($id)
    {
        return $this->penelitianDTPSMelibatkanMahasiswa->rejectPenelitianDTPSMelibatkanMahasiswa($id);
    }

    public function showPKMDTPSYangMelibatkanMahasiswa()
    {
        return $this->pkmDTPSMelibatkanMahasiswa->showPKMDTPSYangMelibatkanMahasiswa();
    }

    public function createPKMDTPSYangMelibatkanMahasiswa()
    {
        return $this->pkmDTPSMelibatkanMahasiswa->createPKMDTPSYangMelibatkanMahasiswa();
    }

    public function storePKMDTPSYangMelibatkanMahasiswa(Request $request)
    {
        return $this->pkmDTPSMelibatkanMahasiswa->storePKMDTPSYangMelibatkanMahasiswa($request);
    }

    public function editPKMDTPSYangMelibatkanMahasiswa($id)
    {
        return $this->pkmDTPSMelibatkanMahasiswa->editPKMDTPSYangMelibatkanMahasiswa($id);
    }

    public function updatePKMDTPSYangMelibatkanMahasiswa(Request $request, $id)
    {
        return $this->pkmDTPSMelibatkanMahasiswa->updatePKMDTPSYangMelibatkanMahasiswa($request, $id);
    }

    public function deletePKMDTPSYangMelibatkanMahasiswa($id)
    {
        return $this->pkmDTPSMelibatkanMahasiswa->deletePKMDTPSYangMelibatkanMahasiswa($id);
    }

    public function approvePKMDTPSYangMelibatkanMahasiswa($id)
    {
        return $this->pkmDTPSMelibatkanMahasiswa->approvePKMDTPSYangMelibatkanMahasiswa($id);
    }

    public function rejectPKMDTPSYangMelibatkanMahasiswa($id)
    {
        return $this->pkmDTPSMelibatkanMahasiswa->rejectPKMDTPSYangMelibatkanMahasiswa($id);
    }

}
