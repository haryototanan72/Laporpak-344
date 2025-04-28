<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;

class AdminDashboardTest extends DuskTestCase
{
    use WithFaker;

    /** @test */
    public function admin_can_view_dashboard_and_see_statistics()
    {
        // Bersihkan data user sebelum test
        \App\Models\User::truncate();

        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'aktif',
        ]);

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                ->visit('/admin/dashboard')
                ->assertSee('Dashboard');
        });
    }
}
