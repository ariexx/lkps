<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('mahasiswa_asings', function (Blueprint $table) {
            $table->id();
            $table->string('program_studi');
            $table->integer('mahasiswa_aktif_ts2');
            $table->integer('mahasiswa_aktif_ts1');
            $table->string('mahasiswa_aktif_ts');
            $table->integer('mahasiswa_asing_full_time_ts2');
            $table->integer('mahasiswa_asing_full_time_ts1');
            $table->integer('mahasiswa_asing_full_time_ts');
            $table->integer('mahasiswa_asing_part_time_ts2');
            $table->integer('mahasiswa_asing_part_time_ts1');
            $table->string('mahasiswa_asing_part_time_ts');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_asings');
    }
};
