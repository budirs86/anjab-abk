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
            $table->string('getaran')->nullable();
            $table->string('suara')->nullable();
            $table->string('penerangan')->nullable();
            $table->string('letak')->nullable();
            $table->string('keadaan_ruangan')->nullable();
            $table->string('udara')->nullable();
            $table->string('suhu')->nullable();
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
