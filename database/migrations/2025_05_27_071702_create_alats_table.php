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
        Schema::create('alats', function (Blueprint $table) {
             $table->id();
            $table->string('nama_alat');
            $table->integer('jumlah_alat');
            $table->string('satuan_alat');
            $table->date('tanggal_masuk_alat');
            $table->json('foto')->nullable();
            $table->text('keterangan_alat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alats');
    }
};
