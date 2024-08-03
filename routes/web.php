<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('auth.login');
});

//login using gate for redirecting user to specific dashboard based on their role
Route::middleware('dashboard-redirect')->post('/login', [AuthController::class, 'postLogin']);

Route::get('/register', function () {
    return view('auth.register');
});

Route::post('/register', [AuthController::class, 'postRegister']);

Route::get('/debug', function () {
    phpinfo();
});
