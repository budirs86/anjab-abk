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
    Schema::create('syarat_jabatans', function (Blueprint $table) {
      $table->id();
      $table->foreignId('jabatan_id')->constrained(
        'jabatan_diajukan',
        'id'
      )->cascadeOnDelete();
      $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
      $table->integer('umur')->nullable();
      $table->integer('tinggi_badan')->nullable();
      $table->integer('berat_badan')->nullable();
      $table->string('postur_badan')->nullable();
      $table->string('penampilan')->nullable();
      $table->string('keterampilan')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('syarat_jabatans');
  }
};
