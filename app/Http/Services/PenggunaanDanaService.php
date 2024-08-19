<?php

namespace App\Http\Services;

use App\Models\PenggunaanDana;

class PenggunaanDanaService
{
    public function __construct(
        public PenggunaanDana $penggunaanDana,
        public LogActivityService $logActivityService,
    )
    {
    }

    public function showPenggunaanDana()
    {
        $data = $this->penggunaanDana->get()->map(function ($item, $key) {
            return [
                $key + 1,
                $item->jenis_penggunaan,
                $item->unit_ts,
                $item->unit_ts1,
                $item->unit_ts2,
                (float) (($item->unit_ts + $item->unit_ts1 + $item->unit_ts2) / 3) ?? 0,
                $item->program_ts,
                $item->program_ts1,
                $item->program_ts2,
                (float) (($item->program_ts + $item->program_ts1 + $item->program_ts2) / 3) ?? 0,
                is_approved($item->is_approve),
                view('components.buttons', [
                    'routeEdit' => route('kepala-prodi.penggunaan-dana.edit', $item->id),
                    'routeDelete' => route('kepala-prodi.penggunaan-dana.delete', $item->id),
                    'isApproved' => $item->is_approve,
                    "routeApprove" => route('kepala-prodi.penggunaan-dana.approve', $item->id),
                    "routeReject" => route('kepala-prodi.penggunaan-dana.reject', $item->id),
                ])->render()
            ];
        })->toArray();

        $heads = [
            'No',
            'Jenis Penggunaan',
            'Unit Pengelola TS-1',
            'Unit Pengelola TS-2',
            'Unit Pengelola TS-3',
            'Rata Rata',
            'Program Studi TS',
            'Program Studi TS-1',
            'Program Studi TS-2',
            'Rata Rata',
            'Status',
            'Aksi'
        ];

        $config = [
            "heads" => $heads,
            "data" => $data,
            "jumlah_unit_ts" => $this->penggunaanDana->sum('unit_ts'),
            "jumlah_unit_ts1" => $this->penggunaanDana->sum('unit_ts1'),
            "jumlah_unit_ts2" => $this->penggunaanDana->sum('unit_ts2'),
            "rata_rata_unit" => (float) (($this->penggunaanDana->sum('unit_ts') + $this->penggunaanDana->sum('unit_ts1') + $this->penggunaanDana->sum('unit_ts2')) / 3) ?? 0,            "jumlah_program_ts" => $this->penggunaanDana->sum('program_ts'),
            "jumlah_program_ts1" => $this->penggunaanDana->sum('program_ts1'),
            "jumlah_program_ts2" => $this->penggunaanDana->sum('program_ts2'),
            "rata_rata_program" => (float) (($this->penggunaanDana->sum('program_ts') + $this->penggunaanDana->sum('program_ts1') + $this->penggunaanDana->sum('program_ts2')) / 3) ?? 0,        ];

        return view("penggunaan-dana.index", compact('config'));
    }

    public function createPenggunaanDana()
    {
        return view("penggunaan-dana.create");
    }

    public function storePenggunaanDana(\Illuminate\Http\Request $request)
    {
        $all = $request->all();
        $all['is_approve'] = 0;
        $this->penggunaanDana->create($all);
        $this->logActivityService->log(["tambah", "Berhasil menambahkan data penggunaan dana $request[jenis_penggunaan]"]);
        return redirect()->route('kepala-prodi.penggunaan-dana')->with('success', 'Berhasil menambahkan data penggunaan dana');
    }

    public function editPenggunaanDana($id)
    {
        $data = $this->penggunaanDana->find($id);
        return view('penggunaan-dana.edit', compact('data'));
    }

    public function updatePenggunaanDana(\Illuminate\Http\Request $request, $id)
    {
        $data = $this->penggunaanDana->find($id);
        $validated = $request->validate([
            'jenis_penggunaan' => 'required',
            'unit_ts' => 'required',
            'unit_ts1' => 'required',
            'unit_ts2' => 'required',
            'program_ts' => 'required',
            'program_ts1' => 'required',
            'program_ts2' => 'required',
        ]);

        $data->update($request->all());
        $this->logActivityService->log(["ubah", "Berhasil mengubah data penggunaan dana $request[jenis_penggunaan]"]);
        return redirect()->route('kepala-prodi.penggunaan-dana')->with('success', 'Berhasil mengubah data penggunaan dana');
    }

    public function deletePenggunaanDana($id)
    {
        try {
            $data = $this->penggunaanDana->find($id);
            $this->penggunaanDana->destroy($id);
            $this->logActivityService->log(["hapus", "Berhasil menghapus data penggunaan dana $data[jenis_penggunaan]"]);
            return redirect()->route('kepala-prodi.penggunaan-dana')->with('success', 'Berhasil menghapus data penggunaan dana');
        } catch (\Exception $e) {
            return redirect()->route('kepala-prodi.penggunaan-dana')->with('failed', 'Gagal menghapus data penggunaan dana');
        }
    }

    public function approvePenggunaanDana($id)
    {
        $data = $this->penggunaanDana->find($id);
        $data->update(['is_approve' => STATUS_APPROVED]);
        $this->logActivityService->log(["setujui", "Berhasil menyetujui data penggunaan dana $data[jenis_penggunaan]"]);
        return redirect()->route('kepala-prodi.penggunaan-dana')->with('success', 'Berhasil menyetujui data penggunaan dana');
    }

    public function rejectPenggunaanDana($id)
    {
        $data = $this->penggunaanDana->find($id);
        $data->update(['is_approve' => STATUS_REJECTED]);
        $this->logActivityService->log(["tolak", "Berhasil menolak data penggunaan dana $data[jenis_penggunaan]"]);
        return redirect()->route('kepala-prodi.penggunaan-dana')->with('success', 'Berhasil menolak data penggunaan dana');
    }
}
