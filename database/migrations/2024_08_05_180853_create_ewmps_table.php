<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ewmps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('dtps');
            $table->integer('ps_diakreditasi');
            $table->integer('ps_lain_didalam_pt');
            $table->integer('pt_lain_diluar_pt');
            $table->integer('penelitian');
            $table->integer('pkm');
            $table->integer('tugas_tambahan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ewmps');
    }
};
