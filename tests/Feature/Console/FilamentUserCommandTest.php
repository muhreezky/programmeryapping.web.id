<?php

namespace Tests\Feature\Console;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class FilamentUserCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_make_filament_user_creates_a_user_with_a_hashed_password(): void
    {
        $this->artisan('make:filament-user', [
            'name' => 'Test Filament User',
            'email' => 'filament@example.com',
            '--password' => 'secret123',
        ])->assertSuccessful();

        $user = User::where('email', 'filament@example.com')->first();

        $this->assertNotNull($user);

        $this->assertDatabaseHas('users', [
            'email' => 'filament@example.com',
        ]);

        $this->assertTrue(
            password_verify('secret123', $user->password),
            'The user\'s password should be hashed correctly.',
        );

        // The generated user is a valid Filament user: `canAccessPanel` returns true.
        $this->assertTrue($user->canAccessPanel(app('filament.panel')));
    }
}
