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
        Schema::create('kondisi_lingkungan_kerjas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jabatan_id')->constrained(
                'jabatan_diajukan',
                'id'
            )->cascadeOnDelete();
            $table->string('nama')->nullable();
            $table->enum('getaran', ['rendah', 'sedang', 'tinggi'])->nullable();
            $table->enum('suara', ['senyap', 'bising'])->nullable();
            $table->enum('penerangan', ['redup', 'terang'])->nullable();
            $table->enum('letak', ['dalam ruangan', 'luar ruangan'])->nullable();
            $table->enum('keadaan_ruangan', ['sesak', 'lega'])->nullable();
            $table->enum('udara', ['kering', 'lembab'])->nullable();
            $table->enum('suhu', ['dingin', 'panas'])->nullable();
            $table->string('tempat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kondisi_lingkungan_kerjas');
    }
};
