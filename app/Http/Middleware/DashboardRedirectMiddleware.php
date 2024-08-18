<?php

// app/Http/Middleware/DashboardRedirectMiddleware.php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class DashboardRedirectMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if user is in session
        if ($request->session()->has('user')) {
            // Retrieve user role from session
            $role = $request->session()->get('user')->role;

            // Redirect based on user role
            return match ($role) {
                User::superadmin => $this->redirectIfNotCurrentRoute($request, 'superadmin.dashboard', $next),
                User::adminprodi => $this->redirectIfNotCurrentRoute($request, 'admin-prodi.dashboard', $next),
                User::dosen => $this->redirectIfNotCurrentRoute($request, 'dosen.dashboard', $next),
                User::prodi => $this->redirectIfNotCurrentRoute($request, 'kepala-prodi.dashboard', $next),
                default => redirect()->route('login'),
            };
        }

        // Redirect to login if no user in session
        return redirect()->route('login');
    }

    private function redirectIfNotCurrentRoute(Request $request, string $route, Closure $next)
    {
        if ($request->route()->getName() !== $route) {
            return redirect()->route($route);
        }

        return $next($request);
    }
}
