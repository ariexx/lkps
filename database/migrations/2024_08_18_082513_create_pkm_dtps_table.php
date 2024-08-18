<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pkm_dtps', function (Blueprint $table) {
            $table->id();
            $table->string('sumber_pembiayaan');
            $table->integer('ts');
            $table->integer('ts1');
            $table->integer('ts2');
            $table->integer('is_approve')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pkm_dtps');
    }
};
