<?php

namespace App\Providers;

use App\Models\CapaianPembelajaran;
use App\Models\DosenIndustriPraktisi;
use App\Models\DosenPembimbing;
use App\Models\DosenTetapPerguruanTinggi;
use App\Models\DosenTidakTetap;
use App\Models\EWMP;
use App\Models\HKIBuku;
use App\Models\HKIHakCipta;
use App\Models\HKIPaten;
use App\Models\HKITeknologi;
use App\Models\IntegrasiKegiatanPenelitian;
use App\Models\KaryaIlmiahDTPSDisitasi;
use App\Models\KepuasanMahasiswa;
use App\Models\KerjasamaPendidikan;
use App\Models\KerjasamaPenelitian;
use App\Models\MahasiswaAsing;
use App\Models\PagelaranIlmiah;
use App\Models\PenelitianDtps;
use App\Models\PenelitianDTPSMelibatkanMahasiswa;
use App\Models\PenggunaanDana;
use App\Models\PkmDtps;
use App\Models\PKMDTPSMelibatkanMahasiswa;
use App\Models\ProdukJasaMasyarakat;
use App\Models\PublikasiIlmiahDTPS;
use App\Models\RekognisiDosen;
use App\Models\SeleksiMahasiswa;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Opcodes\LogViewer\Facades\LogViewer;

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

        LogViewer::auth(function ($request) {
            return true;
        });

        //Register the observer
        DosenTetapPerguruanTinggi::observe(\App\Observers\DosenTetapPerguruanTinggiObserver::class);
        DosenIndustriPraktisi::observe(\App\Observers\DosenIndustriPraktisiObserver::class);
        DosenPembimbing::observe(\App\Observers\DosenPembimbingObserver::class);
        DosenTidakTetap::observe(\App\Observers\DosenTidakTetapObserver::class);
        RekognisiDosen::observe(\App\Observers\RekognisiDosenObserver::class);
        KaryaIlmiahDTPSDisitasi::observe(\App\Observers\KaryaIlmiahDTPSDisitasiObserver::class);
        IntegrasiKegiatanPenelitian::observe(\App\Observers\IntegrasiKegiatanPenelitianObserver::class);
        PenelitianDTPSMelibatkanMahasiswa::observe(\App\Observers\PenelitianDTPSMelibatkanMahasiswaObserver::class);
        PkmDtpsMelibatkanMahasiswa::observe(\App\Observers\PKMDTPSMelibatkanMahasiswaObserver::class);
        CapaianPembelajaran::observe(\App\Observers\CapaianPembelajaranObserver::class);
        EWMP::observe(\App\Observers\EWMP::class);
        HKIBuku::observe(\App\Observers\HKIBukuObserver::class);
        HKIHakCipta::observe(\App\Observers\HKIHakCiptaObserver::class);
        HKIPaten::observe(\App\Observers\HKIPatenObserver::class);
        HKITeknologi::observe(\App\Observers\HKITeknologiObserver::class);
        KepuasanMahasiswa::observe(\App\Observers\KepuasanMahasiswaObserver::class);
        KerjasamaPendidikan::observe(\App\Observers\KerjasamaPendidikanObserver::class);
        KerjasamaPenelitian::observe(\App\Observers\KerjasamaPenelitianObserver::class);
        MahasiswaAsing::observe(\App\Observers\MahasiswaAsingObserver::class);
        PagelaranIlmiah::observe(\App\Observers\PagelaranIlmiahObserver::class);
        PenelitianDtps::observe(\App\Observers\PenelitianDtpsObserver::class);
        PenggunaanDana::observe(\App\Observers\PenggunaanDanaObserver::class);
        PkmDtps::observe(\App\Observers\PkmDtpsObserver::class);
        ProdukJasaMasyarakat::observe(\App\Observers\ProdukJasaMasyarakatObserver::class);
        PublikasiIlmiahDTPS::observe(\App\Observers\PublikasiIlmiahDTPSObserver::class);
        SeleksiMahasiswa::observe(\App\Observers\SeleksiMahasiswaObserver::class);
    }
}
