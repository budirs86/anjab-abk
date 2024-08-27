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
        Schema::create('abk_unit_kerja', function (Blueprint $table) {
            $table->id();
            $table->foreignId('abk_id')->constrained('ajuan');
            $table->foreignId('unit_kerja_id')->constrained('unit_kerja');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abk_unit_kerjas');
    }
};
