<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }

    public function test_guest_cannot_access_categories(): void
    {
        $response = $this->get('/categories');

        $response->assertRedirect('/login');
    }

    public function test_admin_can_view_categories_index(): void
    {
        $admin = $this->createAdminUser();

        $response = $this->actingAs($admin)->get('/categories');

        $response->assertStatus(200);
    }

    public function test_admin_can_create_category(): void
    {
        $admin = $this->createAdminUser();

        $response = $this->actingAs($admin)->post('/categories', [
            'name'        => 'Test Category',
            'description' => 'A test category description.',
        ]);

        $response->assertRedirect('/categories');
        $this->assertDatabaseHas('categories', ['name' => 'Test Category']);
    }

    public function test_category_name_is_required(): void
    {
        $admin = $this->createAdminUser();

        $response = $this->actingAs($admin)->post('/categories', [
            'description' => 'No name provided.',
        ]);

        $response->assertSessionHasErrors('name');
    }

    public function test_admin_can_update_category(): void
    {
        $admin = $this->createAdminUser();

        $category = Category::create([
            'name' => 'Original Name',
            'slug' => Str::slug('Original Name') . '-test',
        ]);

        $response = $this->actingAs($admin)->put('/categories/' . $category->id, [
            'name'        => 'Updated Name',
            'description' => 'Updated description.',
        ]);

        $response->assertRedirect('/categories');
        $this->assertDatabaseHas('categories', ['name' => 'Updated Name']);
    }

    public function test_admin_can_delete_category(): void
    {
        $admin = $this->createAdminUser();

        $category = Category::create([
            'name' => 'To Be Deleted',
            'slug' => Str::slug('To Be Deleted') . '-test',
        ]);

        $response = $this->actingAs($admin)->delete('/categories/' . $category->id);

        $response->assertRedirect('/categories');
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
