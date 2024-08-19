<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileDosenController;
use Illuminate\Support\Facades\Route;

//fallback route
Route::fallback(function () {
    abort(404);
});

Route::get("/health", function () {
    return response()->json([
        "status" => "OK",
        "message" => "Service is healthy"
    ]);
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
    Route::middleware(['is-authenticated', 'can:dosen'])->group(function () {
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
            Route::get('/dosen-industri-praktisi/edit/{id}', [ProfileDosenController::class, 'editDosenIndustriPraktisi'])->name('dosen-industri-praktisi.edit');
            Route::put('/dosen-industri-praktisi/update/{id}', [ProfileDosenController::class, 'updateDosenIndustriPraktisi'])->name('dosen-industri-praktisi.update');

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
            Route::get('/dosen-tidak-tetap/edit/{id}', [ProfileDosenController::class, 'editDosenTidakTetap'])->name('dosen-tidak-tetap.edit');
            Route::put('/dosen-tidak-tetap/update/{id}', [ProfileDosenController::class, 'updateDosenTidakTetap'])->name('dosen-tidak-tetap.update');
        });
    });
});

//route for superadmin
Route::prefix('superadmin')->as('superadmin.')->group(function () {
    Route::middleware(['is-authenticated'])->group(function () {
        Route::middleware(['can:superadmin'])->group(function () {
            Route::get('/dashboard', function () {
                return view('superadmin.dashboard');
            })->name('dashboard');
        });
    });
});

