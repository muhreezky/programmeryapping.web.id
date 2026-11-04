<?php

namespace Tests\Feature\Filament\Resources;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Post;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TempResourceRenderTest extends TestCase
{
    use RefreshDatabase;

    protected function admin(): User
    {
        return User::factory()->create();
    }

    public function test_dashboard_renders(): void
    {
        $this->actingAs($this->admin())
            ->get('/admin')
            ->assertStatus(200);
    }

    public function test_list_pages_render(): void
    {
        $routes = [
            '/admin/posts',
            '/admin/educations',
            '/admin/experiences',
            '/admin/projects',
            '/admin/messages',
        ];

        foreach ($routes as $route) {
            $response = $this->actingAs($this->admin())->get($route);
            $this->assertSame(200, $response->status(), "GET {$route} failed");
        }
    }

    public function test_create_pages_render_form(): void
    {
        $routes = [
            '/admin/posts/create',
            '/admin/educations/create',
            '/admin/experiences/create',
            '/admin/projects/create',
        ];

        foreach ($routes as $route) {
            $response = $this->actingAs($this->admin())->get($route);
            $this->assertSame(200, $response->status(), "GET {$route} failed");
        }
    }

    public function test_edit_pages_render_form(): void
    {
        $records = [
            '/admin/posts/' . Post::factory()->create()->getKey() . '/edit',
            '/admin/educations/' . Education::factory()->create()->getKey() . '/edit',
            '/admin/experiences/' . Experience::factory()->create()->getKey() . '/edit',
            '/admin/projects/' . Project::factory()->create()->getKey() . '/edit',
        ];

        foreach ($records as $route) {
            $response = $this->actingAs($this->admin())->get($route);
            $this->assertSame(200, $response->status(), "GET {$route} failed");
        }
    }

    public function test_message_view_page_renders(): void
    {
        $message = \App\Models\Message::create([
            'sender_email' => 'a@example.com',
            'sender_name' => 'A',
            'subject' => 'S',
            'content' => 'C',
        ]);

        $response = $this->actingAs($this->admin())->get('/admin/messages/' . $message->getKey());

        $this->assertSame(200, $response->status());
    }
}
