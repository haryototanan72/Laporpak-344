<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Laporan;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdminLaporanIndexTest extends DuskTestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
    public function admin_can_see_laporan_list()
    {
        // Hapus user admin jika sudah ada untuk menghindari duplicate email
        User::where('email', 'admin@laporpak.com')->delete();
        // Buat user admin
        $admin = User::factory()->create([
            'role' => 'admin',
            'email' => 'admin@laporpak.com',
            'password' => bcrypt('admin123'),
            'email_verified_at' => now(),
        ]);
        // Debug: dump admin user
        dump($admin);
        // Buat data laporan dummy milik admin
        $laporan = Laporan::factory()->create([
            'user_id' => $admin->id,
            'bukti_laporan' => 'dummy.jpg',
            'lokasi' => 'Jakarta',
            'jenis_laporan' => 'Privat',
            'kategori' => 'Jalan Rusak',
            'deskripsi' => 'Deskripsi laporan dummy',
            'nomor_laporan' => 'LAP' . rand(100,999),
            'status' => 'diajukan',
        ]);

        $this->browse(function (Browser $browser) use ($admin, $laporan) {
            $browser->visit('/login')
                ->type('email', $admin->email)
                ->type('password', 'admin123')
                ->press('Masuk')
                ->pause(1500)
                // Cek berhasil login
                ->assertPathIs('/admin/dashboard')
                ->visit('/admin/laporan')
                ->screenshot('admin_laporan_index')
                ->dump()
                ->assertSee('Laporan')
                ->assertSee($laporan->nomor_laporan)
                ->assertSee(ucfirst($laporan->status));
        });
    }
}