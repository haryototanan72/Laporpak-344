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
            'user_id' => \App\Models\User::factory(),
            'bukti_laporan' => 'dummy.jpg',
            'lokasi' => $this->faker->city(),
            'jenis_laporan' => $this->faker->randomElement(['Privat', 'Publik']),
            'kategori' => $this->faker->randomElement(['Jalan Rusak', 'Jembatan Rusak', 'Banjir']),
            'deskripsi' => $this->faker->sentence(10),
        ];
    }
}
