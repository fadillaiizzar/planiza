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
        Schema::create('kontribusi_sdgs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('kategori_sdgs_id')->constrained('kategori_sdgs')->onDelete('cascade');
            $table->string('judul_kegiatan');
            $table->text('deskripsi_refleksi');
            $table->date('tanggal_pelaksanaan');
            $table->integer('durasi_kegiatan');
            $table->enum('jenis_kegiatan', ['individu','kelompok','event']);
            $table->enum('peran', ['peserta','panitia','ketua']);
            $table->text('bukti_upload');
            $table->enum('tingkat_dampak', ['rendah','sedang', 'tinggi'])->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontribusi_sdgs');
    }
};
