<?php

namespace App\Http\Services;

use App\Models\PenelitianDtps;

class PenelitianDTPSService
{
    public function __construct
    (
        public PenelitianDtps $penelitianDtps,
        public LogActivityService $logActivityService,
    )
    {
    }

    public function showPenelitianDTPS()
    {
        $data = $this->penelitianDtps->when(auth()->user()->role == 'dosen', function ($query) {
            $query->where('user_id', auth()->id());
        })
            ->get()->map(function ($item, $key) {
            return [
                $key + 1,
                $item->sumber_pembiayaan,
                $item->ts,
                $item->ts1,
                $item->ts2,
                $item->ts + $item->ts1 + $item->ts2,
                is_approved($item->is_approve),
                view('components.buttons', [
                    'routeEdit' => route('kepala-prodi.sumber-daya-manusia.penelitian-dtps.edit', $item->id),
                    'routeDelete' => route('kepala-prodi.sumber-daya-manusia.penelitian-dtps.delete', $item->id),
                    'isApproved' => $item->is_approve,
                    "routeApprove" => route('kepala-prodi.sumber-daya-manusia.penelitian-dtps.approve', $item->id),
                    "routeReject" => route('kepala-prodi.sumber-daya-manusia.penelitian-dtps.reject', $item->id),
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

        $ts = $this->penelitianDtps->when(auth()->user()->role == 'dosen', function ($query) {
            $query->where('user_id', auth()->id());
        })->sum('ts');

        $ts1 = $this->penelitianDtps->when(auth()->user()->role == 'dosen', function ($query) {
            $query->where('user_id', auth()->id());
        })->sum('ts1');

        $ts2 = $this->penelitianDtps->when(auth()->user()->role == 'dosen', function ($query) {
            $query->where('user_id', auth()->id());
        })->sum('ts2');

        $total = $ts + $ts1 + $ts2;

        $config = [
            "heads" => $heads,
            "data" => $data,
            "ts" => $ts,
            "ts1" => $ts1,
            "ts2" => $ts2,
            "total" => $total
        ];

        return view("penelitian-dtps.index", compact('config'));
    }

    public function createPenelitianDTPS()
    {
        return view("penelitian-dtps.create");
    }

    public function storePenelitianDTPS($data)
    {
        $this->penelitianDtps->create($data);
        $this->logActivityService->log(["tambah", "Menambahkan data penelitian DTPS $data[sumber_pembiayaan]"]);
        return redirect()->route('kepala-prodi.sumber-daya-manusia.penelitian-dtps');
    }

    public function editPenelitianDTPS($id)
    {
        $data = $this->penelitianDtps->find($id);
        return view("penelitian-dtps.edit", compact('data'));
    }

    public function updatePenelitianDTPS($data, $id)
    {
        $this->penelitianDtps->find($id)->update($data);
        $this->logActivityService->log(["ubah", "Mengubah data penelitian DTPS $data[sumber_pembiayaan]"]);
        return redirect()->route('kepala-prodi.sumber-daya-manusia.penelitian-dtps');
    }

    public function deletePenelitianDTPS($id)
    {
        $this->penelitianDtps->find($id)->delete();
        $this->logActivityService->log(["hapus", "Menghapus data penelitian DTPS"]);
        return redirect()->route('kepala-prodi.sumber-daya-manusia.penelitian-dtps');
    }

    public function approvePenelitianDTPS($id)
    {
        $this->penelitianDtps->find($id)->update(['is_approve' => STATUS_APPROVED]);
        $this->logActivityService->log(["setujui", "Menyetujui data penelitian DTPS"]);
        return redirect()->route('kepala-prodi.sumber-daya-manusia.penelitian-dtps');
    }

    public function rejectPenelitianDTPS($id)
    {
        $this->penelitianDtps->find($id)->update(['is_approve' => STATUS_REJECTED]);
        $this->logActivityService->log(["tolak", "Menolak data penelitian DTPS"]);
        return redirect()->route('kepala-prodi.sumber-daya-manusia.penelitian-dtps');
    }

}
