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
        Schema::create('verifikasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ajuan_id')->constrained();
            $table->unsignedBigInteger('verificator_id')->nullable();
            $table->boolean('is_approved')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
            
            $table->foreign('verificator_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifikasis');
    }
};
