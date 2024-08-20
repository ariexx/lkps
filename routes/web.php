<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KinerjaDosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\PengabdianMasyarakatController;
use App\Http\Controllers\PenggunaanDanaController;
use App\Http\Controllers\ProfileDosenController;
use App\Http\Controllers\SumberDayaManusiaController;
use App\Http\Controllers\TridharmaController;
use App\Http\Controllers\UserManagementController;
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

        //Fitur: Kinerja Dosen
        Route::prefix('kinerja-dosen')->as('kinerja-dosen.')->group(function () {
            //Penelitian DTPS
            Route::get('/penelitian-dtps', [KinerjaDosenController::class, 'showPenelitianDTPS'])->name('penelitian-dtps');
            Route::post('/penelitian-dtps/store', [KinerjaDosenController::class, 'storePenelitianDTPS'])->name('penelitian-dtps.store');
            Route::get('/penelitian-dtps/create', [KinerjaDosenController::class, 'createPenelitianDTPS'])->name('penelitian-dtps.create');
            Route::get('/penelitian-dtps/edit/{id}', [KinerjaDosenController::class, 'editPenelitianDTPS'])->name('penelitian-dtps.edit');
            Route::put('/penelitian-dtps/update/{id}', [KinerjaDosenController::class, 'updatePenelitianDTPS'])->name('penelitian-dtps.update');
            Route::delete('/penelitian-dtps/delete/{id}', [KinerjaDosenController::class, 'deletePenelitianDTPS'])->name('penelitian-dtps.delete');

            //PKM DTPS
            Route::get('/pkm-dtps', [KinerjaDosenController::class, 'showPKMDTPS'])->name('pkm-dtps');
            Route::post('/pkm-dtps/store', [KinerjaDosenController::class, 'storePKMDTPS'])->name('pkm-dtps.store');
            Route::get('/pkm-dtps/create', [KinerjaDosenController::class, 'createPKMDTPS'])->name('pkm-dtps.create');
            Route::get('/pkm-dtps/edit/{id}', [KinerjaDosenController::class, 'editPKMDTPS'])->name('pkm-dtps.edit');
            Route::put('/pkm-dtps/update/{id}', [KinerjaDosenController::class, 'updatePKMDTPS'])->name('pkm-dtps.update');
            Route::delete('/pkm-dtps/delete/{id}', [KinerjaDosenController::class, 'deletePKMDTPS'])->name('pkm-dtps.delete');

            //Rekognisi Dosen
            Route::get('/rekognisi-dosen', [KinerjaDosenController::class, 'showRekognisiDosen'])->name('rekognisi-dosen');
            Route::post('/rekognisi-dosen/store', [KinerjaDosenController::class, 'storeRekognisiDosen'])->name('rekognisi-dosen.store');
            Route::get('/rekognisi-dosen/create', [KinerjaDosenController::class, 'createRekognisiDosen'])->name('rekognisi-dosen.create');
            Route::get('/rekognisi-dosen/edit/{id}', [KinerjaDosenController::class, 'editRekognisiDosen'])->name('rekognisi-dosen.edit');
            Route::put('/rekognisi-dosen/update/{id}', [KinerjaDosenController::class, 'updateRekognisiDosen'])->name('rekognisi-dosen.update');
            Route::delete('/rekognisi-dosen/delete/{id}', [KinerjaDosenController::class, 'deleteRekognisiDosen'])->name('rekognisi-dosen.delete');

            //Karya Ilmiah DTPS Disitasi
            Route::get('/karya-ilmiah-dtps-disitasi', [KinerjaDosenController::class, 'showKaryaIlmiahDTPSDisitasi'])->name('karya-ilmiah-dtps-disitasi');
            Route::post('/karya-ilmiah-dtps-disitasi/store', [KinerjaDosenController::class, 'storeKaryaIlmiahDTPSDisitasi'])->name('karya-ilmiah-dtps-disitasi.store');
            Route::get('/karya-ilmiah-dtps-disitasi/create', [KinerjaDosenController::class, 'createKaryaIlmiahDTPSDisitasi'])->name('karya-ilmiah-dtps-disitasi.create');
            Route::get('/karya-ilmiah-dtps-disitasi/edit/{id}', [KinerjaDosenController::class, 'editKaryaIlmiahDTPSDisitasi'])->name('karya-ilmiah-dtps-disitasi.edit');
            Route::put('/karya-ilmiah-dtps-disitasi/update/{id}', [KinerjaDosenController::class, 'updateKaryaIlmiahDTPSDisitasi'])->name('karya-ilmiah-dtps-disitasi.update');

            // Produk / Jasa DTPS Yang Diadopsi oleh Industri/Masyarakat
            Route::get('/produk-jasa-dtps-diadopsi', [KinerjaDosenController::class, 'showProdukJasaDTPSDiadopsi'])->name('produk-jasa-dtps-diadopsi');
            Route::post('/produk-jasa-dtps-diadopsi/store', [KinerjaDosenController::class, 'storeProdukJasaDTPSDiadopsi'])->name('produk-jasa-dtps-diadopsi.store');
            Route::get('/produk-jasa-dtps-diadopsi/create', [KinerjaDosenController::class, 'createProdukJasaDTPSDiadopsi'])->name('produk-jasa-dtps-diadopsi.create');
            Route::get('/produk-jasa-dtps-diadopsi/edit/{id}', [KinerjaDosenController::class, 'editProdukJasaDTPSDiadopsi'])->name('produk-jasa-dtps-diadopsi.edit');
            Route::put('/produk-jasa-dtps-diadopsi/update/{id}', [KinerjaDosenController::class, 'updateProdukJasaDTPSDiadopsi'])->name('produk-jasa-dtps-diadopsi.update');
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

            //Fitur: Log Aktivitas
            Route::get('/log-aktivitas', [\App\Http\Controllers\LogAktivitasController::class, 'showLogAktivitas'])->name('log-aktivitas');

            //Fitur: User Management
            Route::get('/user-management', [UserManagementController::class, 'showUserManagement'])->name('user-management');
            Route::get('/user-management/create', [UserManagementController::class, 'createUserManagement'])->name('user-management.create');
            Route::post('/user-management/store', [UserManagementController::class, 'storeUserManagement'])->name('user-management.store');
            Route::get('/user-management/edit/{id}', [UserManagementController::class, 'editUserManagement'])->name('user-management.edit');
            Route::put('/user-management/update/{id}', [UserManagementController::class, 'updateUserManagement'])->name('user-management.update');
            Route::delete('/user-management/delete/{id}', [UserManagementController::class, 'deleteUserManagement'])->name('user-management.delete');
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
                Route::get('/pendidikan', [TridharmaController::class, 'showPendidikan'])->name('kerjasama-pendidikan');
                Route::get('/pendidikan/create', [\App\Http\Services\Tridharma\PendidikanService::class, 'createKerjasamaPendidikan'])->name('kerjasama-pendidikan.create');
                Route::post('/pendidikan/store', [TridharmaController::class, 'storePendidikan'])->name('kerjasama-pendidikan.store');
                Route::put('/pendidikan/approve/{id}', [TridharmaController::class, 'approveFileKerjasamaPendidikan'])->name('kerjasama-pendidikan.approve');
                Route::put('/pendidikan/reject/{id}', [TridharmaController::class, 'rejectFileKerjasamaPendidikan'])->name('kerjasama-pendidikan.reject');
                Route::get('/pendidikan/edit/{id}', [TridharmaController::class, 'editKerjasamaPendidikan'])->name('kerjasama-pendidikan.edit');
                Route::put('/pendidikan/update/{id}', [TridharmaController::class, 'updateKerjasamaPendidikan'])->name('kerjasama-pendidikan.update');
                Route::delete('/pendidikan/delete/{id}', [TridharmaController::class, 'deleteKerjasamaPendidikan'])->name('kerjasama-pendidikan.delete');

                //Fitur: Kerjasama Penelitian
                Route::get('/penelitian', [TridharmaController::class, 'showPenelitian'])->name('kerjasama-penelitian');
                Route::get('/penelitian/create', [\App\Http\Services\Tridharma\PenelitianService::class, 'createKerjasamaPenelitian'])->name('kerjasama-penelitian.create');
                Route::post('/penelitian/store', [TridharmaController::class, 'storePenelitian'])->name('kerjasama-penelitian.store');
                Route::put('/penelitian/approve/{id}', [TridharmaController::class, 'approveFileKerjasamaPenelitian'])->name('kerjasama-penelitian.approve');
                Route::put('/penelitian/reject/{id}', [TridharmaController::class, 'rejectFileKerjasamaPenelitian'])->name('kerjasama-penelitian.reject');
                Route::get('/penelitian/edit/{id}', [TridharmaController::class, 'editPenelitian'])->name('kerjasama-penelitian.edit');
                Route::put('/penelitian/update/{id}', [TridharmaController::class, 'updateKerjasamaPenelitian'])->name('kerjasama-penelitian.update');
                Route::delete('/penelitian/delete/{id}', [TridharmaController::class, 'deleteKerjasamaPenelitian'])->name('kerjasama-penelitian.delete');

                //Fitur: Kerjasama Pengabdian Masyarakat
                Route::get('/pengabdian-masyarakat', [TridharmaController::class, 'showPengabdianMasyarakat'])->name('pengabdian-masyarakat');
                Route::get('/pengabdian-masyarakat/create', [TridharmaController::class, 'createPengabdianMasyarakat'])->name('pengabdian-masyarakat.create');
                Route::post('/pengabdian-masyarakat/store', [TridharmaController::class, 'storePengabdianMasyarakat'])->name('pengabdian-masyarakat.store');
                Route::put('/pengabdian-masyarakat/approve/{id}', [TridharmaController::class, 'approveFilePengabdianMasyarakat'])->name('pengabdian-masyarakat.approve');
                Route::put('/pengabdian-masyarakat/reject/{id}', [TridharmaController::class, 'rejectFilePengabdianMasyarakat'])->name('pengabdian-masyarakat.reject');
                Route::get('/pengabdian-masyarakat/edit/{id}', [TridharmaController::class, 'editPengabdianMasyarakat'])->name('pengabdian-masyarakat.edit');
                Route::put('/pengabdian-masyarakat/update/{id}', [TridharmaController::class, 'updatePengabdianMasyarakat'])->name('pengabdian-masyarakat.update');
                Route::delete('/pengabdian-masyarakat/delete/{id}', [TridharmaController::class, 'deletePengabdianMasyarakat'])->name('pengabdian-masyarakat.delete');
            });

            //Fitur: Mahasiswa
            Route::prefix('mahasiswa')->as('mahasiswa.')->group(function () {
                // Seleksi Mahasiswa
                Route::get('/seleksi-mahasiswa', [MahasiswaController::class, 'showSeleksiMahasiswa'])->name('seleksi-mahasiswa');
                Route::post('/seleksi-mahasiswa/store', [MahasiswaController::class, 'storeSeleksiMahasiswa'])->name('seleksi-mahasiswa.store');
                Route::get('/seleksi-mahasiswa/edit/{id}', [MahasiswaController::class, 'editSeleksiMahasiswa'])->name('seleksi-mahasiswa.edit');
                Route::put('/seleksi-mahasiswa/update/{id}', [MahasiswaController::class, 'updateSeleksiMahasiswa'])->name('seleksi-mahasiswa.update');
                Route::delete('/seleksi-mahasiswa/delete/{id}', [MahasiswaController::class, 'deleteSeleksiMahasiswa'])->name('seleksi-mahasiswa.delete');
                Route::get('/seleksi-mahasiswa/create', [MahasiswaController::class, 'createSeleksiMahasiswa'])->name('seleksi-mahasiswa.create');
                Route::put('/seleksi-mahasiswa/approve/{id}', [MahasiswaController::class, 'approveSeleksiMahasiswa'])->name('seleksi-mahasiswa.approve');
                Route::put('/seleksi-mahasiswa/reject/{id}', [MahasiswaController::class, 'rejectSeleksiMahasiswa'])->name('seleksi-mahasiswa.reject');

                // Mahasiswa Asing
                Route::get('/mahasiswa-asing', [MahasiswaController::class, 'showMahasiswaAsing'])->name('mahasiswa-asing');
                Route::post('/mahasiswa-asing/store', [MahasiswaController::class, 'storeMahasiswaAsing'])->name('mahasiswa-asing.store');
                Route::get('/mahasiswa-asing/edit/{id}', [MahasiswaController::class, 'editMahasiswaAsing'])->name('mahasiswa-asing.edit');
                Route::put('/mahasiswa-asing/update/{id}', [MahasiswaController::class, 'updateMahasiswaAsing'])->name('mahasiswa-asing.update');
                Route::delete('/mahasiswa-asing/delete/{id}', [MahasiswaController::class, 'deleteMahasiswaAsing'])->name('mahasiswa-asing.delete');
                Route::get('/mahasiswa-asing/create', [MahasiswaController::class, 'createMahasiswaAsing'])->name('mahasiswa-asing.create');
                Route::put('/mahasiswa-asing/approve/{id}', [MahasiswaController::class, 'approveMahasiswaAsing'])->name('mahasiswa-asing.approve');
                Route::put('/mahasiswa-asing/reject/{id}', [MahasiswaController::class, 'rejectMahasiswaAsing'])->name('mahasiswa-asing.reject');
            });

            //Fitur: Sumber Daya Manusia
            Route::prefix('sumber-daya-manusia')->as('sumber-daya-manusia.')->group(function () {
                //Dosen Tetap Perguruan Tinggi
                Route::get('/dosen-tetap-perguruan-tinggi', [SumberDayaManusiaController::class, 'showDosenTetapPerguruanTinggi'])->name('dosen-tetap-perguruan-tinggi');
                Route::post('/dosen-tetap-perguruan-tinggi/store', [SumberDayaManusiaController::class, 'storeDosenTetapPerguruanTinggi'])->name('dosen-tetap-perguruan-tinggi.store');
                Route::get('/dosen-tetap-perguruan-tinggi/create', [SumberDayaManusiaController::class, 'createDosenTetapPerguruanTinggi'])->name('dosen-tetap-perguruan-tinggi.create');
                Route::get('/dosen-tetap-perguruan-tinggi/edit/{id}', [SumberDayaManusiaController::class, 'editDosenTetapPerguruanTinggi'])->name('dosen-tetap-perguruan-tinggi.edit');
                Route::put('/dosen-tetap-perguruan-tinggi/update/{id}', [SumberDayaManusiaController::class, 'updateDosenTetapPerguruanTinggi'])->name('dosen-tetap-perguruan-tinggi.update');
                Route::delete('/dosen-tetap-perguruan-tinggi/delete/{id}', [SumberDayaManusiaController::class, 'deleteDosenTetapPerguruanTinggi'])->name('dosen-tetap-perguruan-tinggi.delete');
                Route::put('/dosen-tetap-perguruan-tinggi/approve/{id}', [SumberDayaManusiaController::class, 'approveDosenTetapPerguruanTinggi'])->name('dosen-tetap-perguruan-tinggi.approve');
                Route::put('/dosen-tetap-perguruan-tinggi/reject/{id}', [SumberDayaManusiaController::class, 'rejectDosenTetapPerguruanTinggi'])->name('dosen-tetap-perguruan-tinggi.reject');

                // Dosen Pembimbing Utama Tugas Akhir
                Route::get('/dosen-pembimbing-utama-tugas-akhir', [SumberDayaManusiaController::class, 'showDosenPembimbingUtamaTugasAkhir'])->name('dosen-pembimbing-utama-tugas-akhir');
                Route::post('/dosen-pembimbing-utama-tugas-akhir/store', [SumberDayaManusiaController::class, 'storeDosenPembimbingUtamaTugasAkhir'])->name('dosen-pembimbing-utama-tugas-akhir.store');
                Route::get('/dosen-pembimbing-utama-tugas-akhir/create', [SumberDayaManusiaController::class, 'createDosenPembimbingUtamaTugasAkhir'])->name('dosen-pembimbing-utama-tugas-akhir.create');
                Route::get('/dosen-pembimbing-utama-tugas-akhir/edit/{id}', [SumberDayaManusiaController::class, 'editDosenPembimbingUtamaTugasAkhir'])->name('dosen-pembimbing-utama-tugas-akhir.edit');
                Route::put('/dosen-pembimbing-utama-tugas-akhir/update/{id}', [SumberDayaManusiaController::class, 'updateDosenPembimbingUtamaTugasAkhir'])->name('dosen-pembimbing-utama-tugas-akhir.update');
                Route::delete('/dosen-pembimbing-utama-tugas-akhir/delete/{id}', [SumberDayaManusiaController::class, 'deleteDosenPembimbingUtamaTugasAkhir'])->name('dosen-pembimbing-utama-tugas-akhir.delete');
                Route::put('/dosen-pembimbing-utama-tugas-akhir/approve/{id}', [SumberDayaManusiaController::class, 'approveDosenPembimbingUtamaTugasAkhir'])->name('dosen-pembimbing-utama-tugas-akhir.approve');
                Route::put('/dosen-pembimbing-utama-tugas-akhir/reject/{id}', [SumberDayaManusiaController::class, 'rejectDosenPembimbingUtamaTugasAkhir'])->name('dosen-pembimbing-utama-tugas-akhir.reject');

                // EWMP
                Route::get('/ewmp', [SumberDayaManusiaController::class, 'showEWMP'])->name('ewmp');
                Route::post('/ewmp/store', [SumberDayaManusiaController::class, 'storeEWMP'])->name('ewmp.store');
                Route::get('/ewmp/create', [SumberDayaManusiaController::class, 'createEWMP'])->name('ewmp.create');
                Route::get('/ewmp/edit/{id}', [SumberDayaManusiaController::class, 'editEWMP'])->name('ewmp.edit');
                Route::put('/ewmp/update/{id}', [SumberDayaManusiaController::class, 'updateEWMP'])->name('ewmp.update');
                Route::delete('/ewmp/delete/{id}', [SumberDayaManusiaController::class, 'deleteEWMP'])->name('ewmp.delete');
                Route::put('/ewmp/approve/{id}', [SumberDayaManusiaController::class, 'approveEWMP'])->name('ewmp.approve');
                Route::put('/ewmp/reject/{id}', [SumberDayaManusiaController::class, 'rejectEWMP'])->name('ewmp.reject');

                // Dosen Tidak Tetap
                Route::get('/dosen-tidak-tetap', [SumberDayaManusiaController::class, 'showDosenTidakTetap'])->name('dosen-tidak-tetap');
                Route::post('/dosen-tidak-tetap/store', [SumberDayaManusiaController::class, 'storeDosenTidakTetap'])->name('dosen-tidak-tetap.store');
                Route::get('/dosen-tidak-tetap/create', [SumberDayaManusiaController::class, 'createDosenTidakTetap'])->name('dosen-tidak-tetap.create');
                Route::get('/dosen-tidak-tetap/edit/{id}', [SumberDayaManusiaController::class, 'editDosenTidakTetap'])->name('dosen-tidak-tetap.edit');
                Route::put('/dosen-tidak-tetap/update/{id}', [SumberDayaManusiaController::class, 'updateDosenTidakTetap'])->name('dosen-tidak-tetap.update');
                Route::delete('/dosen-tidak-tetap/delete/{id}', [SumberDayaManusiaController::class, 'deleteDosenTidakTetap'])->name('dosen-tidak-tetap.delete');
                Route::put('/dosen-tidak-tetap/approve/{id}', [SumberDayaManusiaController::class, 'approveDosenTidakTetap'])->name('dosen-tidak-tetap.approve');
                Route::put('/dosen-tidak-tetap/reject/{id}', [SumberDayaManusiaController::class, 'rejectDosenTidakTetap'])->name('dosen-tidak-tetap.reject');

                // Dosen Industri/Praktisi
                Route::get('/dosen-industri-praktisi', [SumberDayaManusiaController::class, 'showDosenIndustriPraktisi'])->name('dosen-industri-praktisi');
                Route::post('/dosen-industri-praktisi/store', [SumberDayaManusiaController::class, 'storeDosenIndustriPraktisi'])->name('dosen-industri-praktisi.store');
                Route::get('/dosen-industri-praktisi/create', [SumberDayaManusiaController::class, 'createDosenIndustriPraktisi'])->name('dosen-industri-praktisi.create');
                Route::get('/dosen-industri-praktisi/edit/{id}', [SumberDayaManusiaController::class, 'editDosenIndustriPraktisi'])->name('dosen-industri-praktisi.edit');
                Route::put('/dosen-industri-praktisi/update/{id}', [SumberDayaManusiaController::class, 'updateDosenIndustriPraktisi'])->name('dosen-industri-praktisi.update');
                Route::delete('/dosen-industri-praktisi/delete/{id}', [SumberDayaManusiaController::class, 'deleteDosenIndustriPraktisi'])->name('dosen-industri-praktisi.delete');
                Route::put('/dosen-industri-praktisi/approve/{id}', [SumberDayaManusiaController::class, 'approveDosenIndustriPraktisi'])->name('dosen-industri-praktisi.approve');
                Route::put('/dosen-industri-praktisi/reject/{id}', [SumberDayaManusiaController::class, 'rejectDosenIndustriPraktisi'])->name('dosen-industri-praktisi.reject');

                // Rekognisi Dosen
                Route::get('/rekognisi-dosen', [SumberDayaManusiaController::class, 'showRekognisiDosen'])->name('rekognisi-dosen');
                Route::post('/rekognisi-dosen/store', [SumberDayaManusiaController::class, 'storeRekognisiDosen'])->name('rekognisi-dosen.store');
                Route::get('/rekognisi-dosen/create', [SumberDayaManusiaController::class, 'createRekognisiDosen'])->name('rekognisi-dosen.create');
                Route::get('/rekognisi-dosen/edit/{id}', [SumberDayaManusiaController::class, 'editRekognisiDosen'])->name('rekognisi-dosen.edit');
                Route::put('/rekognisi-dosen/update/{id}', [SumberDayaManusiaController::class, 'updateRekognisiDosen'])->name('rekognisi-dosen.update');
                Route::delete('/rekognisi-dosen/delete/{id}', [SumberDayaManusiaController::class, 'deleteRekognisiDosen'])->name('rekognisi-dosen.delete');
                Route::put('/rekognisi-dosen/approve/{id}', [SumberDayaManusiaController::class, 'approveRekognisiDosen'])->name('rekognisi-dosen.approve');
                Route::put('/rekognisi-dosen/reject/{id}', [SumberDayaManusiaController::class, 'rejectRekognisiDosen'])->name('rekognisi-dosen.reject');

                //Penelitian DTPS
                Route::get('/penelitian-dtps', [SumberDayaManusiaController::class, 'showPenelitianDTPS'])->name('penelitian-dtps');
                Route::post('/penelitian-dtps/store', [SumberDayaManusiaController::class, 'storePenelitianDTPS'])->name('penelitian-dtps.store');
                Route::get('/penelitian-dtps/create', [SumberDayaManusiaController::class, 'createPenelitianDTPS'])->name('penelitian-dtps.create');
                Route::get('/penelitian-dtps/edit/{id}', [SumberDayaManusiaController::class, 'editPenelitianDTPS'])->name('penelitian-dtps.edit');
                Route::put('/penelitian-dtps/update/{id}', [SumberDayaManusiaController::class, 'updatePenelitianDTPS'])->name('penelitian-dtps.update');
                Route::delete('/penelitian-dtps/delete/{id}', [SumberDayaManusiaController::class, 'deletePenelitianDTPS'])->name('penelitian-dtps.delete');
                Route::put('/penelitian-dtps/approve/{id}', [SumberDayaManusiaController::class, 'approvePenelitianDTPS'])->name('penelitian-dtps.approve');
                Route::put('/penelitian-dtps/reject/{id}', [SumberDayaManusiaController::class, 'rejectPenelitianDTPS'])->name('penelitian-dtps.reject');

                // PKM DTPS
                Route::get('/pkm-dtps', [SumberDayaManusiaController::class, 'showPKMDTPS'])->name('pkm-dtps');
                Route::post('/pkm-dtps/store', [SumberDayaManusiaController::class, 'storePKMDTPS'])->name('pkm-dtps.store');
                Route::get('/pkm-dtps/create', [SumberDayaManusiaController::class, 'createPKMDTPS'])->name('pkm-dtps.create');
                Route::get('/pkm-dtps/edit/{id}', [SumberDayaManusiaController::class, 'editPKMDTPS'])->name('pkm-dtps.edit');
                Route::put('/pkm-dtps/update/{id}', [SumberDayaManusiaController::class, 'updatePKMDTPS'])->name('pkm-dtps.update');
                Route::delete('/pkm-dtps/delete/{id}', [SumberDayaManusiaController::class, 'deletePKMDTPS'])->name('pkm-dtps.delete');
                Route::put('/pkm-dtps/approve/{id}', [SumberDayaManusiaController::class, 'approvePKMDTPS'])->name('pkm-dtps.approve');
                Route::put('/pkm-dtps/reject/{id}', [SumberDayaManusiaController::class, 'rejectPKMDTPS'])->name('pkm-dtps.reject');

                // Publikasi Ilmiah DTPS
                Route::get('/publikasi-ilmiah-dtps', [SumberDayaManusiaController::class, 'showPublikasiIlmiahDTPS'])->name('publikasi-ilmiah-dtps');
                Route::post('/publikasi-ilmiah-dtps/store', [SumberDayaManusiaController::class, 'storePublikasiIlmiahDTPS'])->name('publikasi-ilmiah-dtps.store');
                Route::get('/publikasi-ilmiah-dtps/create', [SumberDayaManusiaController::class, 'createPublikasiIlmiahDTPS'])->name('publikasi-ilmiah-dtps.create');
                Route::get('/publikasi-ilmiah-dtps/edit/{id}', [SumberDayaManusiaController::class, 'editPublikasiIlmiahDTPS'])->name('publikasi-ilmiah-dtps.edit');
                Route::put('/publikasi-ilmiah-dtps/update/{id}', [SumberDayaManusiaController::class, 'updatePublikasiIlmiahDTPS'])->name('publikasi-ilmiah-dtps.update');
                Route::delete('/publikasi-ilmiah-dtps/delete/{id}', [SumberDayaManusiaController::class, 'deletePublikasiIlmiahDTPS'])->name('publikasi-ilmiah-dtps.delete');
                Route::put('/publikasi-ilmiah-dtps/approve/{id}', [SumberDayaManusiaController::class, 'approvePublikasiIlmiahDTPS'])->name('publikasi-ilmiah-dtps.approve');
                Route::put('/publikasi-ilmiah-dtps/reject/{id}', [SumberDayaManusiaController::class, 'rejectPublikasiIlmiahDTPS'])->name('publikasi-ilmiah-dtps.reject');

                // Pagelaran Ilmiah DTPS
                Route::get('/pagelaran-ilmiah-dtps', [SumberDayaManusiaController::class, 'showPagelaranIlmiahDTPS'])->name('pagelaran-ilmiah-dtps');
                Route::post('/pagelaran-ilmiah-dtps/store', [SumberDayaManusiaController::class, 'storePagelaranIlmiahDTPS'])->name('pagelaran-ilmiah-dtps.store');
                Route::get('/pagelaran-ilmiah-dtps/create', [SumberDayaManusiaController::class, 'createPagelaranIlmiahDTPS'])->name('pagelaran-ilmiah-dtps.create');
                Route::get('/pagelaran-ilmiah-dtps/edit/{id}', [SumberDayaManusiaController::class, 'editPagelaranIlmiahDTPS'])->name('pagelaran-ilmiah-dtps.edit');
                Route::put('/pagelaran-ilmiah-dtps/update/{id}', [SumberDayaManusiaController::class, 'updatePagelaranIlmiahDTPS'])->name('pagelaran-ilmiah-dtps.update');
                Route::delete('/pagelaran-ilmiah-dtps/delete/{id}', [SumberDayaManusiaController::class, 'deletePagelaranIlmiahDTPS'])->name('pagelaran-ilmiah-dtps.delete');
                Route::put('/pagelaran-ilmiah-dtps/approve/{id}', [SumberDayaManusiaController::class, 'approvePagelaranIlmiahDTPS'])->name('pagelaran-ilmiah-dtps.approve');
                Route::put('/pagelaran-ilmiah-dtps/reject/{id}', [SumberDayaManusiaController::class, 'rejectPagelaranIlmiahDTPS'])->name('pagelaran-ilmiah-dtps.reject');

                // Luaran Penelitian DTPS Bagian 1 - HKI Paten
                Route::get('/luaran-penelitian-pkm-hki-paten', [SumberDayaManusiaController::class, 'showLuaranPenelitianDTPSBagian1'])->name('luaran-penelitian-pkm-hki-paten');
                Route::post('/luaran-penelitian-pkm-hki-paten/store', [SumberDayaManusiaController::class, 'storeLuaranPenelitianDTPSBagian1'])->name('luaran-penelitian-pkm-hki-paten.store');
                Route::get('/luaran-penelitian-pkm-hki-paten/create', [SumberDayaManusiaController::class, 'createLuaranPenelitianDTPSBagian1'])->name('luaran-penelitian-pkm-hki-paten.create');
                Route::get('/luaran-penelitian-pkm-hki-paten/edit/{id}', [SumberDayaManusiaController::class, 'editLuaranPenelitianDTPSBagian1'])->name('luaran-penelitian-pkm-hki-paten.edit');
                Route::put('/luaran-penelitian-pkm-hki-paten/update/{id}', [SumberDayaManusiaController::class, 'updateLuaranPenelitianDTPSBagian1'])->name('luaran-penelitian-pkm-hki-paten.update');
                Route::delete('/luaran-penelitian-pkm-hki-paten/delete/{id}', [SumberDayaManusiaController::class, 'deleteLuaranPenelitianDTPSBagian1'])->name('luaran-penelitian-pkm-hki-paten.delete');
                Route::put('/luaran-penelitian-pkm-hki-paten/approve/{id}', [SumberDayaManusiaController::class, 'approveLuaranPenelitianDTPSBagian1'])->name('luaran-penelitian-pkm-hki-paten.approve');
                Route::put('/luaran-penelitian-pkm-hki-paten/reject/{id}', [SumberDayaManusiaController::class, 'rejectLuaranPenelitianDTPSBagian1'])->name('luaran-penelitian-pkm-hki-paten.reject');

                // Luaran Penelitian DTPS Bagian 2 - HKI Hak Cipta
                Route::get('/luaran-penelitian-pkm-hki-hak-cipta', [SumberDayaManusiaController::class, 'showLuaranPenelitianDTPSBagian2'])->name('luaran-penelitian-pkm-hki-hak-cipta');
                Route::post('/luaran-penelitian-pkm-hki-hak-cipta/store', [SumberDayaManusiaController::class, 'storeLuaranPenelitianDTPSBagian2'])->name('luaran-penelitian-pkm-hki-hak-cipta.store');
                Route::get('/luaran-penelitian-pkm-hki-hak-cipta/create', [SumberDayaManusiaController::class, 'createLuaranPenelitianDTPSBagian2'])->name('luaran-penelitian-pkm-hki-hak-cipta.create');
                Route::get('/luaran-penelitian-pkm-hki-hak-cipta/edit/{id}', [SumberDayaManusiaController::class, 'editLuaranPenelitianDTPSBagian2'])->name('luaran-penelitian-pkm-hki-hak-cipta.edit');
                Route::put('/luaran-penelitian-pkm-hki-hak-cipta/update/{id}', [SumberDayaManusiaController::class, 'updateLuaranPenelitianDTPSBagian2'])->name('luaran-penelitian-pkm-hki-hak-cipta.update');
                Route::delete('/luaran-penelitian-pkm-hki-hak-cipta/delete/{id}', [SumberDayaManusiaController::class, 'deleteLuaranPenelitianDTPSBagian2'])->name('luaran-penelitian-pkm-hki-hak-cipta.delete');
                Route::put('/luaran-penelitian-pkm-hki-hak-cipta/approve/{id}', [SumberDayaManusiaController::class, 'approveLuaranPenelitianDTPSBagian2'])->name('luaran-penelitian-pkm-hki-hak-cipta.approve');
                Route::put('/luaran-penelitian-pkm-hki-hak-cipta/reject/{id}', [SumberDayaManusiaController::class, 'rejectLuaranPenelitianDTPSBagian2'])->name('luaran-penelitian-pkm-hki-hak-cipta.reject');

                // Luaran Penelitian DTPS Bagian 3 - Teknologi
                Route::get('/luaran-penelitian-pkm-teknologi', [SumberDayaManusiaController::class, 'showLuaranPenelitianDTPSBagian3'])->name('luaran-penelitian-pkm-teknologi');
                Route::post('/luaran-penelitian-pkm-teknologi/store', [SumberDayaManusiaController::class, 'storeLuaranPenelitianDTPSBagian3'])->name('luaran-penelitian-pkm-teknologi.store');
                Route::get('/luaran-penelitian-pkm-teknologi/create', [SumberDayaManusiaController::class, 'createLuaranPenelitianDTPSBagian3'])->name('luaran-penelitian-pkm-teknologi.create');
                Route::get('/luaran-penelitian-pkm-teknologi/edit/{id}', [SumberDayaManusiaController::class, 'editLuaranPenelitianDTPSBagian3'])->name('luaran-penelitian-pkm-teknologi.edit');
                Route::put('/luaran-penelitian-pkm-teknologi/update/{id}', [SumberDayaManusiaController::class, 'updateLuaranPenelitianDTPSBagian3'])->name('luaran-penelitian-pkm-teknologi.update');
                Route::delete('/luaran-penelitian-pkm-teknologi/delete/{id}', [SumberDayaManusiaController::class, 'deleteLuaranPenelitianDTPSBagian3'])->name('luaran-penelitian-pkm-teknologi.delete');
                Route::put('/luaran-penelitian-pkm-teknologi/approve/{id}', [SumberDayaManusiaController::class, 'approveLuaranPenelitianDTPSBagian3'])->name('luaran-penelitian-pkm-teknologi.approve');
                Route::put('/luaran-penelitian-pkm-teknologi/reject/{id}', [SumberDayaManusiaController::class, 'rejectLuaranPenelitianDTPSBagian3'])->name('luaran-penelitian-pkm-teknologi.reject');

                // Luaran Penelitian DTPS Bagian 4 - Buku
                Route::get('/luaran-penelitian-pkm-buku', [SumberDayaManusiaController::class, 'showLuaranPenelitianDTPSBagian4'])->name('luaran-penelitian-pkm-buku');
                Route::post('/luaran-penelitian-pkm-buku/store', [SumberDayaManusiaController::class, 'storeLuaranPenelitianDTPSBagian4'])->name('luaran-penelitian-pkm-buku.store');
                Route::get('/luaran-penelitian-pkm-buku/create', [SumberDayaManusiaController::class, 'createLuaranPenelitianDTPSBagian4'])->name('luaran-penelitian-pkm-buku.create');
                Route::get('/luaran-penelitian-pkm-buku/edit/{id}', [SumberDayaManusiaController::class, 'editLuaranPenelitianDTPSBagian4'])->name('luaran-penelitian-pkm-buku.edit');
                Route::put('/luaran-penelitian-pkm-buku/update/{id}', [SumberDayaManusiaController::class, 'updateLuaranPenelitianDTPSBagian4'])->name('luaran-penelitian-pkm-buku.update');
                Route::delete('/luaran-penelitian-pkm-buku/delete/{id}', [SumberDayaManusiaController::class, 'deleteLuaranPenelitianDTPSBagian4'])->name('luaran-penelitian-pkm-buku.delete');
                Route::put('/luaran-penelitian-pkm-buku/approve/{id}', [SumberDayaManusiaController::class, 'approveLuaranPenelitianDTPSBagian4'])->name('luaran-penelitian-pkm-buku.approve');
                Route::put('/luaran-penelitian-pkm-buku/reject/{id}', [SumberDayaManusiaController::class, 'rejectLuaranPenelitianDTPSBagian4'])->name('luaran-penelitian-pkm-buku.reject');

                // Karya Ilmiah DTPS Disitasi
                Route::get('/karya-ilmiah-dtps-disitasi', [SumberDayaManusiaController::class, 'showKaryaIlmiahDTPSDisitasi'])->name('karya-ilmiah-dtps-disitasi');
                Route::post('/karya-ilmiah-dtps-disitasi/store', [SumberDayaManusiaController::class, 'storeKaryaIlmiahDTPSDisitasi'])->name('karya-ilmiah-dtps-disitasi.store');
                Route::get('/karya-ilmiah-dtps-disitasi/create', [SumberDayaManusiaController::class, 'createKaryaIlmiahDTPSDisitasi'])->name('karya-ilmiah-dtps-disitasi.create');
                Route::get('/karya-ilmiah-dtps-disitasi/edit/{id}', [SumberDayaManusiaController::class, 'editKaryaIlmiahDTPSDisitasi'])->name('karya-ilmiah-dtps-disitasi.edit');
                Route::put('/karya-ilmiah-dtps-disitasi/update/{id}', [SumberDayaManusiaController::class, 'updateKaryaIlmiahDTPSDisitasi'])->name('karya-ilmiah-dtps-disitasi.update');
                Route::delete('/karya-ilmiah-dtps-disitasi/delete/{id}', [SumberDayaManusiaController::class, 'deleteKaryaIlmiahDTPSDisitasi'])->name('karya-ilmiah-dtps-disitasi.delete');
                Route::put('/karya-ilmiah-dtps-disitasi/approve/{id}', [SumberDayaManusiaController::class, 'approveKaryaIlmiahDTPSDisitasi'])->name('karya-ilmiah-dtps-disitasi.approve');
                Route::put('/karya-ilmiah-dtps-disitasi/reject/{id}', [SumberDayaManusiaController::class, 'rejectKaryaIlmiahDTPSDisitasi'])->name('karya-ilmiah-dtps-disitasi.reject');

                // Produk Jasa Masyarakat
                Route::get('/produk-jasa-masyarakat', [SumberDayaManusiaController::class, 'showProdukJasaMasyarakat'])->name('produk-jasa-masyarakat');
                Route::post('/produk-jasa-masyarakat/store', [SumberDayaManusiaController::class, 'storeProdukJasaMasyarakat'])->name('produk-jasa-masyarakat.store');
                Route::get('/produk-jasa-masyarakat/create', [SumberDayaManusiaController::class, 'createProdukJasaMasyarakat'])->name('produk-jasa-masyarakat.create');
                Route::get('/produk-jasa-masyarakat/edit/{id}', [SumberDayaManusiaController::class, 'editProdukJasaMasyarakat'])->name('produk-jasa-masyarakat.edit');
                Route::put('/produk-jasa-masyarakat/update/{id}', [SumberDayaManusiaController::class, 'updateProdukJasaMasyarakat'])->name('produk-jasa-masyarakat.update');
                Route::delete('/produk-jasa-masyarakat/delete/{id}', [SumberDayaManusiaController::class, 'deleteProdukJasaMasyarakat'])->name('produk-jasa-masyarakat.delete');
                Route::put('/produk-jasa-masyarakat/approve/{id}', [SumberDayaManusiaController::class, 'approveProdukJasaMasyarakat'])->name('produk-jasa-masyarakat.approve');
                Route::put('/produk-jasa-masyarakat/reject/{id}', [SumberDayaManusiaController::class, 'rejectProdukJasaMasyarakat'])->name('produk-jasa-masyarakat.reject');
            });

            // Penggunaan Dana
            Route::get('/penggunaan-dana', [PenggunaanDanaController::class, 'showPenggunaanDana'])->name('penggunaan-dana');
            Route::post('/penggunaan-dana/store', [PenggunaanDanaController::class, 'storePenggunaanDana'])->name('penggunaan-dana.store');
            Route::get('/penggunaan-dana/create', [PenggunaanDanaController::class, 'createPenggunaanDana'])->name('penggunaan-dana.create');
            Route::get('/penggunaan-dana/edit/{id}', [PenggunaanDanaController::class, 'editPenggunaanDana'])->name('penggunaan-dana.edit');
            Route::put('/penggunaan-dana/update/{id}', [PenggunaanDanaController::class, 'updatePenggunaanDana'])->name('penggunaan-dana.update');
            Route::delete('/penggunaan-dana/delete/{id}', [PenggunaanDanaController::class, 'deletePenggunaanDana'])->name('penggunaan-dana.delete');
            Route::put('/penggunaan-dana/approve/{id}', [PenggunaanDanaController::class, 'approvePenggunaanDana'])->name('penggunaan-dana.approve');
            Route::put('/penggunaan-dana/reject/{id}', [PenggunaanDanaController::class, 'rejectPenggunaanDana'])->name('penggunaan-dana.reject');

            // Pendidikan
            Route::prefix('pendidikan')->group(function () {
                //kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran
                Route::get('/kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran', [PendidikanController::class, 'showKurikulumCapaianPembelajaranDanRencanaPembelajaran'])->name('kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran');
                Route::post('/kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran/store', [PendidikanController::class, 'storeKurikulumCapaianPembelajaranDanRencanaPembelajaran'])->name('kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran.store');
                Route::get('/kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran/create', [PendidikanController::class, 'createKurikulumCapaianPembelajaranDanRencanaPembelajaran'])->name('kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran.create');
                Route::get('/kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran/edit/{id}', [PendidikanController::class, 'editKurikulumCapaianPembelajaranDanRencanaPembelajaran'])->name('kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran.edit');
                Route::put('/kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran/update/{id}', [PendidikanController::class, 'updateKurikulumCapaianPembelajaranDanRencanaPembelajaran'])->name('kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran.update');
                Route::delete('/kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran/delete/{id}', [PendidikanController::class, 'deleteKurikulumCapaianPembelajaranDanRencanaPembelajaran'])->name('kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran.delete');
                Route::put('/kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran/approve/{id}', [PendidikanController::class, 'approveKurikulumCapaianPembelajaranDanRencanaPembelajaran'])->name('kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran.approve');
                Route::put('/kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran/reject/{id}', [PendidikanController::class, 'rejectKurikulumCapaianPembelajaranDanRencanaPembelajaran'])->name('kurikulum-capaian-pembelajaran-dan-rencana-pembelajaran.reject');

                //integrasi-kegiatan-penelitian-pkm-dalam-pembelajaran
                Route::get('/integrasi-kegiatan-penelitian-pkm-dalam-pembelajaran', [PendidikanController::class, 'showIntegrasiKegiatanPenelitianPKMDalamPembelajaran'])->name('integrasi-kegiatan-penelitian-pkm-dalam-pembelajaran');
                Route::post('/integrasi-kegiatan-penelitian-pkm-dalam-pembelajaran/store', [PendidikanController::class, 'storeIntegrasiKegiatanPenelitianPKMDalamPembelajaran'])->name('integrasi-kegiatan-penelitian-pkm-dalam-pembelajaran.store');
                Route::get('/integrasi-kegiatan-penelitian-pkm-dalam-pembelajaran/create', [PendidikanController::class, 'createIntegrasiKegiatanPenelitianPKMDalamPembelajaran'])->name('integrasi-kegiatan-penelitian-pkm-dalam-pembelajaran.create');
                Route::get('/integrasi-kegiatan-penelitian-pkm-dalam-pembelajaran/edit/{id}', [PendidikanController::class, 'editIntegrasiKegiatanPenelitianPKMDalamPembelajaran'])->name('integrasi-kegiatan-penelitian-pkm-dalam-pembelajaran.edit');
                Route::put('/integrasi-kegiatan-penelitian-pkm-dalam-pembelajaran/update/{id}', [PendidikanController::class, 'updateIntegrasiKegiatanPenelitianPKMDalamPembelajaran'])->name('integrasi-kegiatan-penelitian-pkm-dalam-pembelajaran.update');
                Route::delete('/integrasi-kegiatan-penelitian-pkm-dalam-pembelajaran/delete/{id}', [PendidikanController::class, 'deleteIntegrasiKegiatanPenelitianPKMDalamPembelajaran'])->name('integrasi-kegiatan-penelitian-pkm-dalam-pembelajaran.delete');
                Route::put('/integrasi-kegiatan-penelitian-pkm-dalam-pembelajaran/approve/{id}', [PendidikanController::class, 'approveIntegrasiKegiatanPenelitianPKMDalamPembelajaran'])->name('integrasi-kegiatan-penelitian-pkm-dalam-pembelajaran.approve');
                Route::put('/integrasi-kegiatan-penelitian-pkm-dalam-pembelajaran/reject/{id}', [PendidikanController::class, 'rejectIntegrasiKegiatanPenelitianPKMDalamPembelajaran'])->name('integrasi-kegiatan-penelitian-pkm-dalam-pembelajaran.reject');

                //kepuasan-mahasiswa
                Route::get('/kepuasan-mahasiswa', [PendidikanController::class, 'showKepuasanMahasiswa'])->name('kepuasan-mahasiswa');
                Route::post('/kepuasan-mahasiswa/store', [PendidikanController::class, 'storeKepuasanMahasiswa'])->name('kepuasan-mahasiswa.store');
                Route::get('/kepuasan-mahasiswa/create', [PendidikanController::class, 'createKepuasanMahasiswa'])->name('kepuasan-mahasiswa.create');
                Route::get('/kepuasan-mahasiswa/edit/{id}', [PendidikanController::class, 'editKepuasanMahasiswa'])->name('kepuasan-mahasiswa.edit');
                Route::put('/kepuasan-mahasiswa/update/{id}', [PendidikanController::class, 'updateKepuasanMahasiswa'])->name('kepuasan-mahasiswa.update');
                Route::delete('/kepuasan-mahasiswa/delete/{id}', [PendidikanController::class, 'deleteKepuasanMahasiswa'])->name('kepuasan-mahasiswa.delete');
                Route::put('/kepuasan-mahasiswa/approve/{id}', [PendidikanController::class, 'approveKepuasanMahasiswa'])->name('kepuasan-mahasiswa.approve');
                Route::put('/kepuasan-mahasiswa/reject/{id}', [PendidikanController::class, 'rejectKepuasanMahasiswa'])->name('kepuasan-mahasiswa.reject');
            });

            //Pengabdian Masayarakat
            Route::prefix('pengabdian-masyarakat')->group(function (){
                //penelitian-dtps-melibatkan-mahasiswa
                Route::get('/penelitian-dtps-melibatkan-mahasiswa', [PengabdianMasyarakatController::class, 'showPenelitianDTPSMelibatkanMahasiswa'])->name('penelitian-dtps-melibatkan-mahasiswa');
                Route::post('/penelitian-dtps-melibatkan-mahasiswa/store', [PengabdianMasyarakatController::class, 'storePenelitianDTPSMelibatkanMahasiswa'])->name('penelitian-dtps-melibatkan-mahasiswa.store');
                Route::get('/penelitian-dtps-melibatkan-mahasiswa/create', [PengabdianMasyarakatController::class, 'createPenelitianDTPSMelibatkanMahasiswa'])->name('penelitian-dtps-melibatkan-mahasiswa.create');
                Route::get('/penelitian-dtps-melibatkan-mahasiswa/edit/{id}', [PengabdianMasyarakatController::class, 'editPenelitianDTPSMelibatkanMahasiswa'])->name('penelitian-dtps-melibatkan-mahasiswa.edit');
                Route::put('/penelitian-dtps-melibatkan-mahasiswa/update/{id}', [PengabdianMasyarakatController::class, 'updatePenelitianDTPSMelibatkanMahasiswa'])->name('penelitian-dtps-melibatkan-mahasiswa.update');
                Route::delete('/penelitian-dtps-melibatkan-mahasiswa/delete/{id}', [PengabdianMasyarakatController::class, 'deletePenelitianDTPSMelibatkanMahasiswa'])->name('penelitian-dtps-melibatkan-mahasiswa.delete');
                Route::put('/penelitian-dtps-melibatkan-mahasiswa/approve/{id}', [PengabdianMasyarakatController::class, 'approvePenelitianDTPSMelibatkanMahasiswa'])->name('penelitian-dtps-melibatkan-mahasiswa.approve');
                Route::put('/penelitian-dtps-melibatkan-mahasiswa/reject/{id}', [PengabdianMasyarakatController::class, 'rejectPenelitianDTPSMelibatkanMahasiswa'])->name('penelitian-dtps-melibatkan-mahasiswa.reject');

                //pkm-dtps-yang-melibatkan-mahasiswa
                Route::get('/pkm-dtps-yang-melibatkan-mahasiswa', [PengabdianMasyarakatController::class, 'showPKMDTPSYangMelibatkanMahasiswa'])->name('pkm-dtps-yang-melibatkan-mahasiswa');
                Route::post('/pkm-dtps-yang-melibatkan-mahasiswa/store', [PengabdianMasyarakatController::class, 'storePKMDTPSYangMelibatkanMahasiswa'])->name('pkm-dtps-yang-melibatkan-mahasiswa.store');
                Route::get('/pkm-dtps-yang-melibatkan-mahasiswa/create', [PengabdianMasyarakatController::class, 'createPKMDTPSYangMelibatkanMahasiswa'])->name('pkm-dtps-yang-melibatkan-mahasiswa.create');
                Route::get('/pkm-dtps-yang-melibatkan-mahasiswa/edit/{id}', [PengabdianMasyarakatController::class, 'editPKMDTPSYangMelibatkanMahasiswa'])->name('pkm-dtps-yang-melibatkan-mahasiswa.edit');
                Route::put('/pkm-dtps-yang-melibatkan-mahasiswa/update/{id}', [PengabdianMasyarakatController::class, 'updatePKMDTPSYangMelibatkanMahasiswa'])->name('pkm-dtps-yang-melibatkan-mahasiswa.update');
                Route::delete('/pkm-dtps-yang-melibatkan-mahasiswa/delete/{id}', [PengabdianMasyarakatController::class, 'deletePKMDTPSYangMelibatkanMahasiswa'])->name('pkm-dtps-yang-melibatkan-mahasiswa.delete');
                Route::put('/pkm-dtps-yang-melibatkan-mahasiswa/approve/{id}', [PengabdianMasyarakatController::class, 'approvePKMDTPSYangMelibatkanMahasiswa'])->name('pkm-dtps-yang-melibatkan-mahasiswa.approve');
                Route::put('/pkm-dtps-yang-melibatkan-mahasiswa/reject/{id}', [PengabdianMasyarakatController::class, 'rejectPKMDTPSYangMelibatkanMahasiswa'])->name('pkm-dtps-yang-melibatkan-mahasiswa.reject');
            });
        });
    });
});

