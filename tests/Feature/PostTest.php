<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }

    public function test_guest_cannot_access_posts(): void
    {
        $response = $this->get('/posts');

        $response->assertRedirect('/login');
    }

    public function test_admin_can_view_posts_index(): void
    {
        $admin = $this->createAdminUser();

        $response = $this->actingAs($admin)->get('/posts');

        $response->assertStatus(200);
    }

    public function test_admin_can_create_post(): void
    {
        $admin = $this->createAdminUser();

        $response = $this->actingAs($admin)->post('/posts', [
            'title'   => 'My New Post',
            'content' => 'This is the content of the post.',
            'status'  => 'draft',
        ]);

        $response->assertRedirect('/posts');
        $this->assertDatabaseHas('posts', ['title' => 'My New Post', 'status' => 'draft']);
    }

    public function test_post_title_and_content_are_required(): void
    {
        $admin = $this->createAdminUser();

        $response = $this->actingAs($admin)->post('/posts', [
            'status' => 'draft',
        ]);

        $response->assertSessionHasErrors(['title', 'content']);
    }

    public function test_admin_can_update_post(): void
    {
        $admin = $this->createAdminUser();

        $post = Post::create([
            'title'   => 'Original Title',
            'slug'    => Str::slug('Original Title') . '-test',
            'content' => 'Original content.',
            'status'  => 'draft',
            'user_id' => $admin->id,
        ]);

        $response = $this->actingAs($admin)->put('/posts/' . $post->id, [
            'title'   => 'Updated Title',
            'content' => 'Updated content.',
            'status'  => 'published',
        ]);

        $response->assertRedirect('/posts');
        $this->assertDatabaseHas('posts', ['id' => $post->id, 'title' => 'Updated Title']);
    }

    public function test_admin_can_delete_post(): void
    {
        $admin = $this->createAdminUser();

        $post = Post::create([
            'title'   => 'Post To Delete',
            'slug'    => Str::slug('Post To Delete') . '-test',
            'content' => 'Some content.',
            'status'  => 'draft',
            'user_id' => $admin->id,
        ]);

        $response = $this->actingAs($admin)->delete('/posts/' . $post->id);

        $response->assertRedirect('/posts');
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }

    public function test_admin_can_view_post_show(): void
    {
        $admin = $this->createAdminUser();

        $post = Post::create([
            'title'   => 'Show This Post',
            'slug'    => Str::slug('Show This Post') . '-test',
            'content' => 'Content here.',
            'status'  => 'draft',
            'user_id' => $admin->id,
        ]);

        $response = $this->actingAs($admin)->get('/posts/' . $post->id);

        $response->assertStatus(200);
    }
}
