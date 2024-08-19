<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hki_bukus', function (Blueprint $table) {
            $table->id();
            $table->string('luaran_dan_pkm');
            $table->string('tahun');
            $table->text('keterangan');
            $table->string('bukti');
            $table->integer('is_approve')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hki_bukus');
    }
};
