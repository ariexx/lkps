<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('seleksi_mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('tahun_akademik');
            $table->unsignedBigInteger('daya_tampung');
            $table->integer('pendaftar');
            $table->integer('lulus_seleksi');
            $table->integer('reguler_baru');
            $table->integer('transfer_baru');
            $table->integer('reguler_aktif');
            $table->integer('transfer_aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seleksi_mahasiswas');
    }
};
