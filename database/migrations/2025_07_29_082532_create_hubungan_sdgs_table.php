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
        Schema::create('hubungan_sdgs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_sdgs_id')->constrained('kategori_sdgs')->onDelete('cascade');
            $table->foreignId('profesi_kerja_id')->nullable()->constrained('profesi_kerjas')->onDelete('cascade');
            $table->foreignId('jurusan_kuliah_id')->nullable()->constrained('jurusan_kuliahs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hubungan_sdgs');
    }
};
