<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('dosen_tidak_tetaps', function (Blueprint $table) {
            //foreign id nullable
            $table->foreignId('user_id')->nullable()->constrained('users');
        });

        Schema::table('dosen_industri_praktisis', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('users');
        });
    }

};
