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
        Schema::create('opsi_jawabans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('soal_tes_id')->constrained('soal_tes')->onDelete('cascade');
            $table->foreignId('kategori_minat_id')->nullable()->constrained('kategori_minats')->onDelete('cascade');
            $table->foreignId('profesi_kerja_id')->nullable()->constrained('profesi_kerjas')->onDelete('cascade');
            $table->text('isi_opsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opsi_jawabans');
    }
};
