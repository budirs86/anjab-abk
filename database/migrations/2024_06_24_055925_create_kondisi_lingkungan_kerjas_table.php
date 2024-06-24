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
            $table->foreignId('jabatan_id')->constrained();
            $table->string('nama');
            $table->enum('getaran', ['rendah', 'sedang', 'tinggi']);
            $table->enum('suara', ['senyap', 'bising']);
            $table->enum('penerangan', ['redup', 'terang']);
            $table->enum('letak', ['dalam ruangan', 'luar ruangan']);
            $table->enum('keadaan_ruangan', ['sesak', 'lega']);
            $table->enum('udara', ['kering', 'lembab']);
            $table->enum('suhu', ['dingin', 'panas']);
            $table->string('tempat');
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
