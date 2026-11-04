<?php

namespace Tests\Feature\Filament\Resources;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Message;
use App\Models\Post;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResourcePagesTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create();
        $this->actingAs($this->admin);
    }

    public function test_dashboard_renders(): void
    {
        $this->get('/admin')->assertStatus(200);
    }

    public function test_list_pages_render_with_records_and_row_actions(): void
    {
        Post::create([
            'title' => 'Zebra List Post',
            'content' => 'Body',
            'headline_image' => 'images/t.png',
            'author_id' => $this->admin->getKey(),
        ]);
        Education::factory()->create(['institution' => 'Zebra University']);
        Experience::factory()->create(['title' => 'Zebra Role', 'company' => 'Zebra Corp']);
        Project::factory()->create(['title' => 'Zebra Project']);
        Message::create([
            'sender_email' => 'z@example.com',
            'sender_name' => 'Zed',
            'subject' => 'Zebra Subject',
            'content' => 'C',
        ]);

        $routes = [
            '/admin/posts' => 'Zebra List Post',
            '/admin/education' => 'Zebra University',
            '/admin/experiences' => 'Zebra Role',
            '/admin/projects' => 'Zebra Project',
            '/admin/messages' => 'Zebra Subject',
        ];

        foreach ($routes as $route => $text) {
            $response = $this->get($route);
            $this->assertSame(200, $response->status(), "GET {$route} failed");
            $response->assertSee($text);
        }
    }

    public function test_create_pages_render_form_fields(): void
    {
        $routes = [
            '/admin/posts/create' => 'Judul',
            '/admin/education/create' => 'Institusi',
            '/admin/experiences/create' => 'Jabatan',
            '/admin/projects/create' => 'Nama Proyek',
        ];

        foreach ($routes as $route => $label) {
            $response = $this->get($route);
            $this->assertSame(200, $response->status(), "GET {$route} failed");
            $response->assertSee($label);
        }
    }

    public function test_edit_pages_render_form_fields(): void
    {
        $post = Post::create([
            'title' => 'Edit Me',
            'content' => 'Body',
            'headline_image' => 'images/t.png',
            'author_id' => $this->admin->getKey(),
        ]);

        $routes = [
            '/admin/posts/' . $post->getKey() . '/edit' => 'Judul',
            '/admin/education/' . Education::factory()->create()->getKey() . '/edit' => 'Institusi',
            '/admin/experiences/' . Experience::factory()->create()->getKey() . '/edit' => 'Jabatan',
            '/admin/projects/' . Project::factory()->create()->getKey() . '/edit' => 'Nama Proyek',
        ];

        foreach ($routes as $route => $label) {
            $response = $this->get($route);
            $this->assertSame(200, $response->status(), "GET {$route} failed");
            $response->assertSee($label);
        }
    }

    public function test_message_view_page_renders(): void
    {
        $message = Message::create([
            'sender_email' => 'a@example.com',
            'sender_name' => 'A',
            'subject' => 'S',
            'content' => 'C',
        ]);

        $this->get('/admin/messages/' . $message->getKey())->assertStatus(200);
    }

    public function test_message_creation_is_denied(): void
    {
        $this->get('/admin/messages/create')->assertStatus(403);
    }
}
