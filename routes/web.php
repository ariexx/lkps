<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileDosenController;
use Illuminate\Support\Facades\Route;

//fallback route
Route::fallback(function () {
    abort(404);
});

//index route
Route::middleware(['is-authenticated'])->get('/', function (App\Http\Middleware\DashboardRedirectMiddleware $middleware) {
    return $middleware->handle(request(), function ($request) {
        return redirect()->route('index');
    });
})->name('index');

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

//logout route
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//route for dosen
Route::prefix('dosen')->as('dosen.')->group(function () {
    Route::middleware(['is-authenticated', 'role-check'])->group(function () {
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
            Route::post('/ewmp-dosen-tetap-perguruan-tinggi/store', [ProfileDosenController::class, 'storeEWMPDosenTetapPerguruanTinggi'])->name('ewmp-dosen-tetap-perguruan-tinggi.store');
            Route::get('/ewmp-dosen-tetap-perguruan-tinggi', [ProfileDosenController::class, 'showEWMPDosenTetapPerguruanTinggi'])->name('ewmp-dosen-tetap-perguruan-tinggi');
            Route::get('/ewmp-dosen-tetap-perguruan-tinggi/create', function () {
                return view('dosen.profile.create-ewmp-dosen-tetap-perguruan-tinggi');
            })->name('ewmp-dosen-tetap-perguruan-tinggi.create');
            Route::get('/ewmp-dosen-tetap-perguruan-tinggi/edit/{id}', [ProfileDosenController::class, 'editEWMPDosenTetapPerguruanTinggi'])->name('ewmp-dosen-tetap-perguruan-tinggi.edit');
            Route::put('/ewmp-dosen-tetap-perguruan-tinggi/update/{id}', [ProfileDosenController::class, 'updateEWMPDosenTetapPerguruanTinggi'])->name('ewmp-dosen-tetap-perguruan-tinggi.update');

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

//route for superadmin
Route::prefix('superadmin')->as('superadmin.')->group(function () {
    Route::middleware(['is-authenticated'])->group(function () {
        Route::middleware(['role-check'])->group(function () {
            Route::get('/dashboard', function () {
                return view('superadmin.dashboard');
            })->name('dashboard');

            //Fitur: Kerjasama Tridharma
            Route::prefix('tata-pamong-tata-kelola-kerjasama')->as('tata-pamong-tata-kelola-kerjasama.')->group(function () {
                Route::get('/pendidikan', [\App\Http\Controllers\TridharmaController::class, 'showPendidikan'])->name('kerjasama-pendidikan');
                Route::get('/pendidikan/create', [\App\Http\Services\Tridharma\PendidikanService::class, 'createKerjasamaPendidikan'])->name('kerjasama-pendidikan.create');
                Route::post('/pendidikan/store', [\App\Http\Controllers\TridharmaController::class, 'storePendidikan'])->name('kerjasama-pendidikan.store');
                Route::get('/pendidikan/approve/{id}', [\App\Http\Controllers\TridharmaController::class, 'approveFileKerjasamaPendidikan'])->name('kerjasama-pendidikan.approve');
                Route::get('/pendidikan/edit/{id}', [\App\Http\Controllers\TridharmaController::class, 'editKerjasamaPendidikan'])->name('kerjasama-pendidikan.edit');
                Route::put('/pendidikan/update/{id}', [\App\Http\Controllers\TridharmaController::class, 'updateKerjasamaPendidikan'])->name('kerjasama-pendidikan.update');
                Route::get('/pendidikan/delete/{id}', [\App\Http\Controllers\TridharmaController::class, 'delete'])->name('kerjasama-pendidikan.delete');

                //Fitur: Kerjasama Penelitian
                Route::get('/penelitian', [\App\Http\Controllers\TridharmaController::class, 'showPenelitian'])->name('kerjasama-penelitian');
                Route::get('/penelitian/create', [\App\Http\Services\Tridharma\PenelitianService::class, 'createKerjasamaPenelitian'])->name('kerjasama-penelitian.create');
                Route::post('/penelitian/store', [\App\Http\Controllers\TridharmaController::class, 'storePenelitian'])->name('kerjasama-penelitian.store');
                Route::get('/penelitian/approve/{id}', [\App\Http\Controllers\TridharmaController::class, 'approveFileKerjasamaPenelitian'])->name('kerjasama-penelitian.approve');
                Route::get('/penelitian/edit/{id}', [\App\Http\Controllers\TridharmaController::class, 'editKerjasamaPenelitian'])->name('kerjasama-penelitian.edit');
                Route::put('/penelitian/update/{id}', [\App\Http\Controllers\TridharmaController::class, 'updateKerjasamaPenelitian'])->name('kerjasama-penelitian.update');
                Route::get('/penelitian/delete/{id}', [\App\Http\Controllers\TridharmaController::class, 'delete'])->name('kerjasama-penelitian.delete');
            });
        });
    });
});
