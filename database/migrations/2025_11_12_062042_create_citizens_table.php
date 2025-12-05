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
        Schema::create('citizens', function (Blueprint $table) {
            $table->id();
            $table->string('nik',16)->unique();
            $table->string('nama_lengkap');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin',['Laki-Laki','perempuan']);
            $table->text('alamat_lengkap');
            $table->string('status_keluarga');
            $table->string('ayah')->nullable();
            $table->string('ibu')->nullable();
            $table->enum('status_hidup',['Hidup','Meninggal'])->default('Hidup');
            $table->date('tanggal_kematian')->nullable();

            //foreign key
            $table->foreignId('wilayah_id')->constrained('villages')->onDelete('cascade');
            $table->foreignId('agama_id')->constrained('religions')->onDelete('cascade');
            $table->foreignId('pendidikan_id')->constrained('education_levels')->onDelete('cascade');
            $table->foreignId('kepala_keluarga')->constrained('family_heads')->onDelete('cascade');
            $table->foreignId('pekerjaan_id')->constrained('profesions')->onDelete('cascade');
            $table->foreignId('perkawinan_id')->constrained('marital_statuses')->onDelete('cascade');
            $table->foreignId('bantuan_id')->nullable()->constrained('assistance_types')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citizens');
    }
};
