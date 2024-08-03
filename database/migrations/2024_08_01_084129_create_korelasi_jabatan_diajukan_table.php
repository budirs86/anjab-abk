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
    Schema::create('korelasi_jabatan_diajukan', function (Blueprint $table) {
      $table->id();
      $table->foreignId('jabatan_diajukan_id')->constrained('jabatan_diajukan')->cascadeOnDelete();
      $table->unsignedBigInteger('jabatan_relasi_id');
      $table->string('dalam_hal');
      $table->timestamps();

      $table->foreign('jabatan_relasi_id')->references('id')->on('jabatan_diajukan')->cascadeOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('korelasi_jabatan_diajukan');
  }
};
