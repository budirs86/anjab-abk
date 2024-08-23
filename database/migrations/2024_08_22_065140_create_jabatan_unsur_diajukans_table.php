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
        Schema::create('jabatan_unsur_diajukans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jabatan_diajukan_id')->constrained('jabatan_diajukan');
            $table->foreignId('unsur_id')->constrained('unsur');
            $table->foreignId('ajuan_id')->nullable()   ->constrained('ajuan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatan_unsur_diajukans');
    }
};
