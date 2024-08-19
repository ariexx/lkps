<?php

namespace App\Http\Controllers;

use App\Http\Services\PenggunaanDanaService;
use Illuminate\Http\Request;

class PenggunaanDanaController extends Controller
{
    public function __construct(
        public PenggunaanDanaService $penggunaanDanaService
    )
    {
    }

    public function showPenggunaanDana()
    {
        return $this->penggunaanDanaService->showPenggunaanDana();
    }

    public function createPenggunaanDana()
    {
        return $this->penggunaanDanaService->createPenggunaanDana();
    }

    public function storePenggunaanDana(Request $request)
    {
        return $this->penggunaanDanaService->storePenggunaanDana($request);
    }

    public function editPenggunaanDana($id)
    {
        return $this->penggunaanDanaService->editPenggunaanDana($id);
    }

    public function updatePenggunaanDana(Request $request, $id)
    {
        return $this->penggunaanDanaService->updatePenggunaanDana($request, $id);
    }

    public function deletePenggunaanDana($id)
    {
        return $this->penggunaanDanaService->deletePenggunaanDana($id);
    }

    public function approvePenggunaanDana($id)
    {
        return $this->penggunaanDanaService->approvePenggunaanDana($id);
    }

    public function rejectPenggunaanDana($id)
    {
        return $this->penggunaanDanaService->rejectPenggunaanDana($id);
    }

}