//route for prodi and admin prodi, using middleware is-authenticated and can:prodi and can:admin-prodi
Route::prefix("sumber-daya-manusia")->as("sumber-daya-manusia.")->group(function () {
    Route::middleware(['is-authenticated'])->group(function () {
        Route::middleware(['prodi-or-admin-prodi'])->group(function () {
            //dosen industri/praktisi
            Route::get('/dosen-industri-praktisi', [SumberDayaManusiaController::class, "showDosenIndustriPraktisi"])->name('dosen-industri-praktisi');
            Route::get('/dosen-industri-praktisi/create', [SumberDayaManusiaController::class, "createDosenIndustriPraktisi"])->name('dosen-industri-praktisi.create');
            Route::post('/dosen-industri-praktisi/store', [SumberDayaManusiaController::class, "storeDosenIndustriPraktisi"])->name('dosen-industri-praktisi.store');
            Route::get('/dosen-industri-praktisi/edit/{id}', [SumberDayaManusiaController::class, "editDosenIndustriPraktisi"])->name('dosen-industri-praktisi.edit');
            Route::put('/dosen-industri-praktisi/update/{id}', [SumberDayaManusiaController::class, "updateDosenIndustriPraktisi"])->name('dosen-industri-praktisi.update');
            Route::delete('/dosen-industri-praktisi/delete/{id}', [SumberDayaManusiaController::class, "deleteDosenIndustriPraktisi"])->name('dosen-industri-praktisi.delete');
            Route::put('/dosen-industri-praktisi/approve/{id}', [SumberDayaManusiaController::class, "approveDosenIndustriPraktisi"])->name('dosen-industri-praktisi.approve');
            Route::put('/dosen-industri-praktisi/reject/{id}', [SumberDayaManusiaController::class, "rejectDosenIndustriPraktisi"])->name('dosen-industri-praktisi.reject');
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
