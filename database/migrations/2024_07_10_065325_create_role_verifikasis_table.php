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
        Schema::create('role_verifikasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ajuan_id')->constrained();
            $table->foreignId('role_id')->constrained();
            $table->boolean('is_approved')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_verifikasis');
    }
};
