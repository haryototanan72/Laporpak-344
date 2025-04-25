<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporan';
    protected $primaryKey = 'id_laporan';

    protected $fillable = [
        'lokasi',
        'koordinat_lokasi',
        'deskripsi',
        'bukti_awal',
        'status',
        'foto_video',
        'tanggal_lapor',
        'id_user',
    ];

    public function user()
{
    return $this->belongsTo(User::class, 'id_user', 'id');
}

}

{
    //
}
