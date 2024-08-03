<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDosenTidakTetapRequest;
use App\Models\DosenTidakTetap;
use Illuminate\Http\Request;


class ProfileDosenController extends Controller
{

    public function __construct(public DosenTidakTetap $dosenTidakTetap)
    {
    }

    public function showDosenTidakTetap()
    {
        $dosenTidakTetap = $this->dosenTidakTetap->getAll();
        return view('dosen.profile.dosen_tidak_tetap', compact('dosenTidakTetap'));
    }

    public function storeDosenTidakTetap(StoreDosenTidakTetapRequest $request)
    {
        try {
            $this->dosenTidakTetap->create($request->validated());
            return redirect()->route('dosen.dosen-tidak-tetap')->with('success', 'Data dosen tidak tetap berhasil ditambahkan');
        } catch (\Exception $e) {
             return redirect()->route('dosen.dosen-tidak-tetap.create')->with('error', 'Data dosen tidak tetap gagal ditambahkan');
        }
    }
}
