<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dosen_industri_praktisis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nidn');
            $table->string('perusahaan');
            $table->string('pendidikan_terakhir');
            $table->string('bidang_keahlian');
            $table->string('sertifikat_kompetensi');
            $table->string('mata_kuliah');
            $table->string('bobot_kredit');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dosen_industri_praktisis');
    }
};
