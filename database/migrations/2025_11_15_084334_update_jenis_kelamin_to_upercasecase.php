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
        Schema::table('citizens', function (Blueprint $table) {
           $table->enum('jenis_kelamin',['Laki-Laki','Perempuan'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('citizens', function (Blueprint $table) {
           $table->enum('jenis_kelamin', ['Laki-Laki', 'perempuan'])->change();
        });
    }
};
