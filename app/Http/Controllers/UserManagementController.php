<?php

namespace App\Http\Controllers;

use App\Models\User;
use PhpParser\Node\Scalar\String_;

class UserManagementController extends Controller
{

    public function showUserManagement()
    {
        $data = User::orderByDesc('created_at')->get()->map(function ($item, $key) {
            return [
                $key + 1,
                $item->name,
                $item->username,
                $this->handleProdi($item->role),
                $item->created_at->format('d-m-Y H:i:s'),
                view('components.buttons', [
                    'routeEdit' => route('superadmin.user-management.edit', $item->id),
                    'routeDelete' => route('superadmin.user-management.delete', $item->id),
                ])->render()
            ];
        })->toArray();

        $heads = [
            'No',
            'Nama',
            'Username',
            'Role',
            'Waktu',
            'Aksi'
        ];

        $config = [
            'heads' => $heads,
            'data' => $data,
            'title' => 'User Management',
        ];

        return view('user-management.index', compact('config'));
    }

    private function handleProdi($prodi)
    {
        if($prodi == User::prodi) {
            return "Kepala Prodi";
        }

        return \Str::ucfirst($prodi);
    }

    public function createUserManagement()
    {
        return view('user-management.create');
    }

    public function storeUserManagement()
    {
        $data = request()->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return redirect()->route('superadmin.user-management')->with('success', 'User berhasil ditambahkan');
    }

    public function editUserManagement($id)
    {
        $user = User::find($id);
        return view('user-management.edit', compact('user'));
    }

    public function updateUserManagement($id)
    {
        $data = request()->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'sometimes',
            'role' => 'required'
        ]);

        if(isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        User::find($id)->update($data);

        return redirect()->route('superadmin.user-management')->with('success', 'User berhasil diubah');
    }

    public function deleteUserManagement($id)
    {
        User::find($id)->delete();
        return redirect()->route('superadmin.user-management')->with('success', 'User berhasil dihapus');
    }

}
