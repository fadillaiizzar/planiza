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
        Schema::create('profesi_kerjas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_profesi_kerja');
            $table->string('gambar')->nullable();
            $table->decimal('gaji', 15, 2);
            $table->text('deskripsi');
            $table->text('info_skill');
            $table->text('info_jurusan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesi_kerjas');
    }
};
