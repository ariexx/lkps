<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('penelitian_d_t_p_s_melibatkan_mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dosen');
            $table->string('tema_penelitian');
            $table->text('nama_mahasiswa'); //textarea
            $table->string('judul_kegiatan');
            $table->string('tahun');
            $table->string('bukti');
            $table->integer('is_approve')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penelitian_d_t_p_s_melibatkan_mahasiswas');
    }
};
