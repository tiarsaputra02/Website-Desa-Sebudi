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
        Schema::create('surat_pihak', function (Blueprint $table) {
               $table->id();

            $table->unsignedBigInteger('surat_id');

            // bisa NULL (contoh: bayi baru lahir)
            $table->unsignedBigInteger('citizens_id')->nullable();

            // snapshot data
            $table->string('nama_lengkap');
            $table->string('nik')->nullable();
            $table->date('tanggal_lahir')->nullable();

            $table->enum('peran', [
                'ayah',
                'ibu',
                'anak',
                'suami',
                'istri',
                'almarhum',
                'pelapor'
            ]);

            $table->timestamps();

            // FK
            $table->foreign('surat_id')->references('id')->on('surat')->onDelete('cascade');
            $table->foreign('citizens_id')->references('id')->on('citizens')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_pihak');
    }
};
