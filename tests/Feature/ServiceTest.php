<?php

namespace Tests\Feature;

use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }

    public function test_guest_cannot_access_services(): void
    {
        $response = $this->get('/services');

        $response->assertRedirect('/login');
    }

    public function test_admin_can_view_services_index(): void
    {
        $admin = $this->createAdminUser();

        $response = $this->actingAs($admin)->get('/services');

        $response->assertStatus(200);
    }

    public function test_admin_can_create_service(): void
    {
        $admin = $this->createAdminUser();

        $response = $this->actingAs($admin)->post('/services', [
            'code'      => 'SVC001',
            'name'      => 'Prenatal Check',
            'category'  => 'Obstetri',
            'price'     => 150000,
            'is_active' => 1,
        ]);

        $response->assertRedirect('/services');
        $this->assertDatabaseHas('services', ['code' => 'SVC001', 'name' => 'Prenatal Check']);
    }

    public function test_service_code_must_be_unique(): void
    {
        $admin = $this->createAdminUser();

        Service::create([
            'code'      => 'DUPLICATE',
            'name'      => 'Existing Service',
            'category'  => 'Umum',
            'price'     => 50000,
            'is_active' => true,
        ]);

        $response = $this->actingAs($admin)->post('/services', [
            'code'      => 'DUPLICATE',
            'name'      => 'Another Service',
            'category'  => 'Umum',
            'price'     => 75000,
            'is_active' => 1,
        ]);

        $response->assertSessionHasErrors('code');
    }

    public function test_admin_can_update_service(): void
    {
        $admin = $this->createAdminUser();

        $service = Service::create([
            'code'      => 'SVC002',
            'name'      => 'Old Name',
            'category'  => 'Umum',
            'price'     => 100000,
            'is_active' => true,
        ]);

        $response = $this->actingAs($admin)->put('/services/' . $service->id, [
            'code'      => 'SVC002',
            'name'      => 'New Name',
            'category'  => 'Umum',
            'price'     => 120000,
            'is_active' => 1,
        ]);

        $response->assertRedirect('/services');
        $this->assertDatabaseHas('services', ['id' => $service->id, 'name' => 'New Name']);
    }

    public function test_admin_can_delete_service(): void
    {
        $admin = $this->createAdminUser();

        $service = Service::create([
            'code'      => 'SVC003',
            'name'      => 'To Delete',
            'category'  => 'Umum',
            'price'     => 50000,
            'is_active' => true,
        ]);

        $response = $this->actingAs($admin)->delete('/services/' . $service->id);

        $response->assertRedirect('/services');
        $this->assertDatabaseMissing('services', ['id' => $service->id]);
    }
}
