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
        Schema::create('surat', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('jenis_surat_id');

            // nomor urut GLOBAL DESA
            $table->unsignedInteger('nomor_urut')->nullable();
            $table->string('nomor_surat')->nullable();

            $table->date('tanggal_surat')->nullable();

            $table->enum('status', [
                'draft',
                'selesai'
            ])->default('draft');

            $table->text('keterangan')->nullable();

            $table->timestamps();

            // FK
            $table->foreign('jenis_surat_id')->references('id')->on('jenis_surat');

            $table->index('nomor_urut');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat');
    }
};
