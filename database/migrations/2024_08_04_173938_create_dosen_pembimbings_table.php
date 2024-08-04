<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dosen_pembimbings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('name');
            $table->integer('jumlah_mahasiswa_dibimbing_ts');
            $table->integer('jumlah_mahasiswa_dibimbing_ts1');
            $table->integer('jumlah_mahasiswa_dibimbing_ts2');
            $table->float('rata_rata_mahasiswa');
            $table->string('jumlah_mahasiswa_dibimbing_ts_lain');
            $table->string('jumlah_mahasiswa_dibimbing_ts1_lain');
            $table->string('jumlah_mahasiswa_dibimbing_ts2_lain');
            $table->float('rata_rata_mahasiswa_lain');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dosen_pembimbings');
    }
};
