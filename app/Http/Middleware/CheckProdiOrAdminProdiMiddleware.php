<?php

// app/Http/Middleware/CheckProdiOrAdminProdi.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckProdiOrAdminProdiMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if ($user && ($user->can('prodi') || $user->can('admin_prodi'))) {
            return $next($request);
        }

        return redirect('/'); // or abort(403);
    }
}
