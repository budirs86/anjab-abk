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
            $table->foreignId('jenis_jabatan_id')->constrained();
            $table->foreignId('ajuan_id')->constrained();
            $table->foreignId('unit_kerja_id')->constrained();
            $table->foreignId('eselon_id')->constrained();
            $table->foreignId('golongan_id')->constrained();
            $table->string('nama');
            $table->string('kode');
            $table->integer('kelas_jabatan');
            $table->text('ikhtisar');
            $table->text('prestasi');
            $table->text('tanggung_jawab');
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
