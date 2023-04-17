<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    // Initiate the test
    public User $regularUser;

    public User $adminUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->regularUser = User::factory()->create([
            'is_admin' => false,
        ]);

        $this->adminUser = User::factory()->create([
            'is_admin' => true,
        ]);
    }

    // Regular user can't access users pages
    public function test_regular_user_cannot_access_users_pages()
    {
        $this->actingAs($this->regularUser);

        $response = $this->get(route('admin.users'));

        $response->assertStatus(403);
    }

    // Admin user can access users pages
    public function test_admin_user_can_access_users_pages()
    {
        $this->actingAs($this->adminUser);

        $response = $this->get(route('admin.users'));

        $response->assertOk();
    }
}
