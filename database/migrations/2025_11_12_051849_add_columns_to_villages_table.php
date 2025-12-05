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
        Schema::table('villages', function (Blueprint $table) {
        $table->string('desa')->nullable()->after('nama_wilayah');
        $table->string('kecamatan')->nullable()->after('desa');
        $table->string('kabupaten')->nullable()->after('kecamatan');
        $table->string('provinsi')->default('Bali')->after('kabupaten');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('villages', function (Blueprint $table) {
        $table->dropColumn(['desa', 'kecamatan', 'kabupaten', 'provinsi']);
        });
    }
};
