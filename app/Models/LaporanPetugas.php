<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPetugas extends Model
{
    use HasFactory;
    protected $table = 'laporan_petugas';
    protected $fillable = ['laporan_id', 'petugas_id', 'status_verifikasi', 'kondisi_lapangan'];


    public function laporan() {
        return $this->belongsTo(Laporan::class);
    }

    public function petugas() {
        return $this->belongsTo(Petugas::class);
    }
}
