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
        Schema::create('industri_profesis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profesi_kerja_id')->constrained('profesi_kerjas')->onDelete('cascade');
            $table->foreignId('industri_id')->constrained('industris')->onDelete('cascade');
            $table->decimal('gaji', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('industri_profesis');
    }
};
