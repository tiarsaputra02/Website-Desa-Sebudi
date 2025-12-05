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
        Schema::create('bpjs_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warga_id')->nullable()->contrained('citizens')->onDelete('cascade');
            $table->enum('jenis_bpjs', [
                'BPJS Kesehatan',
                'BPJS Ketenagakerjaan'
            ]);
            $table->string('kategori')->nullable();

            $table->enum('status', [
                'Active',
                'Non Active'
            ])->default('Active');

            $table->string('nomor_kartu')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bpjs_members');
    }
};
