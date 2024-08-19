<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kepuasan_mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('aspek');
            $table->integer('sangat_baik');
            $table->integer('baik'); //percentase
            $table->integer('cukup'); //percentase
            $table->integer('kurang'); //percentase
            $table->string('rencana_tindak_lanjut');
            $table->integer('is_approve')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kepuasan_mahasiswas');
    }
};
