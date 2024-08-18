<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('rekognisi_dosens', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('bidang');
            $table->string('rekognisi');
            $table->string('bukti');
            $table->boolean('wilayah');
            $table->boolean('nasional');
            $table->boolean('internasional');
            $table->year('tahun');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rekognisi_dosens');
    }
};
