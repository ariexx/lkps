<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleCheckMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (session()->has('user')) {
            // Check if the user has the superadmin role
            if (session('user')->role === 'superadmin') {
                return $next($request);
            }

            // Check if the user has the admin_prodi role
            if (session('user')->role === 'admin_prodi') {
                return $next($request);
            }

            // Check if the user has the dosen role
            if (session('user')->role === 'dosen') {
                return $next($request);
            }

            // Check if the user has the prodi role
            if (session('user')->role === 'prodi') {
                return $next($request);
            }
        }

        // Redirect the user to the login page if they are not authenticated
        return redirect()->route('login');
    }
}
