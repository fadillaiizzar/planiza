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
        Schema::table('kampus_jurusans', function (Blueprint $table) {
            $table->index('kampus_id', 'idx_kampus_id');
            $table->index('jurusan_kuliah_id', 'idx_jurusan_kuliah_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kampus_jurusans', function (Blueprint $table) {
            $table->dropIndex('idx_kampus_id');
            $table->dropIndex('idx_jurusan_kuliah_id');
        });
    }
};
