<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->enum('status', ['diajukan','diverifikasi','diterima','ditolak','ditindaklanjuti','ditanggapi','selesai'])->default('diajukan')->change();
        });
    }
    public function down()
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->string('status')->change(); // Kembalikan ke string jika rollback
        });
    }
};
