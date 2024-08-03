<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dosen_tidak_tetaps', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nidn');
            $table->string('pendidikan_terakhir');
            $table->string('bidang_keahlian');
            $table->string('jabatan');
            $table->string('sertifikat_pendidik');
            $table->string('sertifikat_kompetensi');
            $table->string('mata_kuliah');
            $table->string('kesesuaian_bidang');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dosen_tidak_tetaps');
    }
};
