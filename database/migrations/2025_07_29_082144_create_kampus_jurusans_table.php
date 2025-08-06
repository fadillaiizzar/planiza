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
        Schema::create('kampus_jurusans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jurusan_kuliah_id')->constrained('jurusan_kuliahs')->onDelete('cascade');
            $table->foreignId('kampus_id')->constrained('kampus')->onDelete('cascade');
            $table->integer('passing_grade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kampus_jurusans');
    }
};
