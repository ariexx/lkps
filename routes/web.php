<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

//fallback route
Route::fallback(function () {
    abort(404);
});

//index route
Route::get('/', function () {
    return view('auth.login');
});

//login and register route
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

//login using gate for redirecting user to specific dashboard based on their role
Route::post('/login', [AuthController::class, 'postLogin']);

Route::get('/register', function () {
    return view('auth.register');
});

Route::post('/register', [AuthController::class, 'postRegister']);

//route for dosen
Route::prefix('dosen')->as('dosen.')->group(function () {
    Route::middleware('is-authenticated')->group(function () {
        Route::get('/dashboard', function () {
            return view('dosen.dashboard');
        })->name('dashboard');
    });
});
