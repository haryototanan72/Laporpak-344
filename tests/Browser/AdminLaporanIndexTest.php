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
            'password' => bcrypt('admin123')
        ]);
        // Buat data laporan dummy milik admin
        $laporan = Laporan::factory()->create([
            'user_id' => $admin->id,
        ]);

        $this->browse(function (Browser $browser) use ($admin, $laporan) {
            $browser->loginAs($admin)
                ->visit('/admin/laporan')
                ->assertSee('Laporan')
                ->assertSee($laporan->nomor_laporan)
                ->assertSee($laporan->status);
        });
    }
}