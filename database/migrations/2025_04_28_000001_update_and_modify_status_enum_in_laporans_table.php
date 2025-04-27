<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Step 1: Update data status lama ke status baru
        DB::table('laporans')->where('status', 'Menunggu')->update(['status' => 'diajukan']);
        DB::table('laporans')->where('status', 'Diproses')->update(['status' => 'ditindaklanjuti']);
        DB::table('laporans')->where('status', 'Selesai')->update(['status' => 'selesai']);

        // Step 2: Ubah enum status lama ke enum status baru
        DB::statement("ALTER TABLE laporans MODIFY status ENUM('diajukan','diverifikasi','diterima','ditolak','ditindaklanjuti','ditanggapi','selesai') NOT NULL DEFAULT 'diajukan'");
    }

    public function down(): void
    {
        // Rollback: kembalikan enum ke status lama
        DB::statement("ALTER TABLE laporans MODIFY status ENUM('Menunggu', 'Diproses', 'Selesai') NOT NULL DEFAULT 'Menunggu'");
    }
};
