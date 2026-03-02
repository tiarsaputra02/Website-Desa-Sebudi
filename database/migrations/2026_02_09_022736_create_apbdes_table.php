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
        Schema::create('apbdes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tahun_id')
                  ->constrained('tahun_anggaran')
                  ->cascadeOnDelete();

            $table->decimal('total_pendapatan', 15, 2)->default(0);
            $table->decimal('total_belanja', 15, 2)->default(0);
            $table->decimal('surplus_defisit', 15, 2)->default(0);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apbdes');
    }
};
