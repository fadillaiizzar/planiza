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
        Schema::table('kenali_jurusans', function (Blueprint $table) {
            $table->unsignedInteger('attempt')->default(1)->after('jurusan_kuliah_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kenali_jurusans', function (Blueprint $table) {
            $table->dropColumn('attempt');
        });
    }
};
