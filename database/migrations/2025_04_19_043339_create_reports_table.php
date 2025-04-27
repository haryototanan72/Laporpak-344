<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('reports', function (Blueprint $table) {
        $table->id();
        $table->string('nomor_laporan')->unique();
        $table->string('judul');
        $table->text('deskripsi')->nullable();
        $table->enum('status', ['Diajukan', 'Diproses', 'Diterima', 'Ditolak', 'Ditindaklanjuti', 'Ditanggapi', 'Selesai'])->default('Diajukan');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
