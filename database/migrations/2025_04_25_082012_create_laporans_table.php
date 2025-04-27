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
    Schema::create('laporans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->enum('jenis_laporan', ['Privat', 'Publik']);
        $table->string('bukti_laporan');
        $table->string('lokasi');
        $table->string('ciri_khusus')->nullable();
        $table->enum('kategori', ['Jalan Rusak', 'Jembatan Rusak', 'Banjir']);
        $table->text('deskripsi');
        $table->string('nomor_laporan')->unique();
        $table->enum('status', ['Menunggu', 'Diproses', 'Selesai'])->default('Menunggu');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
