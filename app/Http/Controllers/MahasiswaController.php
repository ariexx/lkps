<?php

namespace App\Http\Controllers;

use App\Http\Services\Mahasiswa\MahasiswaAsingService;
use App\Http\Services\Mahasiswa\SeleksiMahasiswaService;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function __construct(
        public SeleksiMahasiswaService $seleksiMahasiswaService,
        public MahasiswaAsingService $mahasiswaAsingService
    )
    {
    }

    public function createSeleksiMahasiswa()
    {
        return $this->seleksiMahasiswaService->createSeleksiMahasiswa();
    }

    public function showSeleksiMahasiswa()
    {
        return $this->seleksiMahasiswaService->showSeleksiMahasiswa();
    }

    public function storeSeleksiMahasiswa(Request $request)
    {
        return $this->seleksiMahasiswaService->store($request->all());
    }

    public function editSeleksiMahasiswa($id)
    {
        return $this->seleksiMahasiswaService->edit($id);
    }

    public function updateSeleksiMahasiswa(Request $request, $id)
    {
        return $this->seleksiMahasiswaService->update($request->all(), $id);
    }

    public function deleteSeleksiMahasiswa($id)
    {
        return $this->seleksiMahasiswaService->delete($id);
    }

    public function showMahasiswaAsing()
    {
        return $this->mahasiswaAsingService->showMahasiswaAsing();
    }

    public function storeMahasiswaAsing(Request $request)
    {
        return $this->mahasiswaAsingService->storeMahasiswaAsing($request->all());
    }

    public function editMahasiswaAsing($id)
    {
        return $this->mahasiswaAsingService->editMahasiswaAsing($id);
    }

    public function updateMahasiswaAsing(Request $request, $id)
    {
        return $this->mahasiswaAsingService->updateMahasiswaAsing($request->all(), $id);
    }

    public function deleteMahasiswaAsing($id)
    {
        return $this->mahasiswaAsingService->deleteMahasiswaAsing($id);
    }

    public function createMahasiswaAsing()
    {
        return $this->mahasiswaAsingService->createMahasiswaAsing();
    }
}
