<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('produk_jasa_masyarakats', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nama_produk');
            $table->text('deskripsi');
            $table->string('bukti');
            $table->integer('is_approve')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk_jasa_masyarakats');
    }
};
