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
        Schema::table('minats', function (Blueprint $table) {
            $table->unsignedInteger('attempt')->default(1)->after('hobi_jurusan_id');
            $table->boolean('is_finished')->default(false)->after('attempt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('minats', function (Blueprint $table) {
            $table->dropColumn(['attempt', 'is_finished']);
        });
    }
};
