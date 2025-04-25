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
        Schema::create('laporan', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->string('lokasi');
            $table->text('deskripsi');
            $table->text('bukti');
            $table->string('fotoVideo')->nullable();
            $table->enum('status', ['proses', 'ditolak', 'diteruskan', 'diterima', 'selesai']);
            $table->text('catatan_proses')->nullable();
            $table->date('tanggal_lapor');
            $table->unsignedBigInteger('id_user'); // foreign key
        
            // Foreign key ke tabel users bawaan Laravel
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        
            $table->timestamps();
        });
        
    }
    
};
