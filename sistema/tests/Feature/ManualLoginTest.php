<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManualLoginTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
        $this->user = User::where('email', 'admin@sanjuan.com')->firstOrFail();
    }

    public function test_login_page_shows_the_prototype_design(): void
    {
        $this->get(route('login'))
            ->assertOk()
            ->assertSee('Gestiona tu farmacia de forma simple y segura.')
            ->assertSee('name="email"', false)
            ->assertSee('name="remember"', false);
    }

    public function test_valid_credentials_authenticate_and_redirect_to_dashboard(): void
    {
        $this->post(route('login'), [
            'email' => 'admin@sanjuan.com',
            'password' => 'password',
            'remember' => '1',
        ])->assertRedirect(route('dashboard.index'));

        $this->assertAuthenticatedAs($this->user);
        $this->assertNotNull($this->user->fresh()->getRememberToken());
    }

    public function test_login_requires_a_valid_email_and_password(): void
    {
        $this->post(route('login'), [
            'email' => 'no-es-un-correo',
        ])->assertSessionHasErrors(['email', 'password']);
    }

    public function test_invalid_credentials_return_to_login_with_only_email_old_input(): void
    {
        $this->from(route('login'))->post(route('login'), [
            'email' => 'admin@sanjuan.com',
            'password' => 'incorrecta',
            'remember' => '1',
        ])
            ->assertRedirect(route('login'))
            ->assertSessionHasErrors([
                'email' => 'El correo o la contraseña no son correctos.',
            ])
            ->assertSessionHas('_old_input', ['email' => 'admin@sanjuan.com']);
    }

    public function test_logout_ends_the_session_and_redirects_with_confirmation(): void
    {
        $this->actingAs($this->user)
            ->withSession(['logout_marker' => 'active'])
            ->post(route('logout'))
            ->assertRedirect(route('login'))
            ->assertSessionMissing('logout_marker')
            ->assertSessionHas('ok', 'Cerraste sesión correctamente.');

        $this->assertGuest();
    }
}
