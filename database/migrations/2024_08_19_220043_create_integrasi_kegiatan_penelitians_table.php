<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('integrasi_kegiatan_penelitians', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('nama_dosen');
            $table->string('mata_kuliah');
            $table->string('bentuk_integrasi');
            $table->string('tahun');
            $table->string('bukti');
            $table->integer('is_approve')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('integrasi_kegiatan_penelitians');
    }
};
