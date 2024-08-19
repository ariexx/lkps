<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('capaian_pembelajarans', function (Blueprint $table) {
            $table->id();
            $table->string('semester');
            $table->string('kode');
            $table->string('mata_kuliah');
            $table->boolean('is_kompetensi')->nullable()->default(0);
            $table->integer('kuliah_responsi');
            $table->integer('seminar')->nullable()->default(0);
            $table->integer('praktikum')->nullable()->default(0);
            $table->boolean('sikap')->default(false);
            $table->boolean('pengetahuan')->default(false);
            $table->boolean('keterampilan_umum')->default(false);
            $table->boolean('keterampilan_khusus')->default(false);
            $table->string('dokumen_rencana'); // file upload
            $table->string('unit_penyelenggara');
            $table->integer('is_approve')->nullable()->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('capaian_pembelajarans');
    }
};
