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
        Schema::create('uraian_tugas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jabatan_id')->constrained('jabatans');
            $table->string('nama_tugas');
            $table->string('hasil_kerja')->nullable();
            $table->integer('beban_kerja')->nullable();
            $table->integer('waktu_penyelesaian')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uraian_tugas');
    }
};
