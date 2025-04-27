<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory;
    protected $table = 'reports';

    protected $fillable = [
        'user_id',
        'nomor_laporan',
        'judul',
        'deskripsi',
        'lokasi',
        'tanggal_kejadian',
        'foto',
        'status',
    ];

    protected $casts = [
        'tanggal_kejadian' => 'date',
        'foto' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function findByNomorLaporan(string $nomor): ?self
    {
        return self::where('nomor_laporan', $nomor)->first();
    }

    public function getStatusBadgeClassAttribute(): string
    {
        $map = [
            'Diajukan' => 'bg-gray-100 text-gray-800',
            'Diproses' => 'bg-yellow-100 text-yellow-800',
            'Diterima' => 'bg-green-100 text-green-800',
            'Ditolak' => 'bg-red-100 text-red-800',
            'Ditindaklanjuti' => 'bg-yellow-100 text-yellow-800',
            'Ditanggapi' => 'bg-yellow-100 text-yellow-800',
            'Selesai' => 'bg-green-100 text-green-800',
        ];
        return $map[$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    public function getStatusLabelAttribute(): string
    {
        $map = [
            'Diajukan' => 'Diajukan',
            'Diproses' => 'Proses Verifikasi',
            'Diterima' => 'Laporan Anda Disetujui',
            'Ditindaklanjuti' => 'Proses Tindak lanjut',
            'Ditanggapi' => 'Beri Tanggapan',
            'Selesai' => 'Selesai',
            'Ditolak' => 'Laporan Ditolak',
        ];
        return $map[$this->status] ?? $this->status;
    }

    public function getStatusDeskripsiAttribute(): string
    {
        $map = [
            'Diajukan' => 'Laporan Diajukan',
            'Diproses' => 'Proses Verifikasi',
            'Diterima' => 'Laporan Disetujui',
            'Ditolak' => 'Laporan Ditolak',
            'Ditindaklanjuti' => 'Proses Tindak Lanjut',
            'Ditanggapi' => 'Beri Tanggapan',
            'Selesai' => 'Selesai',
        ];
        return $map[$this->status] ?? 'Tidak Diketahui';
    }
}