<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('publikasi_ilmiah_d_t_p_s', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_publikasi');
            $table->integer('ts');
            $table->integer('ts1');
            $table->integer('ts2');
            $table->integer('is_approve')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('publikasi_ilmiah_d_t_p_s');
    }
};
