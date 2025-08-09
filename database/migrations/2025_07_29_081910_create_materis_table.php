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
        Schema::create('materis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('topik_materi_id')->constrained('topik_materis')->onDelete('cascade');
            $table->string('nama_materi');
            $table->text('deskripsi_materi');
            $table->string('tipe_file', 20);
            $table->string('file_materi', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materis');
    }
};
