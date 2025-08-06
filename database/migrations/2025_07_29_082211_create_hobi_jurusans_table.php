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
        Schema::create('hobi_jurusans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hobi_id')->constrained('hobis')->onDelete('cascade');
            $table->foreignId('jurusan_kuliah_id')->constrained('jurusan_kuliahs')->onDelete('cascade');
            $table->integer('poin')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hobi_jurusans');
    }
};
