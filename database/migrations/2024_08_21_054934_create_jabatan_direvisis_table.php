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
        Schema::create('jabatan_direvisi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('verifikasi_id')->nullable()->constrained('verifikasi');
            $table->foreignId('jabatan_diajukan_id')->constrained('jabatan_diajukan');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatan_direvisis');
    }
};
