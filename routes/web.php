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
        });
    });
});

//route for Kepala Prodi
Route::prefix('kepala-prodi')->as('kepala-prodi.')->group(function () {
    Route::middleware(['is-authenticated'])->group(function () {
        Route::middleware(['role-check'])->group(function () {
            Route::get('/dashboard', function () {
                return view('kepala-prodi.dashboard');
            })->name('dashboard');

            //Fitur: Kerjasama Tridharma
            Route::prefix('tata-pamong-tata-kelola-kerjasama')->as('tata-pamong-tata-kelola-kerjasama.')->group(function () {
                Route::get('/pendidikan', [\App\Http\Controllers\TridharmaController::class, 'showPendidikan'])->name('kerjasama-pendidikan');
                Route::get('/pendidikan/create', [\App\Http\Services\Tridharma\PendidikanService::class, 'createKerjasamaPendidikan'])->name('kerjasama-pendidikan.create');
                Route::post('/pendidikan/store', [\App\Http\Controllers\TridharmaController::class, 'storePendidikan'])->name('kerjasama-pendidikan.store');
                Route::put('/pendidikan/approve/{id}', [\App\Http\Controllers\TridharmaController::class, 'approveFileKerjasamaPendidikan'])->name('kerjasama-pendidikan.approve');
                Route::put('/pendidikan/reject/{id}', [\App\Http\Controllers\TridharmaController::class, 'rejectFileKerjasamaPendidikan'])->name('kerjasama-pendidikan.reject');
                Route::get('/pendidikan/edit/{id}', [\App\Http\Controllers\TridharmaController::class, 'editKerjasamaPendidikan'])->name('kerjasama-pendidikan.edit');
                Route::put('/pendidikan/update/{id}', [\App\Http\Controllers\TridharmaController::class, 'updateKerjasamaPendidikan'])->name('kerjasama-pendidikan.update');
                Route::delete('/pendidikan/delete/{id}', [\App\Http\Controllers\TridharmaController::class, 'deleteKerjasamaPendidikan'])->name('kerjasama-pendidikan.delete');

                //Fitur: Kerjasama Penelitian
                Route::get('/penelitian', [\App\Http\Controllers\TridharmaController::class, 'showPenelitian'])->name('kerjasama-penelitian');
                Route::get('/penelitian/create', [\App\Http\Services\Tridharma\PenelitianService::class, 'createKerjasamaPenelitian'])->name('kerjasama-penelitian.create');
                Route::post('/penelitian/store', [\App\Http\Controllers\TridharmaController::class, 'storePenelitian'])->name('kerjasama-penelitian.store');
                Route::put('/penelitian/approve/{id}', [\App\Http\Controllers\TridharmaController::class, 'approveFileKerjasamaPenelitian'])->name('kerjasama-penelitian.approve');
                Route::put('/penelitian/reject/{id}', [\App\Http\Controllers\TridharmaController::class, 'rejectFileKerjasamaPenelitian'])->name('kerjasama-penelitian.reject');
                Route::get('/penelitian/edit/{id}', [\App\Http\Controllers\TridharmaController::class, 'editPenelitian'])->name('kerjasama-penelitian.edit');
                Route::put('/penelitian/update/{id}', [\App\Http\Controllers\TridharmaController::class, 'updateKerjasamaPenelitian'])->name('kerjasama-penelitian.update');
                Route::delete('/penelitian/delete/{id}', [\App\Http\Controllers\TridharmaController::class, 'deleteKerjasamaPenelitian'])->name('kerjasama-penelitian.delete');

                //Fitur: Kerjasama Pengabdian Masyarakat
                Route::get('/pengabdian-masyarakat', [\App\Http\Controllers\TridharmaController::class, 'showPengabdianMasyarakat'])->name('pengabdian-masyarakat');
                Route::get('/pengabdian-masyarakat/create', [\App\Http\Controllers\TridharmaController::class, 'createPengabdianMasyarakat'])->name('pengabdian-masyarakat.create');
                Route::post('/pengabdian-masyarakat/store', [\App\Http\Controllers\TridharmaController::class, 'storePengabdianMasyarakat'])->name('pengabdian-masyarakat.store');
                Route::put('/pengabdian-masyarakat/approve/{id}', [\App\Http\Controllers\TridharmaController::class, 'approveFilePengabdianMasyarakat'])->name('pengabdian-masyarakat.approve');
                Route::put('/pengabdian-masyarakat/reject/{id}', [\App\Http\Controllers\TridharmaController::class, 'rejectFilePengabdianMasyarakat'])->name('pengabdian-masyarakat.reject');
                Route::get('/pengabdian-masyarakat/edit/{id}', [\App\Http\Controllers\TridharmaController::class, 'editPengabdianMasyarakat'])->name('pengabdian-masyarakat.edit');
                Route::put('/pengabdian-masyarakat/update/{id}', [\App\Http\Controllers\TridharmaController::class, 'updatePengabdianMasyarakat'])->name('pengabdian-masyarakat.update');
                Route::delete('/pengabdian-masyarakat/delete/{id}', [\App\Http\Controllers\TridharmaController::class, 'deletePengabdianMasyarakat'])->name('pengabdian-masyarakat.delete');

            });

            //Fitur: Mahasiswa
            Route::prefix('mahasiswa')->as('mahasiswa.')->group(function () {
                // Seleksi Mahasiswa
                Route::get('/seleksi-mahasiswa', [\App\Http\Controllers\MahasiswaController::class, 'showSeleksiMahasiswa'])->name('seleksi-mahasiswa');
                Route::post('/seleksi-mahasiswa/store', [\App\Http\Controllers\MahasiswaController::class, 'storeSeleksiMahasiswa'])->name('seleksi-mahasiswa.store');
                Route::get('/seleksi-mahasiswa/edit/{id}', [\App\Http\Controllers\MahasiswaController::class, 'editSeleksiMahasiswa'])->name('seleksi-mahasiswa.edit');
                Route::put('/seleksi-mahasiswa/update/{id}', [\App\Http\Controllers\MahasiswaController::class, 'updateSeleksiMahasiswa'])->name('seleksi-mahasiswa.update');
                Route::delete('/seleksi-mahasiswa/delete/{id}', [\App\Http\Controllers\MahasiswaController::class, 'deleteSeleksiMahasiswa'])->name('seleksi-mahasiswa.delete');
                Route::get('/seleksi-mahasiswa/create', [\App\Http\Controllers\MahasiswaController::class, 'createSeleksiMahasiswa'])->name('seleksi-mahasiswa.create');

                // Mahasiswa Asing
                Route::get('/mahasiswa-asing', [\App\Http\Controllers\MahasiswaController::class, 'showMahasiswaAsing'])->name('mahasiswa-asing');
                Route::post('/mahasiswa-asing/store', [\App\Http\Controllers\MahasiswaController::class, 'storeMahasiswaAsing'])->name('mahasiswa-asing.store');
                Route::get('/mahasiswa-asing/edit/{id}', [\App\Http\Controllers\MahasiswaController::class, 'editMahasiswaAsing'])->name('mahasiswa-asing.edit');
                Route::put('/mahasiswa-asing/update/{id}', [\App\Http\Controllers\MahasiswaController::class, 'updateMahasiswaAsing'])->name('mahasiswa-asing.update');
                Route::delete('/mahasiswa-asing/delete/{id}', [\App\Http\Controllers\MahasiswaController::class, 'deleteMahasiswaAsing'])->name('mahasiswa-asing.delete');
                Route::get('/mahasiswa-asing/create', [\App\Http\Controllers\MahasiswaController::class, 'createMahasiswaAsing'])->name('mahasiswa-asing.create');
            });
        });
    });
});
