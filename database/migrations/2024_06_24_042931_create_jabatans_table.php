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
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreignId('jenis_jabatan_id')->constrained()->nullable();
            $table->foreignId('unit_kerja_id')->constrained()->nullable();
            $table->string('nama');
            $table->string('kode');
            $table->integer('kelas_jabatan')->nullable();
            $table->text('ikhtisar')->nullable();
            $table->text('prestasi')->nullable();
            $table->text('tanggung_jawab')->nullable();
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('jabatans')->onDelete('cascade');
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
