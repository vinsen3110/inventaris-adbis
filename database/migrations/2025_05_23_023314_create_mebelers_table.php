<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     public function up()
    {
        Schema::create('mebelers', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mebeler');
            $table->integer('jumlah_mebeler');
            $table->string('satuan_mebeler');
            $table->date('tanggal_masuk_mebeler');
            $table->text('keterangan_mebeler')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mebelers');
    }
};
