<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('penelitian_d_t_p_s_melibatkan_mahasiswas', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('users');
        });
    }

    public function down(): void
    {
        Schema::table('penelitian_d_t_p_s_melibatkan_mahasiswas', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
        });
    }
};
