<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Pastikan data status sudah sesuai enum baru (jika belum, update manual dulu)
        // Ubah enum status di laporans agar sama dengan complaints
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE laporans MODIFY status ENUM('diajukan','diverifikasi','diterima','ditolak','ditindaklanjuti','ditanggapi','selesai') NOT NULL DEFAULT 'diajukan'");
        }
    }

    public function down(): void
    {
        // Rollback ke enum lama jika diperlukan
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE laporans MODIFY status ENUM('Menunggu','Diproses','Selesai') NOT NULL DEFAULT 'Menunggu'");
        }
    }
};
