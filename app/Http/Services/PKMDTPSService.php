<?php

namespace App\Http\Services;

use App\Models\PkmDtps;

class PKMDTPSService
{
    public function __construct
    (
        public PkmDtps $pkmDtps,
        public LogActivityService $logActivityService,
    )
    {
    }

    public function showPKMDTPS()
    {
        $data = $this->pkmDtps->get()->map(function ($item, $key) {
            return [
                $key + 1,
                $item->sumber_pembiayaan,
                $item->ts,
                $item->ts1,
                $item->ts2,
                $item->ts + $item->ts1 + $item->ts2,
                is_approved($item->is_approve),
                view('components.buttons', [
                    'routeEdit' => route('kepala-prodi.sumber-daya-manusia.pkm-dtps.edit', $item->id),
                    'routeDelete' => route('kepala-prodi.sumber-daya-manusia.pkm-dtps.delete', $item->id),
                    'isApproved' => $item->is_approve,
                    "routeApprove" => route('kepala-prodi.sumber-daya-manusia.pkm-dtps.approve', $item->id),
                    "routeReject" => route('kepala-prodi.sumber-daya-manusia.pkm-dtps.reject', $item->id),
                ])->render()
            ];
        });

        $heads = [
            'No',
            'Sumber Pembiayaan',
            'TS',
            'TS1',
            'TS2',
            'Jumlah',
            'Status',
            'Aksi'
        ];

        $config = [
            "heads" => $heads,
            "data" => $data,
            "ts" => $this->pkmDtps->sum('ts'),
            "ts1" => $this->pkmDtps->sum('ts1'),
            "ts2" => $this->pkmDtps->sum('ts2'),
            "total" => $this->pkmDtps->sum('ts') + $this->pkmDtps->sum('ts1') + $this->pkmDtps->sum('ts2')
        ];

        return view("pkm-dtps.index", compact('config'));
    }

    public function storePKMDTPS($request)
    {
        $this->pkmDtps->create($request);
        $this->logActivityService->log(["tambah", "Menambahkan data penelitian DTPS $request[sumber_pembiayaan]"]);
        return redirect()->route('kepala-prodi.sumber-daya-manusia.pkm-dtps')->with('success', 'Data berhasil ditambahkan');
    }

    public function updatePKMDTPS($request, $id)
    {
        $this->pkmDtps->find($id)->update($request);
        $this->logActivityService->log(["ubah", "Mengubah data penelitian DTPS $request[sumber_pembiayaan]"]);
        return redirect()->route('kepala-prodi.sumber-daya-manusia.pkm-dtps')->with('success', 'Data berhasil diubah');
    }

    public function createPKMDTPS()
    {
        return view("pkm-dtps.create");
    }

    public function editPKMDTPS($id)
    {
        $data = $this->pkmDtps->find($id);
        return view("pkm-dtps.edit", compact('data'));
    }

    public function deletePKMDTPS($id)
    {
        $this->pkmDtps->find($id)->delete();
        $this->logActivityService->log(["hapus", "Menghapus data penelitian DTPS"]);
        return redirect()->route('kepala-prodi.sumber-daya-manusia.pkm-dtps')->with('success', 'Data berhasil dihapus');
    }

    public function approvePKMDTPS($id)
    {
        $this->pkmDtps->find($id)->update(['is_approve' => STATUS_APPROVED]);
        $this->logActivityService->log(["setujui", "Menyetujui data penelitian DTPS"]);
        return redirect()->route('kepala-prodi.sumber-daya-manusia.pkm-dtps')->with('success', 'Data berhasil disetujui');
    }

    public function rejectPKMDTPS($id)
    {
        $this->pkmDtps->find($id)->update(['is_approve' => STATUS_REJECTED]);
        $this->logActivityService->log(["tolak", "Menolak data penelitian DTPS"]);
        return redirect()->route('kepala-prodi.sumber-daya-manusia.pkm-dtps')->with('success', 'Data berhasil ditolak');
    }

}
