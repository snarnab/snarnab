<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\Education;
use App\Models\Project;
use App\Models\Technology;
use App\Models\User;
use Database\Seeders\PortfolioSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortfolioAdminTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(PortfolioSeeder::class);
    }

    public function test_portfolio_content_is_rendered_from_database(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('lang="en"', false)
            ->assertSee('Sakib Nihal Arnab')
            ->assertSee('RUET CSE Inventory System')
            ->assertSee('M.Sc. in Computer Science &amp; Engineering', false)
            ->assertSee('University of Rajshahi');

        $this->get('/projects/ruet-cse-inventory-system')
            ->assertOk()
            ->assertSee('Laravel')
            ->assertSee('https://rcis.ruet.ac.bd/login', false);

        $this->get('/sitemap.xml')
            ->assertOk()
            ->assertSee('/projects/ruet-cse-inventory-system');
    }

    public function test_only_verified_administrators_can_access_admin_pages(): void
    {
        $this->get('/admin')->assertRedirect(route('login'));

        $unverifiedAdmin = User::factory()->unverified()->create();
        $unverifiedAdmin->forceFill(['is_admin' => true])->save();
        $this->actingAs($unverifiedAdmin)->get('/admin')->assertRedirect(route('verification.notice'));

        $ordinaryUser = User::factory()->create();
        $this->actingAs($ordinaryUser)->get('/admin')->assertForbidden();

        $administrator = User::factory()->create();
        $administrator->forceFill(['is_admin' => true])->save();
        $this->actingAs($administrator)->get('/admin')->assertOk()->assertSee('Portfolio overview');
    }

    public function test_administrator_content_pages_and_forms_render(): void
    {
        $administrator = User::factory()->create();
        $administrator->forceFill(['is_admin' => true])->save();
        $this->actingAs($administrator);

        $this->get('/admin/profile')->assertOk()->assertSee('Profile & contact')->assertDontSee('(Bangla)', false);

        foreach (array_keys(config('portfolio.resources')) as $resource) {
            $this->get(route('admin.resources.index', $resource))->assertOk();
            $this->get(route('admin.resources.create', $resource))->assertOk();
        }
    }

    public function test_registration_cannot_grant_administrator_privileges(): void
    {
        $this->post('/register', [
            'name' => 'New User',
            'email' => 'ordinary@example.com',
            'password' => 'Password123',
            'password_confirmation' => 'Password123',
            'terms' => '1',
            'is_admin' => '1',
        ])->assertRedirect(route('verification.notice'));

        $this->assertFalse(User::query()->where('email', 'ordinary@example.com')->firstOrFail()->is_admin);
    }

    public function test_admin_can_create_publish_and_edit_a_project(): void
    {
        $administrator = User::factory()->create();
        $administrator->forceFill(['is_admin' => true])->save();
        $technology = Technology::query()->where('name', 'Laravel')->firstOrFail();

        $this->actingAs($administrator)->post('/admin/projects', [
            'slug' => 'department-portal',
            'title_en' => 'Department portal',
            'category' => 'web',
            'summary_en' => 'A portal for a verified department use case.',
            'status' => 'active',
            'is_published' => '1',
            'technology_ids' => [$technology->id],
            'sort_order' => '2',
        ])->assertRedirect(route('admin.resources.index', 'projects'));

        $project = Project::query()->where('slug', 'department-portal')->firstOrFail();
        $this->assertTrue($project->is_published);
        $this->assertTrue($project->technologies->contains($technology));
        $this->assertSame('Department portal', $project->title_bn);
        $this->get('/projects/department-portal')->assertOk()->assertSee('Department portal')->assertDontSee('বিভাগীয় পোর্টাল');

        $this->actingAs($administrator)->put('/admin/projects/'.$project->id, [
            'slug' => 'department-portal',
            'title_en' => 'Updated portal',
            'category' => 'web',
            'summary_en' => 'Updated description for the portal.',
            'status' => 'active',
            'sort_order' => '2',
        ])->assertRedirect(route('admin.resources.index', 'projects'));

        $this->assertSame('Updated portal', $project->fresh()->title_en);
        $this->assertFalse($project->fresh()->is_published);
    }

    public function test_public_pages_never_show_unpublished_projects(): void
    {
        $project = Project::query()->firstOrFail();
        $project->update(['is_published' => false]);

        $this->get('/projects')->assertOk()->assertDontSee($project->title_en);
        $this->get('/projects/'.$project->slug)->assertNotFound();
    }

    public function test_admin_can_update_profile_and_contact_information(): void
    {
        $administrator = User::factory()->create();
        $administrator->forceFill(['is_admin' => true])->save();

        $this->actingAs($administrator)->put('/admin/profile', [
            'name' => 'Sakib Nihal Arnab',
            'title_en' => 'Senior Technical Officer · CSE, RUET',
            'creative_title_en' => 'Web Developer & IT Professional',
            'intro_en' => 'Introduction in English.',
            'about_en' => 'About me.',
            'location' => 'Rajshahi, Bangladesh',
            'settings' => ['contact_email' => ['en' => 'updated@example.com']],
        ])->assertRedirect(route('admin.profile.edit'));

        $this->get('/contact')->assertOk()->assertSee('updated@example.com');
        $this->actingAs($administrator)->get('/admin/profile')->assertOk()->assertDontSee('(Bangla)', false);
    }

    public function test_contact_messages_are_stored_and_visible_only_to_administrators(): void
    {
        $message = ContactMessage::query()->create([
            'name' => 'Visitor',
            'email' => 'visitor@example.com',
            'subject' => 'A project inquiry',
            'inquiry_type' => 'professional',
            'message' => 'I would like to discuss a project with you.',
        ]);

        $this->get('/admin/messages')->assertRedirect(route('login'));
        $administrator = User::factory()->create();
        $administrator->forceFill(['is_admin' => true])->save();

        $this->actingAs($administrator)->get('/admin/messages/'.$message->id)->assertOk()->assertSee('A project inquiry');
        $this->assertNotNull($message->fresh()->read_at);
        $this->actingAs($administrator)->delete('/admin/messages/'.$message->id)->assertRedirect('/admin/messages');
        $this->assertModelMissing($message);
    }

    public function test_portfolio_admin_command_only_grants_verified_existing_accounts(): void
    {
        $user = User::factory()->unverified()->create();
        $this->artisan('portfolio:admin', ['action' => 'grant', 'email' => $user->email])->assertFailed();
        $this->assertFalse($user->fresh()->is_admin);

        $user->markEmailAsVerified();
        $this->artisan('portfolio:admin', ['action' => 'grant', 'email' => $user->email])->assertSuccessful();
        $this->assertTrue($user->fresh()->is_admin);

        $this->artisan('portfolio:admin', ['action' => 'revoke', 'email' => $user->email])->assertSuccessful();
        $this->assertFalse($user->fresh()->is_admin);
    }

    public function test_admin_validation_rejects_invalid_project_urls_and_relationships(): void
    {
        $administrator = User::factory()->create();
        $administrator->forceFill(['is_admin' => true])->save();

        $this->actingAs($administrator)->post('/admin/projects', [
            'slug' => 'ruet-cse-inventory-system',
            'title_en' => 'Duplicate slug',
            'category' => 'web',
            'summary_en' => 'A sufficiently long description.',
            'status' => 'active',
            'live_url' => 'javascript:alert(1)',
            'technology_ids' => [99999],
            'sort_order' => '1',
        ])->assertSessionHasErrors(['slug', 'live_url', 'technology_ids.0']);

        $this->assertDatabaseMissing('projects', ['title_en' => 'Duplicate slug']);
    }

    public function test_education_seed_contains_confirmed_degrees_and_school_records(): void
    {
        $this->seed(PortfolioSeeder::class);

        $this->assertSame(4, Education::query()->count());
        $this->assertDatabaseHas('educations', [
            'degree_en' => 'M.Sc. in Computer Science & Engineering',
            'institution_en' => 'University of Rajshahi',
            'graduated_year' => 2025,
        ]);
        $this->assertDatabaseHas('educations', [
            'degree_en' => 'HSC',
            'institution_en' => 'Rajshahi Collegiate School & College',
            'graduated_year' => 2014,
        ]);
        $this->assertDatabaseHas('educations', [
            'degree_en' => 'SSC',
            'institution_en' => 'Rajshahi Govt Laboratory High School',
            'graduated_year' => 2012,
        ]);
        $this->assertDatabaseMissing('educations', ['degree_en' => 'Master of Business Administration']);
    }
}
