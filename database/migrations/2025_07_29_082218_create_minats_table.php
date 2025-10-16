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
        Schema::create('minats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_kuliah_id')->constrained('form_kuliahs')->onDelete('cascade');
            $table->foreignId('jurusan_kuliah_id')->nullable()->constrained('jurusan_kuliahs')->onDelete('cascade');
            $table->foreignId('hobi_id')->nullable()->constrained('hobis')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('minats');
    }
};
