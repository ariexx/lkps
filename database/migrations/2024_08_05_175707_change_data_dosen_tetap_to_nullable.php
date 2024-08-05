<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('dosen_pembimbings', function (Blueprint $table) {
            $table->unsignedInteger('rata_rata_mahasiswa')->nullable()->change();
            $table->unsignedInteger('rata_rata_mahasiswa_lain')->nullable()->change();
        });
    }
};
