<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'laporans'; // Mengubah ke nama tabel yang benar

    protected $fillable = [
        'nomor_laporan',
        'status',
        'deskripsi',
        'foto',
        'created_at',
        'updated_at'
    ];

    // Jika ingin menambahkan relasi dengan user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
