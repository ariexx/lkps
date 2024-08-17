<?php

namespace App\Http\Services;

use App\Models\EWMP;

class EWMPService
{
    public function __construct
    (
        public EWMP $ewmp,
        public LogActivityService $logActivityService
    )
    {
    }

    public function showEWMP()
    {
        $data = $this->ewmp->get()->map(function ($item, $key) {
            $buttonsView = view('components.buttons', [
                'routeEdit' => route('kepala-prodi.sumber-daya-manusia.ewmp.edit', $item->id),
                'routeDelete' => route('kepala-prodi.sumber-daya-manusia.ewmp.delete', $item->id),
                'isApproved' => $item->is_approve,
                'routeApprove' => route('kepala-prodi.sumber-daya-manusia.ewmp.approve', $item->id),
                'routeReject' => route('kepala-prodi.sumber-daya-manusia.ewmp.reject', $item->id),
            ])->render();

            // Log the rendered view for debugging
            \Log::info($buttonsView);

            return [
                $key + 1,
                $item->name,
                is_approved_bool($item->dtps),
                $item->ps_diakreditasi,
                $item->ps_lain_didalam_pt,
                $item->pt_lain_diluar_pt,
                $item->penelitian,
                $item->pkm,
                $item->tugas_tambahan,
                $item->jumlah(),
                $item->rataRata(),
                is_approved($item->is_approve),
                $buttonsView
            ];
        })->toArray();

        $heads = [
            'No',
            'Nama',
            'DTPS',
            'PS Diakreditasi',
            'PS Lain Didalam PT',
            'PT Lain Diluar PT',
            'Penelitian',
            'PKM',
            'Tugas Tambahan',
            'Jumlah',
            'Rata-rata SKS',
            'Status',
            'Aksi'
        ];

        $config = [
            "heads" => $heads,
            "data" => $data,
            "rata_rata_jumlah" => $this->ewmp->rataRataJumlah(),
            "rata_rata_sks" => $this->ewmp->rataRataSKS(),
        ];

        return view("kepala-prodi.ewmp.index", compact("config"));
    }

    public function createEWMP()
    {
        return view("kepala-prodi.ewmp.create");
    }

    public function storeEWMP(array $all)
    {
        \DB::beginTransaction();
        try {
            if(isset($all['dtps'])) {
                $all['dtps'] = true;
            }else{
                $all['dtps'] = false;
            }

            $this->ewmp->create($all);
            $this->logActivityService->log([
                "tambah", "Menambahkan data EWMP " . $all["name"]
            ]);
            \DB::commit();
            return redirect()->route("kepala-prodi.sumber-daya-manusia.ewmp")->with("success", "Data berhasil ditambahkan");
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with("error", "Terjadi kesalahan " . $e->getMessage());
        }
    }

    public function updateEWMP(array $all, $id)
    {
        \DB::beginTransaction();
        try {
            $ewmp = $this->ewmp->find($id);
            if(isset($all['dtps'])) {
                $all['dtps'] = true;
            }else{
                $all['dtps'] = false;
            }
            $ewmp->update($all);
            $this->logActivityService->log([
                "update", "Mengubah data EWMP " . $ewmp->name
            ]);
            \DB::commit();
            return redirect()->route("kepala-prodi.sumber-daya-manusia.ewmp")->with("success", "Data berhasil diubah");
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with("error", "Terjadi kesalahan " . $e->getMessage());
        }
    }

    public function editEWMP($id)
    {
        $ewmp = $this->ewmp->find($id);
        return view("kepala-prodi.ewmp.edit", compact("ewmp"));
    }

    public function deleteEWMP($id)
    {
        \DB::beginTransaction();
        try {
            $ewmp = $this->ewmp->find($id);
            $ewmp->delete();
            $this->logActivityService->log([
                "hapus", "Menghapus data EWMP " . $ewmp->name
            ]);
            \DB::commit();
            return redirect()->route("kepala-prodi.sumber-daya-manusia.ewmp")->with("success", "Data berhasil dihapus");
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with("error", "Terjadi kesalahan " . $e->getMessage());
        }
    }

    public function approveEWMP($id)
    {
        \DB::beginTransaction();
        try {
            $ewmp = $this->ewmp->find($id);
            $ewmp->update(["is_approve" => STATUS_APPROVED]);
            $this->logActivityService->log([
                "approve", "Menyetujui data EWMP " . $ewmp->name
            ]);
            \DB::commit();
            return redirect()->route("kepala-prodi.sumber-daya-manusia.ewmp")->with("success", "Data berhasil disetujui");
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with("error", "Terjadi kesalahan " . $e->getMessage());
        }
    }

    public function rejectEWMP($id)
    {
        \DB::beginTransaction();
        try {
            $ewmp = $this->ewmp->find($id);
            $ewmp->update(["is_approve" => STATUS_REJECTED]);
            $this->logActivityService->log([
                "reject", "Menolak data EWMP " . $ewmp->name
            ]);
            \DB::commit();
            return redirect()->route("kepala-prodi.sumber-daya-manusia.ewmp")->with("success", "Data berhasil ditolak");
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with("error", "Terjadi kesalahan " . $e->getMessage());
        }
    }


}
