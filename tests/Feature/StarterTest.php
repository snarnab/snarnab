<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\PortfolioSeeder;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class StarterTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_pages_and_not_found_page_render(): void
    {
        foreach (['/', '/about', '/contact', '/privacy', '/terms', '/login', '/register', '/forgot-password', '/reset-password/example-token'] as $url) {
            $this->get($url)->assertOk();
        }
        $this->get('/missing-page')->assertNotFound()->assertSee('Your journey');
    }

    public function test_portfolio_displays_profile_details_and_contact_links(): void
    {
        $this->seed(PortfolioSeeder::class);
        $this->assertDatabaseHas('site_settings', ['key' => 'institutional_email']);

        $this->get('/')
            ->assertOk()
            ->assertSee('lang="en"', false)
            ->assertSee('fonts.googleapis.com/css2?family=Manrope', false)
            ->assertSee('family=Playfair+Display', false)
            ->assertSee('aria-label="Sakib Nihal Arnab home"', false)
            ->assertSee('<span class="brand-mark">SNA</span></a>', false)
            ->assertSee('<h1>Sakib Nihal <span>Arnab</span></h1>', false)
            ->assertSee('class="hero-role-marker marker-gold"', false)
            ->assertSee('class="hero-role-marker marker-burgundy"', false)
            ->assertSee('class="hero-role-marker marker-muted"', false)
            ->assertSee('Software Developer')
            ->assertSee('IT Professional')
            ->assertSee('Music Artist')
            ->assertSee('institutional systems, real-world applications and freelance development.')
            ->assertSee('Senior Technical Officer')
            ->assertSee('RUET CSE Inventory System')
            ->assertSee('M.Sc. in Computer Science &amp; Engineering', false)
            ->assertSee('B.Sc. in Computer Science &amp; Engineering', false)
            ->assertSee('Rajshahi Collegiate School &amp; College', false)
            ->assertSee('Rajshahi Govt Laboratory High School')
            ->assertSee('Freelancer.com')
            ->assertDontSee('সাকিব নিহাল আরনাব')
            ->assertSee('sakibnihalarnab@cse.ruet.ac.bd')
            ->assertSee('images/sakib-portrait.jpg', false)
            ->assertSee('https://rcis.ruet.ac.bd/login', false)
            ->assertSee('https://www.youtube.com/@sakibnihalarnab', false)
            ->assertSee('https://github.com/snarnab?tab=repositories', false);

        $this->get('/about')
            ->assertOk()
            ->assertSee('RUET')
            ->assertSee('sakibnihalarnab@gmail.com');

        $this->get('/contact')
            ->assertOk()
            ->assertSee('href="mailto:sakibnihalarnab@gmail.com"', false)
            ->assertSee('href="tel:+8801752309936"', false);
    }

    public function test_public_portfolio_pages_are_english_only(): void
    {
        foreach (['/', '/about', '/contact', '/projects', '/music', '/photography'] as $url) {
            $this->get($url)->assertOk()->assertSee('lang="en"', false)->assertDontSee('portfolio-language');
        }

        $this->postJson('/language', ['language' => 'en'])->assertNotFound();
    }

    public function test_registration_hashes_password_and_sends_verification(): void
    {
        Notification::fake();
        $this->post('/register', ['name' => 'New User', 'email' => 'new@example.com', 'password' => 'Password123', 'password_confirmation' => 'Password123', 'terms' => '1'])->assertRedirect(route('verification.notice'));
        $user = User::where('email', 'new@example.com')->firstOrFail();
        $this->assertAuthenticatedAs($user);
        $this->assertTrue(Hash::check('Password123', $user->password));
        $this->assertNull($user->email_verified_at);
        Notification::assertSentTo($user, VerifyEmail::class);
    }

    public function test_registration_requires_valid_unique_details_and_terms(): void
    {
        $user = User::factory()->create();
        $this->post('/register', ['name' => 'New', 'email' => $user->email, 'password' => 'short', 'password_confirmation' => 'different'])->assertSessionHasErrors(['email', 'password', 'terms']);
        $this->assertGuest();
    }

    public function test_users_can_log_in_and_log_out(): void
    {
        $user = User::factory()->create();
        $this->post('/login', ['email' => $user->email, 'password' => 'password', 'remember' => '1'])->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($user);
        $this->get('/dashboard')->assertOk()->assertSee($user->name);
        $this->post('/logout')->assertRedirect(route('home'));
        $this->assertGuest();
    }

    public function test_invalid_logins_are_throttled(): void
    {
        $user = User::factory()->create();
        for ($attempt = 0; $attempt < 5; $attempt++) {
            $this->post('/login', ['email' => $user->email, 'password' => 'wrong'])->assertSessionHasErrors('email');
        }
        $this->post('/login', ['email' => $user->email, 'password' => 'password'])->assertSessionHasErrors('email');
        $this->assertGuest();
        $this->assertTrue(RateLimiter::tooManyAttempts(strtolower($user->email).'|127.0.0.1', 5));
    }

    public function test_dashboard_requires_verified_login_and_profile_requires_login(): void
    {
        $this->get('/dashboard')->assertRedirect(route('login'));
        $this->get('/profile')->assertRedirect(route('login'));
        $this->actingAs(User::factory()->unverified()->create())->get('/dashboard')->assertRedirect(route('verification.notice'));
        $this->get('/profile')->assertOk();
        $this->get('/verify-email')->assertOk();
    }

    public function test_valid_signed_link_verifies_email(): void
    {
        $user = User::factory()->unverified()->create();
        $link = URL::temporarySignedRoute('verification.verify', now()->addMinutes(30), ['id' => $user->id, 'hash' => sha1($user->email)]);
        $this->actingAs($user)->get($link)->assertRedirect(route('dashboard'));
        $this->assertTrue($user->fresh()->hasVerifiedEmail());
    }

    public function test_unsigned_and_wrong_identity_verification_links_fail(): void
    {
        $user = User::factory()->unverified()->create();
        $this->actingAs($user)->get(route('verification.verify', ['id' => $user->id, 'hash' => sha1($user->email)]))->assertForbidden();
        $link = URL::temporarySignedRoute('verification.verify', now()->addMinutes(30), ['id' => $user->id, 'hash' => sha1('wrong@example.com')]);
        $this->get($link)->assertForbidden();
        $this->assertFalse($user->fresh()->hasVerifiedEmail());
    }

    public function test_verification_email_can_be_resent(): void
    {
        Notification::fake();
        $user = User::factory()->unverified()->create();
        $this->actingAs($user)->post(route('verification.send'))->assertSessionHas('status');
        Notification::assertSentTo($user, VerifyEmail::class);
    }

    public function test_reset_email_is_sent_without_exposing_account_existence(): void
    {
        Notification::fake();
        $user = User::factory()->create();
        $this->post(route('password.email'), ['email' => $user->email])->assertSessionHas('status', 'If an account exists for that email, a password reset link has been sent.');
        Notification::assertSentTo($user, ResetPassword::class);
        $this->post(route('password.email'), ['email' => 'unknown@example.com'])->assertSessionHas('status', 'If an account exists for that email, a password reset link has been sent.');
    }

    public function test_password_reset_requires_a_valid_single_use_token(): void
    {
        $user = User::factory()->create();
        $data = ['email' => $user->email, 'password' => 'NewPassword123', 'password_confirmation' => 'NewPassword123', 'token' => 'invalid'];
        $this->post(route('password.store'), $data)->assertSessionHasErrors('email');
        $data['token'] = Password::createToken($user);
        $this->post(route('password.store'), $data)->assertRedirect(route('login'));
        $this->assertTrue(Hash::check('NewPassword123', $user->fresh()->password));
        $this->post(route('password.store'), $data)->assertSessionHasErrors('email');
    }

    public function test_email_change_requires_reverification(): void
    {
        Notification::fake();
        $user = User::factory()->create();
        $this->actingAs($user)->patch('/profile', ['name' => 'Updated User', 'email' => 'updated@example.com'])->assertSessionHasNoErrors();
        $this->assertDatabaseHas('users', ['id' => $user->id, 'name' => 'Updated User', 'email' => 'updated@example.com', 'email_verified_at' => null]);
        Notification::assertSentTo($user, VerifyEmail::class);
        $this->get('/dashboard')->assertRedirect(route('verification.notice'));
    }

    public function test_name_change_preserves_verification_and_cannot_take_another_email(): void
    {
        $user = User::factory()->create();
        $other = User::factory()->create();
        $this->actingAs($user)->patch('/profile', ['name' => 'Updated', 'email' => $other->email])->assertSessionHasErrors('email');
        $this->patch('/profile', ['name' => 'Updated', 'email' => $user->email])->assertSessionHasNoErrors();
        $this->assertTrue($user->fresh()->hasVerifiedEmail());
    }

    public function test_password_changes_require_current_password(): void
    {
        $user = User::factory()->create();
        $data = ['current_password' => 'wrong', 'password' => 'NewPassword123', 'password_confirmation' => 'NewPassword123'];
        $this->actingAs($user)->put('/password', $data)->assertSessionHasErrors('current_password');
        $data['current_password'] = 'password';
        $this->put('/password', $data)->assertSessionHasNoErrors();
        $this->assertTrue(Hash::check('NewPassword123', $user->fresh()->password));
    }

    public function test_account_deletion_requires_password_and_ends_session(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user)->delete('/profile', ['current_password' => 'wrong'])->assertSessionHasErrors('current_password');
        $this->assertModelExists($user);
        $this->delete('/profile', ['current_password' => 'password'])->assertRedirect(route('home'));
        $this->assertModelMissing($user);
        $this->assertGuest();
    }

    public function test_contact_messages_are_validated_stored_and_rate_limited(): void
    {
        $this->post('/contact', ['email' => 'bad'])->assertSessionHasErrors(['name', 'email', 'subject', 'inquiry_type', 'message']);
        $data = ['name' => 'Visitor', 'email' => 'visitor@example.com', 'subject' => 'Hello', 'inquiry_type' => 'general', 'message' => 'I would like to learn more.'];
        $this->post('/contact', $data)->assertSessionHasNoErrors()->assertSessionHas('status');
        $this->assertDatabaseHas('contact_messages', $data);
        $this->post('/contact', $data)->assertRedirect();
        $this->post('/contact', $data)->assertStatus(429);
    }

    public function test_profile_content_is_escaped(): void
    {
        $user = User::factory()->create(['name' => '<script>alert(1)</script>']);
        $this->actingAs($user)->get('/dashboard')->assertOk()->assertDontSee('<script>alert(1)</script>', false)->assertSee('&lt;script&gt;', false);
    }
}
