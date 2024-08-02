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
    Schema::create('jabatan_diajukan', function (Blueprint $table) {
      $table->id();
      $table->foreignId('jabatan_id')->constrained('jabatan')->cascadeOnDelete();
      $table->foreignId('ajuan_id')->constrained('ajuan')->cascadeOnDelete();
      $table->foreignId('jenis_jabatan_id')->nullable()->constrained('jenis_jabatan')->cascadeOnDelete();
      $table->unsignedBigInteger('parent_id');
      $table->string('nama');
      $table->string('kode');
      $table->text('ikhtisar');
      $table->text('prestasi');
      $table->enum('jenis_kelamin', ['L', 'P']);
      $table->integer('umur');
      $table->integer('tinggi_badan');
      $table->string('postur_badan');
      $table->string('penampilan');
      $table->string('keterampilan');
      $table->integer('berat_badan');
      $table->string('getaran');
      $table->string('suhu');
      $table->string('suara');
      $table->string('penerangan');
      $table->string('letak');
      $table->string('tempat');
      $table->string('udara');
      $table->string('keadaan_ruangan');
      $table->timestamps();

      $table->foreign('parent_id')->references('id')->on('jabatan_diajukan')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('jabatan_diajukan');
  }
};
