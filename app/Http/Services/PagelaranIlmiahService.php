<?php

namespace App\Http\Services;

use App\Models\PagelaranIlmiah;

class PagelaranIlmiahService
{
    public function __construct(
        public PagelaranIlmiah $pagelaranIlmiah,
        public LogActivityService $logActivityService
    )
    {
    }

    public function showPagelaranIlmiahDTPS()
    {
        $data = $this->pagelaranIlmiah->get()->map(function ($item, $key) {
            return [
                $key + 1,
                $item->jenis_publikasi,
                $item->ts,
                $item->ts1,
                $item->ts2,
                $item->ts + $item->ts1 + $item->ts2,
                is_approved($item->is_approve),
                view('components.buttons', [
                    'routeEdit' => route('kepala-prodi.sumber-daya-manusia.pagelaran-ilmiah-dtps.edit', $item->id),
                    'routeDelete' => route('kepala-prodi.sumber-daya-manusia.pagelaran-ilmiah-dtps.delete', $item->id),
                    'isApproved' => $item->is_approve,
                    "routeApprove" => route('kepala-prodi.sumber-daya-manusia.pagelaran-ilmiah-dtps.approve', $item->id),
                    "routeReject" => route('kepala-prodi.sumber-daya-manusia.pagelaran-ilmiah-dtps.reject', $item->id),
                ])->render()
            ];
        })->toArray();

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

        $all = $this->pagelaranIlmiah->get();

        $config = [
            "heads" => $heads,
            "data" => $data,
            "ts1" => $all->sum('ts1'),
            "ts2" => $all->sum('ts2'),
            "ts" => $all->sum('ts'),
            "total" => $all->sum('ts') + $all->sum('ts1') + $all->sum('ts2')
        ];

        return view('pagelaran-ilmiah.index', compact('config'));
    }

    public function createPagelaranIlmiahDTPS()
    {
        return view('pagelaran-ilmiah.create');
    }

    public function storePagelaranIlmiahDTPS(\Illuminate\Http\Request $request)
    {
        $all = $request->all();
        $all['is_approve'] = 0;
        $this->pagelaranIlmiah->create($all);
        $this->logActivityService->log(["tambah", "Menambahkan data pagelaran ilmiah dtps $request[jenis_publikasi]"]);

        return redirect()->route('kepala-prodi.sumber-daya-manusia.pagelaran-ilmiah-dtps')->with('success', 'Berhasil menambahkan data pagelaran ilmiah dtps');
    }

    public function editPagelaranIlmiahDTPS($id)
    {
        $data = $this->pagelaranIlmiah->find($id);
        return view('pagelaran-ilmiah.edit', compact('data'));
    }

    public function updatePagelaranIlmiahDTPS(\Illuminate\Http\Request $request, $id)
    {
        $data = $this->pagelaranIlmiah->find($id);
        $data->update($request->all());
        $this->logActivityService->log(["ubah", "Mengubah data pagelaran ilmiah dtps $request[jenis_publikasi]"]);

        return redirect()->route('kepala-prodi.sumber-daya-manusia.pagelaran-ilmiah-dtps')->with('success', 'Berhasil mengubah data pagelaran ilmiah dtps');
    }

    public function deletePagelaranIlmiahDTPS($id)
    {
        $data = $this->pagelaranIlmiah->find($id);
        $data->delete();
        $this->logActivityService->log(["hapus", "Menghapus data pagelaran ilmiah dtps $data[jenis_publikasi]"]);

        return redirect()->route('kepala-prodi.sumber-daya-manusia.pagelaran-ilmiah-dtps')->with('success', 'Berhasil menghapus data pagelaran ilmiah dtps');
    }

    public function approvePagelaranIlmiahDTPS($id)
    {
        $data = $this->pagelaranIlmiah->find($id);
        $data->update(['is_approve' => STATUS_APPROVED]);
        $this->logActivityService->log(["setujui", "Menyetujui data pagelaran ilmiah dtps $data[jenis_publikasi]"]);

        return redirect()->route('kepala-prodi.sumber-daya-manusia.pagelaran-ilmiah-dtps')->with('success', "Berhasil approve data pagelaran ilmiah dtps");
    }

    public function rejectPagelaranIlmiahDTPS($id)
    {
        $data = $this->pagelaranIlmiah->find($id);
        $data->update(['is_approve' => STATUS_REJECTED]);
        $this->logActivityService->log(["tolak", "Menolak data pagelaran ilmiah dtps $data[jenis_publikasi]"]);

        return redirect()->route('kepala-prodi.sumber-daya-manusia.pagelaran-ilmiah-dtps')->with('success', "Berhasil reject data pagelaran ilmiah dtps");
    }
}
