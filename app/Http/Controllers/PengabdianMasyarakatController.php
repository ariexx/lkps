<?php

namespace App\Http\Controllers;

use App\Http\Services\PenelitianDTPSMelibatkanMahasiswaService;
use Illuminate\Http\Request;

class PengabdianMasyarakatController extends Controller
{
    public function __construct(
        public PenelitianDTPSMelibatkanMahasiswaService $penelitianDTPSMelibatkanMahasiswa,
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

}
