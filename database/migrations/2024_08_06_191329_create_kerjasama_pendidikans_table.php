<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kerjasama_pendidikans', function (Blueprint $table) {
            $table->id();
            $table->string('lembaga_mitra');
            $table->boolean('internasional');
            $table->boolean('nasional');
            $table->boolean('lokal');
            $table->string('judul_kegiatan');
            $table->longText('manfaat_ps_diakreditasi');
            $table->date('waktu_dan_durasi');
            $table->string('bukti_kerjasama');
            $table->year('tahun_berakhir_kerjasama');
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kerjasama_pendidikans');
    }
};
