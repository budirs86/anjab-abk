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
        Schema::create('abk_anjab', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anjab_id')->constrained('ajuan')->cascadeOnDelete();
            $table->foreignId('abk_id')->constrained('ajuan')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abk_anjab');
    }
};
