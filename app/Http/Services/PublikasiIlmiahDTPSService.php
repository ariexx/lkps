<?php

namespace App\Http\Services;

use App\Models\PublikasiIlmiahDTPS;

class PublikasiIlmiahDTPSService
{
    public function __construct
    (
        public PublikasiIlmiahDTPS $publikasiIlmiahDTPS,
        public LogActivityService $logActivityService
    )
    {
    }

    public function showPublikasiIlmiahDTPS()
    {
        $data = $this->publikasiIlmiahDTPS->get()->map(function ($item, $key) {
            return [
                $key + 1,
                $item->jenis_publikasi,
                $item->ts,
                $item->ts1,
                $item->ts2,
                $item->ts1 + $item->ts2 + $item->ts,
                is_approved($item->is_approve),
                view('components.buttons', [
                    'routeApprove' => route('kepala-prodi.sumber-daya-manusia.publikasi-ilmiah-dtps.approve', $item->id),
                    'routeReject' => route('kepala-prodi.sumber-daya-manusia.publikasi-ilmiah-dtps.reject', $item->id),
                    'isApproved' => $item->is_approve,
                    'routeDelete' => route('kepala-prodi.sumber-daya-manusia.publikasi-ilmiah-dtps.delete', $item->id),
                    'routeEdit' => route('kepala-prodi.sumber-daya-manusia.publikasi-ilmiah-dtps.edit', $item->id),
                ])->render()
            ];
        });

        $heads = [
            'No',
            'Jenis Publikasi',
            'TS',
            'TS1',
            'TS2',
            'Jumlah',
            'Status',
            'Aksi'
        ];

        $config = [
            "data" => $data,
            "heads" => $heads,
            "ts" => $this->publikasiIlmiahDTPS->sum('ts'),
            "ts1" => $this->publikasiIlmiahDTPS->sum('ts1'),
            "ts2" => $this->publikasiIlmiahDTPS->sum('ts2'),
            "total" => $this->publikasiIlmiahDTPS->sum('ts') + $this->publikasiIlmiahDTPS->sum('ts1') + $this->publikasiIlmiahDTPS->sum('ts2')
        ];

        return view('publikasi-ilmiah-dtps.index', compact('config'));
    }

    public function createPublikasiIlmiahDTPS()
    {
        return view('publikasi-ilmiah-dtps.create');
    }

    public function storePublikasiIlmiahDTPS($request)
    {
        $this->publikasiIlmiahDTPS->create($request);
        $this->logActivityService->log(["tambah", "Berhasil menambahkan data publikasi ilmiah dtps - $request[jenis_publikasi]"]);
        return redirect()->route('kepala-prodi.sumber-daya-manusia.publikasi-ilmiah-dtps')->with('success', 'Data berhasil ditambahkan');
    }

    public function editPublikasiIlmiahDTPS($id)
    {
        $data = $this->publikasiIlmiahDTPS->find($id);
        return view('publikasi-ilmiah-dtps.edit', compact('data'));
    }

    public function updatePublikasiIlmiahDTPS($request, $id)
    {
        $this->publikasiIlmiahDTPS->find($id)->update($request);
        $this->logActivityService->log(["ubah", "Berhasil mengubah data publikasi ilmiah dtps - $request[jenis_publikasi]"]);
        return redirect()->route('kepala-prodi.sumber-daya-manusia.publikasi-ilmiah-dtps')->with('success', 'Data berhasil diubah');
    }

    public function approvePublikasiIlmiahDTPS($id)
    {
        $this->publikasiIlmiahDTPS->find($id)->update(['is_approve' => STATUS_APPROVED]);
        $this->logActivityService->log(["setujui", "Berhasil menyetujui data publikasi ilmiah dtps"]);
        return redirect()->route('kepala-prodi.sumber-daya-manusia.publikasi-ilmiah-dtps');
    }

    public function rejectPublikasiIlmiahDTPS($id)
    {
        $this->publikasiIlmiahDTPS->find($id)->update(['is_approve' => STATUS_REJECTED]);
        $this->logActivityService->log(["tolak", "Berhasil menolak data publikasi ilmiah dtps"]);
        return redirect()->route('kepala-prodi.sumber-daya-manusia.publikasi-ilmiah-dtps')->with('success', 'Data berhasil ditolak');
    }

    public function deletePublikasiIlmiahDTPS($id)
    {
        $this->publikasiIlmiahDTPS->find($id)->delete();
        $this->logActivityService->log(["hapus", "Berhasil menghapus data publikasi ilmiah dtps"]);
        return redirect()->route('kepala-prodi.sumber-daya-manusia.publikasi-ilmiah-dtps')->with('success', 'Data berhasil dihapus');
    }
}
