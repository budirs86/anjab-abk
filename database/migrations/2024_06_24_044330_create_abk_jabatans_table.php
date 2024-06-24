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
        Schema::create('abk_jabatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jabatan_id')->constrained();
            $table->foreignId('ajuan_id')->constrained();
            $table->integer('total_beban_kerja');
            $table->integer('kebutuhan_pegawai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abk_jabatans');
    }
};
