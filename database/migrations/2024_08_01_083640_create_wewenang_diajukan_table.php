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
    Schema::create('wewenang_diajukan', function (Blueprint $table) {
      $table->id();
      $table->foreignId('jabatan_id')->constrained(
        'jabatan_diajukan',
        'id'
      )->cascadeOnDelete();
      $table->string('nama');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('wewenang_diajukan');
  }
};
