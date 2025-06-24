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
        Schema::create('mebeler_keluars', function (Blueprint $table) {
         $table->id();
        $table->foreignId('mebeler_id')->constrained('mebelers')->onDelete('cascade');
        $table->integer('jumlah_keluar');
        $table->date('tanggal_keluar');
        $table->text('keterangan')->nullable();
        $table->json('foto')->nullable();
        $table->timestamps();
        });
      
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mebeler_keluars');
    }
};
