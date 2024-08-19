<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('penggunaan_danas', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_penggunaan');
            $table->integer('unit_ts')->default(0);
            $table->integer('unit_ts1')->default(0);
            $table->integer('unit_ts2')->default(0);
            $table->integer('program_ts')->default(0);
            $table->integer('program_ts1')->default(0);
            $table->integer('program_ts2')->default(0);
            $table->integer('is_approve')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penggunaan_danas');
    }
};
