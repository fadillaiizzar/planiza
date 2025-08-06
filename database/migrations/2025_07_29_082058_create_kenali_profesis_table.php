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
        Schema::create('kenali_profesis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('tes_id')->constrained('tes')->onDelete('cascade');
            $table->foreignId('profesi_kerja_id')->constrained('profesi_kerjas')->onDelete('cascade');
            $table->enum('sumber_rekomendasi', ['tes', 'sdgs']);
            $table->integer('total_poin')->default(0);
            $table->integer('ranking')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kenali_profesis');
    }
};
