<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('karya_ilmiah_d_t_p_s_disitasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('judul_artikel');
            $table->integer('jumlah_sitasi');
            $table->string('bukti');
            $table->integer('is_approve');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('karya_ilmiah_d_t_p_s_disitasis');
    }
};
