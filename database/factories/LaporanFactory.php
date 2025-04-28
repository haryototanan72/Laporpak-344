<?php

namespace Database\Factories;

use App\Models\Laporan;
use Illuminate\Database\Eloquent\Factories\Factory;

class LaporanFactory extends Factory
{
    protected $model = Laporan::class;

    public function definition()
    {
        return [
            'nomor_laporan' => $this->faker->unique()->numerify('LAP###'),
            'status' => 'diajukan',
            'user_id' => \App\Models\User::factory(), // ini udah bener buat relasi user otomatis
            // tambahkan field lain jika perlu
        ];
    }
}
