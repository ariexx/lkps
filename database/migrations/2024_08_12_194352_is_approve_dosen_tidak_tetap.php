<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('dosen_tidak_tetaps', function (Blueprint $table) {
            $table->integer('is_approve')->default(0);
        });
    }
};
