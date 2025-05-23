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
    Schema::create('atk', function (Blueprint $table) {
        $table->id(); // Auto increment ID
        $table->string('nama_barang');
        $table->integer('jumlah');
        $table->string('satuan');
        $table->date('tanggal_masuk');
        $table->text('keterangan')->nullable();
        $table->string('foto_1')->nullable(); // Tambahan kolom foto
        $table->string('foto_2')->nullable();
        $table->string('foto_3')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atk');
    }
};