//route for Kepala Prodi
Route::prefix('kepala-prodi')->as('kepala-prodi.')->group(function () {
    Route::middleware(['is-authenticated'])->group(function () {
        Route::middleware(['prodi-or-admin-prodi'])->group(function () {
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
                Route::put('/seleksi-mahasiswa/approve/{id}', [\App\Http\Controllers\MahasiswaController::class, 'approveSeleksiMahasiswa'])->name('seleksi-mahasiswa.approve');
                Route::put('/seleksi-mahasiswa/reject/{id}', [\App\Http\Controllers\MahasiswaController::class, 'rejectSeleksiMahasiswa'])->name('seleksi-mahasiswa.reject');

                // Mahasiswa Asing
                Route::get('/mahasiswa-asing', [\App\Http\Controllers\MahasiswaController::class, 'showMahasiswaAsing'])->name('mahasiswa-asing');
                Route::post('/mahasiswa-asing/store', [\App\Http\Controllers\MahasiswaController::class, 'storeMahasiswaAsing'])->name('mahasiswa-asing.store');
                Route::get('/mahasiswa-asing/edit/{id}', [\App\Http\Controllers\MahasiswaController::class, 'editMahasiswaAsing'])->name('mahasiswa-asing.edit');
                Route::put('/mahasiswa-asing/update/{id}', [\App\Http\Controllers\MahasiswaController::class, 'updateMahasiswaAsing'])->name('mahasiswa-asing.update');
                Route::delete('/mahasiswa-asing/delete/{id}', [\App\Http\Controllers\MahasiswaController::class, 'deleteMahasiswaAsing'])->name('mahasiswa-asing.delete');
                Route::get('/mahasiswa-asing/create', [\App\Http\Controllers\MahasiswaController::class, 'createMahasiswaAsing'])->name('mahasiswa-asing.create');
                Route::put('/mahasiswa-asing/approve/{id}', [\App\Http\Controllers\MahasiswaController::class, 'approveMahasiswaAsing'])->name('mahasiswa-asing.approve');
                Route::put('/mahasiswa-asing/reject/{id}', [\App\Http\Controllers\MahasiswaController::class, 'rejectMahasiswaAsing'])->name('mahasiswa-asing.reject');
            });

            //Fitur: Sumber Daya Manusia
            Route::prefix('sumber-daya-manusia')->as('sumber-daya-manusia.')->group(function () {
                //Dosen Tetap Perguruan Tinggi
                Route::get('/dosen-tetap-perguruan-tinggi', [\App\Http\Controllers\SumberDayaManusiaController::class, 'showDosenTetapPerguruanTinggi'])->name('dosen-tetap-perguruan-tinggi');
                Route::post('/dosen-tetap-perguruan-tinggi/store', [\App\Http\Controllers\SumberDayaManusiaController::class, 'storeDosenTetapPerguruanTinggi'])->name('dosen-tetap-perguruan-tinggi.store');
                Route::get('/dosen-tetap-perguruan-tinggi/create', [\App\Http\Controllers\SumberDayaManusiaController::class, 'createDosenTetapPerguruanTinggi'])->name('dosen-tetap-perguruan-tinggi.create');
                Route::get('/dosen-tetap-perguruan-tinggi/edit/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'editDosenTetapPerguruanTinggi'])->name('dosen-tetap-perguruan-tinggi.edit');
                Route::put('/dosen-tetap-perguruan-tinggi/update/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'updateDosenTetapPerguruanTinggi'])->name('dosen-tetap-perguruan-tinggi.update');
                Route::delete('/dosen-tetap-perguruan-tinggi/delete/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'deleteDosenTetapPerguruanTinggi'])->name('dosen-tetap-perguruan-tinggi.delete');
                Route::put('/dosen-tetap-perguruan-tinggi/approve/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'approveDosenTetapPerguruanTinggi'])->name('dosen-tetap-perguruan-tinggi.approve');
                Route::put('/dosen-tetap-perguruan-tinggi/reject/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'rejectDosenTetapPerguruanTinggi'])->name('dosen-tetap-perguruan-tinggi.reject');

                // Dosen Pembimbing Utama Tugas Akhir
                Route::get('/dosen-pembimbing-utama-tugas-akhir', [\App\Http\Controllers\SumberDayaManusiaController::class, 'showDosenPembimbingUtamaTugasAkhir'])->name('dosen-pembimbing-utama-tugas-akhir');
                Route::post('/dosen-pembimbing-utama-tugas-akhir/store', [\App\Http\Controllers\SumberDayaManusiaController::class, 'storeDosenPembimbingUtamaTugasAkhir'])->name('dosen-pembimbing-utama-tugas-akhir.store');
                Route::get('/dosen-pembimbing-utama-tugas-akhir/create', [\App\Http\Controllers\SumberDayaManusiaController::class, 'createDosenPembimbingUtamaTugasAkhir'])->name('dosen-pembimbing-utama-tugas-akhir.create');
                Route::get('/dosen-pembimbing-utama-tugas-akhir/edit/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'editDosenPembimbingUtamaTugasAkhir'])->name('dosen-pembimbing-utama-tugas-akhir.edit');
                Route::put('/dosen-pembimbing-utama-tugas-akhir/update/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'updateDosenPembimbingUtamaTugasAkhir'])->name('dosen-pembimbing-utama-tugas-akhir.update');
                Route::delete('/dosen-pembimbing-utama-tugas-akhir/delete/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'deleteDosenPembimbingUtamaTugasAkhir'])->name('dosen-pembimbing-utama-tugas-akhir.delete');
                Route::put('/dosen-pembimbing-utama-tugas-akhir/approve/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'approveDosenPembimbingUtamaTugasAkhir'])->name('dosen-pembimbing-utama-tugas-akhir.approve');
                Route::put('/dosen-pembimbing-utama-tugas-akhir/reject/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'rejectDosenPembimbingUtamaTugasAkhir'])->name('dosen-pembimbing-utama-tugas-akhir.reject');

                // EWMP
                Route::get('/ewmp', [\App\Http\Controllers\SumberDayaManusiaController::class, 'showEWMP'])->name('ewmp');
                Route::post('/ewmp/store', [\App\Http\Controllers\SumberDayaManusiaController::class, 'storeEWMP'])->name('ewmp.store');
                Route::get('/ewmp/create', [\App\Http\Controllers\SumberDayaManusiaController::class, 'createEWMP'])->name('ewmp.create');
                Route::get('/ewmp/edit/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'editEWMP'])->name('ewmp.edit');
                Route::put('/ewmp/update/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'updateEWMP'])->name('ewmp.update');
                Route::delete('/ewmp/delete/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'deleteEWMP'])->name('ewmp.delete');
                Route::put('/ewmp/approve/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'approveEWMP'])->name('ewmp.approve');
                Route::put('/ewmp/reject/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'rejectEWMP'])->name('ewmp.reject');

                // Dosen Tidak Tetap
                Route::get('/dosen-tidak-tetap', [\App\Http\Controllers\SumberDayaManusiaController::class, 'showDosenTidakTetap'])->name('dosen-tidak-tetap');
                Route::post('/dosen-tidak-tetap/store', [\App\Http\Controllers\SumberDayaManusiaController::class, 'storeDosenTidakTetap'])->name('dosen-tidak-tetap.store');
                Route::get('/dosen-tidak-tetap/create', [\App\Http\Controllers\SumberDayaManusiaController::class, 'createDosenTidakTetap'])->name('dosen-tidak-tetap.create');
                Route::get('/dosen-tidak-tetap/edit/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'editDosenTidakTetap'])->name('dosen-tidak-tetap.edit');
                Route::put('/dosen-tidak-tetap/update/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'updateDosenTidakTetap'])->name('dosen-tidak-tetap.update');
                Route::delete('/dosen-tidak-tetap/delete/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'deleteDosenTidakTetap'])->name('dosen-tidak-tetap.delete');
                Route::put('/dosen-tidak-tetap/approve/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'approveDosenTidakTetap'])->name('dosen-tidak-tetap.approve');
                Route::put('/dosen-tidak-tetap/reject/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'rejectDosenTidakTetap'])->name('dosen-tidak-tetap.reject');

                // Dosen Industri/Praktisi
                Route::get('/dosen-industri-praktisi', [\App\Http\Controllers\SumberDayaManusiaController::class, 'showDosenIndustriPraktisi'])->name('dosen-industri-praktisi');
                Route::post('/dosen-industri-praktisi/store', [\App\Http\Controllers\SumberDayaManusiaController::class, 'storeDosenIndustriPraktisi'])->name('dosen-industri-praktisi.store');
                Route::get('/dosen-industri-praktisi/create', [\App\Http\Controllers\SumberDayaManusiaController::class, 'createDosenIndustriPraktisi'])->name('dosen-industri-praktisi.create');
                Route::get('/dosen-industri-praktisi/edit/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'editDosenIndustriPraktisi'])->name('dosen-industri-praktisi.edit');
                Route::put('/dosen-industri-praktisi/update/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'updateDosenIndustriPraktisi'])->name('dosen-industri-praktisi.update');
                Route::delete('/dosen-industri-praktisi/delete/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'deleteDosenIndustriPraktisi'])->name('dosen-industri-praktisi.delete');
                Route::put('/dosen-industri-praktisi/approve/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'approveDosenIndustriPraktisi'])->name('dosen-industri-praktisi.approve');
                Route::put('/dosen-industri-praktisi/reject/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'rejectDosenIndustriPraktisi'])->name('dosen-industri-praktisi.reject');

                // Rekognisi Dosen
                Route::get('/rekognisi-dosen', [\App\Http\Controllers\SumberDayaManusiaController::class, 'showRekognisiDosen'])->name('rekognisi-dosen');
                Route::post('/rekognisi-dosen/store', [\App\Http\Controllers\SumberDayaManusiaController::class, 'storeRekognisiDosen'])->name('rekognisi-dosen.store');
                Route::get('/rekognisi-dosen/create', [\App\Http\Controllers\SumberDayaManusiaController::class, 'createRekognisiDosen'])->name('rekognisi-dosen.create');
                Route::get('/rekognisi-dosen/edit/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'editRekognisiDosen'])->name('rekognisi-dosen.edit');
                Route::put('/rekognisi-dosen/update/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'updateRekognisiDosen'])->name('rekognisi-dosen.update');
                Route::delete('/rekognisi-dosen/delete/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'deleteRekognisiDosen'])->name('rekognisi-dosen.delete');
                Route::put('/rekognisi-dosen/approve/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'approveRekognisiDosen'])->name('rekognisi-dosen.approve');
                Route::put('/rekognisi-dosen/reject/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'rejectRekognisiDosen'])->name('rekognisi-dosen.reject');

                //Penelitian DTPS
                Route::get('/penelitian-dtps', [\App\Http\Controllers\SumberDayaManusiaController::class, 'showPenelitianDTPS'])->name('penelitian-dtps');
                Route::post('/penelitian-dtps/store', [\App\Http\Controllers\SumberDayaManusiaController::class, 'storePenelitianDTPS'])->name('penelitian-dtps.store');
                Route::get('/penelitian-dtps/create', [\App\Http\Controllers\SumberDayaManusiaController::class, 'createPenelitianDTPS'])->name('penelitian-dtps.create');
                Route::get('/penelitian-dtps/edit/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'editPenelitianDTPS'])->name('penelitian-dtps.edit');
                Route::put('/penelitian-dtps/update/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'updatePenelitianDTPS'])->name('penelitian-dtps.update');
                Route::delete('/penelitian-dtps/delete/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'deletePenelitianDTPS'])->name('penelitian-dtps.delete');
                Route::put('/penelitian-dtps/approve/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'approvePenelitianDTPS'])->name('penelitian-dtps.approve');
                Route::put('/penelitian-dtps/reject/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'rejectPenelitianDTPS'])->name('penelitian-dtps.reject');

                // PKM DTPS
                Route::get('/pkm-dtps', [\App\Http\Controllers\SumberDayaManusiaController::class, 'showPKMDTPS'])->name('pkm-dtps');
                Route::post('/pkm-dtps/store', [\App\Http\Controllers\SumberDayaManusiaController::class, 'storePKMDTPS'])->name('pkm-dtps.store');
                Route::get('/pkm-dtps/create', [\App\Http\Controllers\SumberDayaManusiaController::class, 'createPKMDTPS'])->name('pkm-dtps.create');
                Route::get('/pkm-dtps/edit/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'editPKMDTPS'])->name('pkm-dtps.edit');
                Route::put('/pkm-dtps/update/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'updatePKMDTPS'])->name('pkm-dtps.update');
                Route::delete('/pkm-dtps/delete/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'deletePKMDTPS'])->name('pkm-dtps.delete');
                Route::put('/pkm-dtps/approve/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'approvePKMDTPS'])->name('pkm-dtps.approve');
                Route::put('/pkm-dtps/reject/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'rejectPKMDTPS'])->name('pkm-dtps.reject');

                // Publikasi Ilmiah DTPS
                Route::get('/publikasi-ilmiah-dtps', [\App\Http\Controllers\SumberDayaManusiaController::class, 'showPublikasiIlmiahDTPS'])->name('publikasi-ilmiah-dtps');
                Route::post('/publikasi-ilmiah-dtps/store', [\App\Http\Controllers\SumberDayaManusiaController::class, 'storePublikasiIlmiahDTPS'])->name('publikasi-ilmiah-dtps.store');
                Route::get('/publikasi-ilmiah-dtps/create', [\App\Http\Controllers\SumberDayaManusiaController::class, 'createPublikasiIlmiahDTPS'])->name('publikasi-ilmiah-dtps.create');
                Route::get('/publikasi-ilmiah-dtps/edit/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'editPublikasiIlmiahDTPS'])->name('publikasi-ilmiah-dtps.edit');
                Route::put('/publikasi-ilmiah-dtps/update/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'updatePublikasiIlmiahDTPS'])->name('publikasi-ilmiah-dtps.update');
                Route::delete('/publikasi-ilmiah-dtps/delete/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'deletePublikasiIlmiahDTPS'])->name('publikasi-ilmiah-dtps.delete');
                Route::put('/publikasi-ilmiah-dtps/approve/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'approvePublikasiIlmiahDTPS'])->name('publikasi-ilmiah-dtps.approve');
                Route::put('/publikasi-ilmiah-dtps/reject/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'rejectPublikasiIlmiahDTPS'])->name('publikasi-ilmiah-dtps.reject');

                // Pagelaran Ilmiah DTPS
                Route::get('/pagelaran-ilmiah-dtps', [\App\Http\Controllers\SumberDayaManusiaController::class, 'showPagelaranIlmiahDTPS'])->name('pagelaran-ilmiah-dtps');
                Route::post('/pagelaran-ilmiah-dtps/store', [\App\Http\Controllers\SumberDayaManusiaController::class, 'storePagelaranIlmiahDTPS'])->name('pagelaran-ilmiah-dtps.store');
                Route::get('/pagelaran-ilmiah-dtps/create', [\App\Http\Controllers\SumberDayaManusiaController::class, 'createPagelaranIlmiahDTPS'])->name('pagelaran-ilmiah-dtps.create');
                Route::get('/pagelaran-ilmiah-dtps/edit/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'editPagelaranIlmiahDTPS'])->name('pagelaran-ilmiah-dtps.edit');
                Route::put('/pagelaran-ilmiah-dtps/update/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'updatePagelaranIlmiahDTPS'])->name('pagelaran-ilmiah-dtps.update');
                Route::delete('/pagelaran-ilmiah-dtps/delete/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'deletePagelaranIlmiahDTPS'])->name('pagelaran-ilmiah-dtps.delete');
                Route::put('/pagelaran-ilmiah-dtps/approve/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'approvePagelaranIlmiahDTPS'])->name('pagelaran-ilmiah-dtps.approve');
                Route::put('/pagelaran-ilmiah-dtps/reject/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'rejectPagelaranIlmiahDTPS'])->name('pagelaran-ilmiah-dtps.reject');

                // Luaran Penelitian DTPS Bagian 1 - HKI Paten
                Route::get('/luaran-penelitian-pkm-hki-paten', [\App\Http\Controllers\SumberDayaManusiaController::class, 'showLuaranPenelitianDTPSBagian1'])->name('luaran-penelitian-pkm-hki-paten');
                Route::post('/luaran-penelitian-pkm-hki-paten/store', [\App\Http\Controllers\SumberDayaManusiaController::class, 'storeLuaranPenelitianDTPSBagian1'])->name('luaran-penelitian-pkm-hki-paten.store');
                Route::get('/luaran-penelitian-pkm-hki-paten/create', [\App\Http\Controllers\SumberDayaManusiaController::class, 'createLuaranPenelitianDTPSBagian1'])->name('luaran-penelitian-pkm-hki-paten.create');
                Route::get('/luaran-penelitian-pkm-hki-paten/edit/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'editLuaranPenelitianDTPSBagian1'])->name('luaran-penelitian-pkm-hki-paten.edit');
                Route::put('/luaran-penelitian-pkm-hki-paten/update/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'updateLuaranPenelitianDTPSBagian1'])->name('luaran-penelitian-pkm-hki-paten.update');
                Route::delete('/luaran-penelitian-pkm-hki-paten/delete/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'deleteLuaranPenelitianDTPSBagian1'])->name('luaran-penelitian-pkm-hki-paten.delete');
                Route::put('/luaran-penelitian-pkm-hki-paten/approve/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'approveLuaranPenelitianDTPSBagian1'])->name('luaran-penelitian-pkm-hki-paten.approve');
                Route::put('/luaran-penelitian-pkm-hki-paten/reject/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'rejectLuaranPenelitianDTPSBagian1'])->name('luaran-penelitian-pkm-hki-paten.reject');

                // Luaran Penelitian DTPS Bagian 2 - HKI Hak Cipta
                Route::get('/luaran-penelitian-pkm-hki-hak-cipta', [\App\Http\Controllers\SumberDayaManusiaController::class, 'showLuaranPenelitianDTPSBagian2'])->name('luaran-penelitian-pkm-hki-hak-cipta');
                Route::post('/luaran-penelitian-pkm-hki-hak-cipta/store', [\App\Http\Controllers\SumberDayaManusiaController::class, 'storeLuaranPenelitianDTPSBagian2'])->name('luaran-penelitian-pkm-hki-hak-cipta.store');
                Route::get('/luaran-penelitian-pkm-hki-hak-cipta/create', [\App\Http\Controllers\SumberDayaManusiaController::class, 'createLuaranPenelitianDTPSBagian2'])->name('luaran-penelitian-pkm-hki-hak-cipta.create');
                Route::get('/luaran-penelitian-pkm-hki-hak-cipta/edit/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'editLuaranPenelitianDTPSBagian2'])->name('luaran-penelitian-pkm-hki-hak-cipta.edit');
                Route::put('/luaran-penelitian-pkm-hki-hak-cipta/update/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'updateLuaranPenelitianDTPSBagian2'])->name('luaran-penelitian-pkm-hki-hak-cipta.update');
                Route::delete('/luaran-penelitian-pkm-hki-hak-cipta/delete/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'deleteLuaranPenelitianDTPSBagian2'])->name('luaran-penelitian-pkm-hki-hak-cipta.delete');
                Route::put('/luaran-penelitian-pkm-hki-hak-cipta/approve/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'approveLuaranPenelitianDTPSBagian2'])->name('luaran-penelitian-pkm-hki-hak-cipta.approve');
                Route::put('/luaran-penelitian-pkm-hki-hak-cipta/reject/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'rejectLuaranPenelitianDTPSBagian2'])->name('luaran-penelitian-pkm-hki-hak-cipta.reject');

                // Luaran Penelitian DTPS Bagian 3 - Teknologi
                Route::get('/luaran-penelitian-pkm-teknologi', [\App\Http\Controllers\SumberDayaManusiaController::class, 'showLuaranPenelitianDTPSBagian3'])->name('luaran-penelitian-pkm-teknologi');
                Route::post('/luaran-penelitian-pkm-teknologi/store', [\App\Http\Controllers\SumberDayaManusiaController::class, 'storeLuaranPenelitianDTPSBagian3'])->name('luaran-penelitian-pkm-teknologi.store');
                Route::get('/luaran-penelitian-pkm-teknologi/create', [\App\Http\Controllers\SumberDayaManusiaController::class, 'createLuaranPenelitianDTPSBagian3'])->name('luaran-penelitian-pkm-teknologi.create');
                Route::get('/luaran-penelitian-pkm-teknologi/edit/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'editLuaranPenelitianDTPSBagian3'])->name('luaran-penelitian-pkm-teknologi.edit');
                Route::put('/luaran-penelitian-pkm-teknologi/update/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'updateLuaranPenelitianDTPSBagian3'])->name('luaran-penelitian-pkm-teknologi.update');
                Route::delete('/luaran-penelitian-pkm-teknologi/delete/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'deleteLuaranPenelitianDTPSBagian3'])->name('luaran-penelitian-pkm-teknologi.delete');
                Route::put('/luaran-penelitian-pkm-teknologi/approve/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'approveLuaranPenelitianDTPSBagian3'])->name('luaran-penelitian-pkm-teknologi.approve');
                Route::put('/luaran-penelitian-pkm-teknologi/reject/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'rejectLuaranPenelitianDTPSBagian3'])->name('luaran-penelitian-pkm-teknologi.reject');

                // Luaran Penelitian DTPS Bagian 4 - Buku
                Route::get('/luaran-penelitian-pkm-buku', [\App\Http\Controllers\SumberDayaManusiaController::class, 'showLuaranPenelitianDTPSBagian4'])->name('luaran-penelitian-pkm-buku');
                Route::post('/luaran-penelitian-pkm-buku/store', [\App\Http\Controllers\SumberDayaManusiaController::class, 'storeLuaranPenelitianDTPSBagian4'])->name('luaran-penelitian-pkm-buku.store');
                Route::get('/luaran-penelitian-pkm-buku/create', [\App\Http\Controllers\SumberDayaManusiaController::class, 'createLuaranPenelitianDTPSBagian4'])->name('luaran-penelitian-pkm-buku.create');
                Route::get('/luaran-penelitian-pkm-buku/edit/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'editLuaranPenelitianDTPSBagian4'])->name('luaran-penelitian-pkm-buku.edit');
                Route::put('/luaran-penelitian-pkm-buku/update/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'updateLuaranPenelitianDTPSBagian4'])->name('luaran-penelitian-pkm-buku.update');
                Route::delete('/luaran-penelitian-pkm-buku/delete/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'deleteLuaranPenelitianDTPSBagian4'])->name('luaran-penelitian-pkm-buku.delete');
                Route::put('/luaran-penelitian-pkm-buku/approve/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'approveLuaranPenelitianDTPSBagian4'])->name('luaran-penelitian-pkm-buku.approve');
                Route::put('/luaran-penelitian-pkm-buku/reject/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'rejectLuaranPenelitianDTPSBagian4'])->name('luaran-penelitian-pkm-buku.reject');

                // Karya Ilmiah DTPS Disitasi
                Route::get('/karya-ilmiah-dtps-disitasi', [\App\Http\Controllers\SumberDayaManusiaController::class, 'showKaryaIlmiahDTPSDisitasi'])->name('karya-ilmiah-dtps-disitasi');
                Route::post('/karya-ilmiah-dtps-disitasi/store', [\App\Http\Controllers\SumberDayaManusiaController::class, 'storeKaryaIlmiahDTPSDisitasi'])->name('karya-ilmiah-dtps-disitasi.store');
                Route::get('/karya-ilmiah-dtps-disitasi/create', [\App\Http\Controllers\SumberDayaManusiaController::class, 'createKaryaIlmiahDTPSDisitasi'])->name('karya-ilmiah-dtps-disitasi.create');
                Route::get('/karya-ilmiah-dtps-disitasi/edit/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'editKaryaIlmiahDTPSDisitasi'])->name('karya-ilmiah-dtps-disitasi.edit');
                Route::put('/karya-ilmiah-dtps-disitasi/update/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'updateKaryaIlmiahDTPSDisitasi'])->name('karya-ilmiah-dtps-disitasi.update');
                Route::delete('/karya-ilmiah-dtps-disitasi/delete/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'deleteKaryaIlmiahDTPSDisitasi'])->name('karya-ilmiah-dtps-disitasi.delete');
                Route::put('/karya-ilmiah-dtps-disitasi/approve/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'approveKaryaIlmiahDTPSDisitasi'])->name('karya-ilmiah-dtps-disitasi.approve');
                Route::put('/karya-ilmiah-dtps-disitasi/reject/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'rejectKaryaIlmiahDTPSDisitasi'])->name('karya-ilmiah-dtps-disitasi.reject');

                // Produk Jasa Masyarakat
                Route::get('/produk-jasa-masyarakat', [\App\Http\Controllers\SumberDayaManusiaController::class, 'showProdukJasaMasyarakat'])->name('produk-jasa-masyarakat');
                Route::post('/produk-jasa-masyarakat/store', [\App\Http\Controllers\SumberDayaManusiaController::class, 'storeProdukJasaMasyarakat'])->name('produk-jasa-masyarakat.store');
                Route::get('/produk-jasa-masyarakat/create', [\App\Http\Controllers\SumberDayaManusiaController::class, 'createProdukJasaMasyarakat'])->name('produk-jasa-masyarakat.create');
                Route::get('/produk-jasa-masyarakat/edit/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'editProdukJasaMasyarakat'])->name('produk-jasa-masyarakat.edit');
                Route::put('/produk-jasa-masyarakat/update/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'updateProdukJasaMasyarakat'])->name('produk-jasa-masyarakat.update');
                Route::delete('/produk-jasa-masyarakat/delete/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'deleteProdukJasaMasyarakat'])->name('produk-jasa-masyarakat.delete');
                Route::put('/produk-jasa-masyarakat/approve/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'approveProdukJasaMasyarakat'])->name('produk-jasa-masyarakat.approve');
                Route::put('/produk-jasa-masyarakat/reject/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, 'rejectProdukJasaMasyarakat'])->name('produk-jasa-masyarakat.reject');
            });

            // Penggunaan Dana
            Route::get('/penggunaan-dana', [\App\Http\Controllers\PenggunaanDanaController::class, 'showPenggunaanDana'])->name('penggunaan-dana');
            Route::post('/penggunaan-dana/store', [\App\Http\Controllers\PenggunaanDanaController::class, 'storePenggunaanDana'])->name('penggunaan-dana.store');
            Route::get('/penggunaan-dana/create', [\App\Http\Controllers\PenggunaanDanaController::class, 'createPenggunaanDana'])->name('penggunaan-dana.create');
            Route::get('/penggunaan-dana/edit/{id}', [\App\Http\Controllers\PenggunaanDanaController::class, 'editPenggunaanDana'])->name('penggunaan-dana.edit');
            Route::put('/penggunaan-dana/update/{id}', [\App\Http\Controllers\PenggunaanDanaController::class, 'updatePenggunaanDana'])->name('penggunaan-dana.update');
            Route::delete('/penggunaan-dana/delete/{id}', [\App\Http\Controllers\PenggunaanDanaController::class, 'deletePenggunaanDana'])->name('penggunaan-dana.delete');
            Route::put('/penggunaan-dana/approve/{id}', [\App\Http\Controllers\PenggunaanDanaController::class, 'approvePenggunaanDana'])->name('penggunaan-dana.approve');
            Route::put('/penggunaan-dana/reject/{id}', [\App\Http\Controllers\PenggunaanDanaController::class, 'rejectPenggunaanDana'])->name('penggunaan-dana.reject');

            // Pendidikan
            Route::prefix('pendidikan')->group(function () {
                //kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran
                Route::get('/kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran', [\App\Http\Controllers\PendidikanController::class, 'showKurikulumCapaianPembelajaranDanRencanaPembelajaran'])->name('kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran');
                Route::post('/kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran/store', [\App\Http\Controllers\PendidikanController::class, 'storeKurikulumCapaianPembelajaranDanRencanaPembelajaran'])->name('kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran.store');
                Route::get('/kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran/create', [\App\Http\Controllers\PendidikanController::class, 'createKurikulumCapaianPembelajaranDanRencanaPembelajaran'])->name('kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran.create');
                Route::get('/kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran/edit/{id}', [\App\Http\Controllers\PendidikanController::class, 'editKurikulumCapaianPembelajaranDanRencanaPembelajaran'])->name('kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran.edit');
                Route::put('/kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran/update/{id}', [\App\Http\Controllers\PendidikanController::class, 'updateKurikulumCapaianPembelajaranDanRencanaPembelajaran'])->name('kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran.update');
                Route::delete('/kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran/delete/{id}', [\App\Http\Controllers\PendidikanController::class, 'deleteKurikulumCapaianPembelajaranDanRencanaPembelajaran'])->name('kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran.delete');
                Route::put('/kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran/approve/{id}', [\App\Http\Controllers\PendidikanController::class, 'approveKurikulumCapaianPembelajaranDanRencanaPembelajaran'])->name('kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran.approve');
                Route::put('/kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran/reject/{id}', [\App\Http\Controllers\PendidikanController::class, 'rejectKurikulumCapaianPembelajaranDanRencanaPembelajaran'])->name('kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran.reject');
            });
        });
    });
});

//route for prodi and admin prodi, using middleware is-authenticated and can:prodi and can:admin-prodi
Route::prefix("sumber-daya-manusia")->as("sumber-daya-manusia.")->group(function () {
    Route::middleware(['is-authenticated'])->group(function () {
        Route::middleware(['prodi-or-admin-prodi'])->group(function () {
            //dosen industri/praktisi
            Route::get('/dosen-industri-praktisi', [\App\Http\Controllers\SumberDayaManusiaController::class, "showDosenIndustriPraktisi"])->name('dosen-industri-praktisi');
            Route::get('/dosen-industri-praktisi/create', [\App\Http\Controllers\SumberDayaManusiaController::class, "createDosenIndustriPraktisi"])->name('dosen-industri-praktisi.create');
            Route::post('/dosen-industri-praktisi/store', [\App\Http\Controllers\SumberDayaManusiaController::class, "storeDosenIndustriPraktisi"])->name('dosen-industri-praktisi.store');
            Route::get('/dosen-industri-praktisi/edit/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, "editDosenIndustriPraktisi"])->name('dosen-industri-praktisi.edit');
            Route::put('/dosen-industri-praktisi/update/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, "updateDosenIndustriPraktisi"])->name('dosen-industri-praktisi.update');
            Route::delete('/dosen-industri-praktisi/delete/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, "deleteDosenIndustriPraktisi"])->name('dosen-industri-praktisi.delete');
            Route::put('/dosen-industri-praktisi/approve/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, "approveDosenIndustriPraktisi"])->name('dosen-industri-praktisi.approve');
            Route::put('/dosen-industri-praktisi/reject/{id}', [\App\Http\Controllers\SumberDayaManusiaController::class, "rejectDosenIndustriPraktisi"])->name('dosen-industri-praktisi.reject');
        });
    });
});


//admin prodi dashboard
Route::prefix('admin-prodi')->as('admin-prodi.')->group(function () {
    Route::middleware(['is-authenticated'])->group(function () {
        Route::middleware(['can:admin_prodi'])->group(function () {
            Route::get('/dashboard', function () {
                return view('admin-prodi.dashboard');
            })->name('dashboard');
        });
    });
});
