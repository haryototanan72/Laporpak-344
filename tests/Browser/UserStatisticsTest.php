<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;

class UserStatisticsTest extends DuskTestCase
{
    use WithFaker;

    /** @test */
    public function admin_can_see_user_statistics()
    {
        // Bersihkan data user sebelum test
        \App\Models\User::truncate();

        // Buat admin user
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin2@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'aktif',
        ]);

        // Buat dummy user: 2 aktif, 1 tidak aktif
        User::factory()->count(2)->create(['status' => 'aktif']);
        User::factory()->count(1)->create(['status' => 'tidak aktif']);

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                ->visit('/admin/pengguna')
                ->assertSee('Jumlah Pengguna')
                ->assertSee('Aktif')
                ->assertSee('Tidak Aktif')
                ->assertSeeIn('.stat-box:nth-child(1) .stat-value', '4') // total pengguna
                ->assertSeeIn('.stat-box:nth-child(2) .stat-value', '3') // aktif
                ->assertSeeIn('.stat-box:nth-child(3) .stat-value', '1'); // tidak aktif
        });
    }
}
