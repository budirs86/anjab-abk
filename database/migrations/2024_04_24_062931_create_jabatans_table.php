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
        Schema::create('jabatans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jabatan');
            $table->foreignId('jenis_jabatan_id');
            $table->foreignId('eselon_id');
            $table->foreignId('golongan_id');
            $table->string('kode');
            $table->string('unit_kerja');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreignId('analisisjabatan_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatans');
    }
};
