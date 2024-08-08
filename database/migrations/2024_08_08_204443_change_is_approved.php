<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('kerjasama_penelitians', function (Blueprint $table) {
            $table->unsignedInteger('is_approved')->default(0)->change(); //0 = not approved, 1 = approved, 2 = rejected
        });

        Schema::table('kerjasama_pendidikans', function (Blueprint $table) {
            $table->unsignedInteger('is_approved')->default(0)->change(); //0 = not approved, 1 = approved, 2 = rejected
        });
    }
};
