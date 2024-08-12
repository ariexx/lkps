<?php

namespace App\Http\Services\Mahasiswa;

use App\Models\SeleksiMahasiswa;

class SeleksiMahasiswaService
{
    public function __construct(
        public SeleksiMahasiswa $seleksiMahasiswa
    )
    {
    }

    public function createSeleksiMahasiswa()
    {
        return view('kepala-prodi.seleksi-mahasiswa.create');
    }

    public function showSeleksiMahasiswa()
    {
        $data = $this->seleksiMahasiswa->get()->map(function ($item, $key) {
            return [
                $key + 1,
                $item->tahun_akademik,
                $item->daya_tampung,
                $item->pendaftar,
                $item->lulus_seleksi,
                $item->reguler_baru,
                $item->transfer_baru,
                $item->reguler_aktif,
                $item->transfer_aktif,
                is_approved($item->is_approve),
                view('components.buttons', [
                    'routeEdit' => route('kepala-prodi.mahasiswa.seleksi-mahasiswa.edit', $item->id),
                    'routeDelete' => route('kepala-prodi.mahasiswa.seleksi-mahasiswa.delete', $item->id),
                    'routeApprove' => route('kepala-prodi.mahasiswa.seleksi-mahasiswa.approve', $item->id),
                    'routeReject' => route('kepala-prodi.mahasiswa.seleksi-mahasiswa.reject', $item->id),
                    'isApproved' => $item->is_approve,
                ])->render()
            ];
        })->toArray();

        $heads = [
            'No',
            'Tahun Akademik',
            'Daya Tampung',
            'Pendaftar',
            'Lulus Seleksi',
            'Reguler Baru',
            'Transfer Baru',
            'Reguler Aktif',
            'Transfer Aktif',
            'Status',
            'Aksi'
        ];

        $config = [
            'data' => $data,
            'heads' => $heads
        ];

        $total = [
            'pendaftar' => $this->seleksiMahasiswa->getTotalPendaftarAttribute(),
            'lulus_seleksi' => $this->seleksiMahasiswa->getTotalLulusSeleksiAttribute(),
            'reguler_baru' => $this->seleksiMahasiswa->getTotalRegulerBaruAttribute(),
            'transfer_baru' => $this->seleksiMahasiswa->getTotalTransferBaruAttribute(),
            'reguler_aktif' => $this->seleksiMahasiswa->getTotalRegulerAktifAttribute(),
            'transfer_aktif' => $this->seleksiMahasiswa->getTotalTransferAktifAttribute(),
        ];

        return view('kepala-prodi.seleksi-mahasiswa.index', compact('config', 'heads', 'total'));
    }

    public function store($data)
    {
        $saved = $this->seleksiMahasiswa->create($data);
        if(!$saved) {
            return redirect()->back()->with('error', 'Data gagal disimpan');
        }

        return redirect()->route('kepala-prodi.mahasiswa.seleksi-mahasiswa')->with('success', 'Data berhasil disimpan');
    }

    public function update($data, $id)
    {
        $updated = $this->seleksiMahasiswa->find($id)->update($data);
        if(!$updated) {
            return redirect()->back()->with('error', 'Data gagal diupdate');
        }

        return redirect()->route('kepala-prodi.mahasiswa.seleksi-mahasiswa')->with('success', 'Data berhasil diupdate');
    }

    public function delete($id)
    {
        $deleted = $this->seleksiMahasiswa->find($id)->delete();
        if(!$deleted) {
            return redirect()->back()->with('error', 'Data gagal dihapus');
        }

        return redirect()->route('kepala-prodi.mahasiswa.seleksi-mahasiswa')->with('success', 'Data berhasil dihapus');
    }

    public function edit($id)
    {
        $data = $this->seleksiMahasiswa->find($id);
        return view('kepala-prodi.seleksi-mahasiswa.edit', compact('data'));
    }

    public function create()
    {
        return view('kepala-prodi.seleksi-mahasiswa.create');
    }

    public function approveSeleksiMahasiswa($id)
    {
        $data = $this->seleksiMahasiswa->find($id);
        $data->is_approve = STATUS_APPROVED;
        $data->save();

        return redirect()->route('kepala-prodi.mahasiswa.seleksi-mahasiswa')->with('success', 'Data berhasil diapprove');
    }

    public function rejectSeleksiMahasiswa($id)
    {
        $data = $this->seleksiMahasiswa->find($id);
        $data->is_approve = STATUS_REJECTED;
        $data->save();

        return redirect()->route('kepala-prodi.mahasiswa.seleksi-mahasiswa')->with('success', 'Data berhasil direject');
    }

}
