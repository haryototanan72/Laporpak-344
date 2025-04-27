<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->string('status')->default('diajukan')->change();
        });
    }

    public function down(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->enum('status', [
                'diajukan','diverifikasi','diterima','ditolak','ditindaklanjuti','ditanggapi','selesai'
            ])->default('diajukan')->change();
        });
    }
};
