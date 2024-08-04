<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dosen_tetap_perguruan_tinggis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('nama');
            $table->string('nidn');
            $table->string('pendidikan_magister');
            $table->string('pendidikan_doktor');
            $table->string('bidang_keahlian');
            $table->boolean('kesesuaian');
            $table->string('jabatan_akademik');
            $table->string('sertifikat_pendidik');
            $table->string('sertifikat_kompetensi');
            $table->string('mata_kuliah_ps_diakreditasi');
            $table->string('kesesuaian_bidang_keahlian');
            $table->string('mata_kuliah_ps_lain');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dosen_tetap_perguruan_tinggis');
    }
};
