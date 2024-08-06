<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Gate::define('superadmin', function (User $user) {
            return $user->isSuperadmin();
        });

        \Gate::define('admin_prodi', function (User $user) {
            return $user->isAdminProdi();
        });

        \Gate::define('dosen', function (User $user) {
            return $user->isDosen();
        });

        \Gate::define('prodi', function (User $user) {
            return $user->isProdi();
        });
    }
}
