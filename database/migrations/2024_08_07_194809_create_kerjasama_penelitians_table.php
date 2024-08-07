<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kerjasama_penelitians', function (Blueprint $table) {
            $table->id();
            $table->string('lembaga');
            $table->boolean('internasional');
            $table->boolean('nasional');
            $table->boolean('lokal');
            $table->string('judul');
            $table->string('manfaat');
            $table->dateTime('durasi');
            $table->string('bukti');
            $table->year('tahun_kerjasama');
            $table->boolean('is_approved');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kerjasama_penelitians');
    }
};
