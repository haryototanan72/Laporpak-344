<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('laporan_petugas', function (Blueprint $table) {
        $table->string('kondisi_lapangan')->nullable()->after('status_verifikasi');
    });
}

public function down()
{
    Schema::table('laporan_petugas', function (Blueprint $table) {
        $table->dropColumn('kondisi_lapangan');
    });
}

};
