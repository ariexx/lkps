<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileDosenController;
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

        #profile dosen routes
        Route::prefix('profile')->group(function () {
            //Dosen tetap perguruan tinggi
            Route::post('/dosen-tetap-perguruan-tinggi/store', [ProfileDosenController::class, 'storeDosenTetapPerguruanTinggi'])->name('dosen-tetap-perguruan-tinggi.store');
            Route::get('/dosen-tetap-perguruan-tinggi', [ProfileDosenController::class, 'showDosenTetapPerguruanTinggi'])->name('dosen-tetap-perguruan-tinggi');
            Route::get('/dosen-tetap-perguruan-tinggi/create', function () {
                return view('dosen.profile.create-dosen-tetap-perguruan-tinggi');
            })->name('dosen-tetap-perguruan-tinggi.create');
            Route::get('/dosen-tetap-perguruan-tinggi/edit/{id}', [ProfileDosenController::class, 'editDosenTetapPerguruanTinggi'])->name('dosen-tetap-perguruan-tinggi.edit');
            Route::put('/dosen-tetap-perguruan-tinggi/update/{id}', [ProfileDosenController::class, 'updateDosenTetapPerguruanTinggi'])->name('dosen-tetap-perguruan-tinggi.update');


            //EWMP dosen tetap perguruan tinggi

            //Dosen Industri/Praktisi
            Route::post('/dosen-industri-praktisi/store', [ProfileDosenController::class, 'storeDosenIndustriPraktisi'])->name('dosen-industri-praktisi.store');
            Route::get('/dosen-industri-praktisi', [ProfileDosenController::class, 'showDosenIndustriPraktisi'])->name('dosen-industri-praktisi');
            Route::get('/dosen-industri-praktisi/create', function () {
                return view('dosen.profile.create-dosen-industri-praktisi');
            })->name('dosen-industri-praktisi.create');

            //Dosen Pembimbing Utama Tugas Akhir
            Route::post('/dosen-pembimbing-utama-tugas-akhir/store', [ProfileDosenController::class, 'storeDosenPembimbingUtamaTugasAkhir'])->name('dosen-pembimbing-utama-tugas-akhir.store');
            Route::get('/dosen-pembimbing-utama-tugas-akhir', [ProfileDosenController::class, 'showDosenPembimbingUtamaTugasAkhir'])->name('dosen-pembimbing-utama-tugas-akhir');
            Route::get('/dosen-pembimbing-utama-tugas-akhir/create', function () {
                return view('dosen.profile.create-dosen-pembimbing-utama-tugas-akhir');
            })->name('dosen-pembimbing-utama-tugas-akhir.create');
            Route::get('/dosen-pembimbing-utama-tugas-akhir/edit/{id}', [ProfileDosenController::class, 'editDosenPembimbingUtamaTugasAkhir'])->name('dosen-pembimbing-utama-tugas-akhir.edit');
            Route::put('/dosen-pembimbing-utama-tugas-akhir/update/{id}', [ProfileDosenController::class, 'updateDosenPembimbingUtamaTugasAkhir'])->name('dosen-pembimbing-utama-tugas-akhir.update');

            //Dosen Tidak Tetap
            Route::post('/dosen-tidak-tetap/store', [ProfileDosenController::class, 'storeDosenTidakTetap'])->name('dosen-tidak-tetap.store');
            Route::get('/dosen-tidak-tetap', [ProfileDosenController::class, 'showDosenTidakTetap'])->name('dosen-tidak-tetap');
            Route::get('/dosen-tidak-tetap/create', function () {
                return view('dosen.profile.create-dosen-tidak-tetap');
            })->name('dosen-tidak-tetap.create');
        });
    });
});
