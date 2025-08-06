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
        Schema::create('profesi_kategoris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_minat_id')->constrained('kategori_minats')->onDelete('cascade');
            $table->foreignId('profesi_kerja_id')->constrained('profesi_kerjas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesi_kategoris');
    }
};
