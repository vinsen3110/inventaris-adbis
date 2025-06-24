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
    Schema::create('atk_keluar', function (Blueprint $table) {
        $table->id();
        $table->foreignId('atk_id')->constrained('atk')->onDelete('cascade');
        $table->integer('jumlah_keluar_alat');
        $table->date('tanggal_keluar_alat');
        $table->text('keterangan_alat')->nullable();
        $table->json('foto')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atk_keluar');
    }
};
