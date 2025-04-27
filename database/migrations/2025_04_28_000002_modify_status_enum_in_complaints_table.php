<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah kolom status di complaints menjadi enum pilihan status yang diinginkan
        DB::statement("ALTER TABLE complaints MODIFY status ENUM('diajukan','diverifikasi','diterima','ditolak','ditindaklanjuti','ditanggapi','selesai') NOT NULL DEFAULT 'diajukan'");
    }

    public function down(): void
    {
        // Rollback ke string (atau enum sebelumnya jika ingin)
        DB::statement("ALTER TABLE complaints MODIFY status VARCHAR(255)");
    }
};
