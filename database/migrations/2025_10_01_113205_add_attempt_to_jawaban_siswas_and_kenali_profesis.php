<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::table('jawaban_siswas', function (Blueprint $table) {
            $table->unsignedInteger('attempt')->default(1)->after('tes_id');
        });

        Schema::table('kenali_profesis', function (Blueprint $table) {
            $table->unsignedInteger('attempt')->default(1)->after('tes_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jawaban_siswas', function (Blueprint $table) {
            $table->dropColumn('attempt');
        });

        Schema::table('kenali_profesis', function (Blueprint $table) {
            $table->dropColumn('attempt');
        });
    }
};
