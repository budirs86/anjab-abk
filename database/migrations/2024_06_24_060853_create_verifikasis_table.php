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
            $table->enum('status', ['menunggu diperiksa', 'sedang diperiksa', 'diterima', 'perlu diperbaiki']);
            $table->unsignedBigInteger('previous_verificator_id')->nullable();
            $table->unsignedBigInteger('verificator_id')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
            
            $table->foreign('previous_verificator_id')->references('id')->on('users');
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
