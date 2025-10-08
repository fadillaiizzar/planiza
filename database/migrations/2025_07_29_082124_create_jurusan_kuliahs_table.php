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
        Schema::create('jurusan_kuliahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jurusan_kuliah');
            $table->string('gambar')->nullable();
            $table->text('deskripsi');
            $table->text('info_matkul');
            $table->text('info_prospek');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurusan_kuliahs');
    }
};
