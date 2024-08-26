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
        Schema::create('jabatan_tugas_tambahan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreignId('jenis_jabatan_id')->constrained('jenis_jabatan')->onDelete('cascade');
            $table->string('nama');
            $table->string('kode');
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('jabatan_tugas_tambahan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatan_tugas_tambahans');
    }
};
