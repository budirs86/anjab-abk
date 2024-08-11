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
        Schema::create('detail_abk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ajuan_id')->constrained('ajuan');
            $table->foreignId('unit_kerja_id')->constrained('unit_kerja');
            $table->foreignId('jabatan_diajukan_id')->constrained('jabatan_diajukan');
            $table->foreignId('uraian_tugas_diajukan_id')->nullable()->constrained('uraian_tugas_diajukan');
            $table->integer('waktu_penyelesaian')->nullable();
            $table->integer('hasil_kerja')->nullable();
            $table->integer('jumlah_hasil_kerja')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_abk');
    }
};
