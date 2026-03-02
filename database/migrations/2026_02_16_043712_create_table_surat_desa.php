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
        Schema::create('Surat_desa', function (Blueprint $table) {
         $table->id();
         $table->string('judul');
         $table->enum('kategori', [
        'Peraturan Desa',
        'Keputusan Perbekel',
        'Pengumuman'
        ]);
        $table->year('tahun'); // 🔥 PENANDA TAHUN
        $table->string('file');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_desa');
    }
};
