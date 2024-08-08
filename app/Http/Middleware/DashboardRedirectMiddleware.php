<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class DashboardRedirectMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        //check if user has in session
        if ($request->session()->has('user')) {
            //check by role
            $role = $request->session()->get('user')->role;
            return match ($role) {
                User::superadmin => redirect()->route('superadmin.dashboard'),
                User::adminprodi => redirect()->route('adminprodi.dashboard'),
                User::dosen => redirect()->route('dosen.dashboard'),
                User::prodi => redirect()->route('kepala-prodi.dashboard'),
                default => redirect()->route('login'),
            };
        }

        return redirect()->route('login');
    }
}
