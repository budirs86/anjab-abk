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
    Schema::create('risiko_bahaya', function (Blueprint $table) {
      $table->id();
      $table->foreignId('jabatan_id')->constrained('jabatan')->cascadeOnDelete();
      $table->string('bahaya_fisik');
      $table->string('penyebab');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('risiko_bahaya');
  }
};
