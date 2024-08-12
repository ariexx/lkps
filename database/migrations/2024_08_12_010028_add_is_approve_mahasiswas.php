<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('seleksi_mahasiswas', function (Blueprint $table) {
            $table->unsignedInteger('is_approve')->default(0)->after('transfer_aktif');
        });

        Schema::table('mahasiswa_asings', function (Blueprint $table) {
            $table->unsignedInteger('is_approve')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('seleksi_mahasiswas', function (Blueprint $table) {
            $table->dropColumn('is_approve');
        });

        Schema::table('mahasiswa_asings', function (Blueprint $table) {
            $table->dropColumn('is_approve');
        });
    }
};
