<?php

namespace App\Http\Controllers;

use App\Models\LogActivity;

class LogAktivitasController extends Controller
{
    public function showLogAktivitas()
    {
        $data = LogActivity::orderByDesc('created_at')->get()->map(function ($item, $key) {
            return [
                $key + 1,
                $item->user->name,
                $this->label($item->activity),
                $item->description,
                $item->created_at->format('d-m-Y H:i:s'),
            ];
        })->toArray();

        $heads = [
            'No',
            'Nama User',
            'Aktivitas',
            'Deskripsi',
            'Waktu',
        ];

        $config = [
            'heads' => $heads,
            'data' => $data,
            'title' => 'Log Aktivitas',
        ];

        return view('log-aktivitas.index', compact('config'));
    }

    private function label($activity)
    {
        $label = '';
        switch ($activity) {
            case 'tambah':
                $label = '<span class="badge badge-success">Tambah</span>';
                break;
            case 'edit':
            case 'update':
            case 'ubah':
            $label = '<span class="badge badge-warning">Edit</span>';
                break;
            case 'approve':
            case 'setujui':
            case 'setuji':
                $label = '<span class="badge badge-primary">Disetujui</span>';
                break;
            case 'reject':
            case 'tolak':
            case 'menolak':
                $label = '<span class="badge badge-danger">Ditolak</span>';
                break;
            case 'delete':
            case 'hapus':
                $label = '<span class="badge badge-danger">Hapus</span>';
                break;
        }

        return $label;
    }
}
