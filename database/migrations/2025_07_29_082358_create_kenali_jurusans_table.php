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
        Schema::create('kenali_jurusans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('form_kuliah_id')->nullable()->constrained('form_kuliahs')->onDelete('cascade');
            $table->foreignId('jurusan_kuliah_id')->nullable()->constrained('jurusan_kuliahs')->onDelete('cascade');
            $table->enum('sumber_rekomendasi', ['utbk', 'hobi', 'sdgs']);
            $table->enum('status_peluang', ['tinggi', 'sedang', 'rendah'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kenali_jurusans');
    }
};
