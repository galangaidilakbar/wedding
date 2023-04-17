<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
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

        Category::factory()->create();
    }

    // Regular user can't access category pages
    public function test_regular_user_cannot_access_category_pages()
    {
        $this->actingAs($this->regularUser);

        $response = $this->get(route('admin.categories.index'));

        $response->assertStatus(403);
    }

    // Regular user cannot create a category
    public function test_regular_user_cannot_create_a_category()
    {
        $this->actingAs($this->regularUser);

        $response = $this->post(route('admin.categories.store'), [
            'name' => 'Test Category',
        ]);

        $response->assertForbidden();
    }

    // Regular user cannot access form edit category
    public function test_regular_user_cannot_access_form_edit_category()
    {
        $this->actingAs($this->regularUser);

        $category = Category::first();

        $response = $this->get(route('admin.categories.edit', $category->id));

        $response->assertForbidden();
    }

    // Regular user cannot edit a category
    public function test_regular_user_cannot_edit_a_category()
    {
        $this->actingAs($this->regularUser);

        $category = Category::first();

        $response = $this->put(route('admin.categories.update', $category->id), [
            'name' => 'Test Category',
        ]);

        $response->assertForbidden();
    }

    // Regular user cannot delete a category
    public function test_regular_user_cannot_delete_a_category()
    {
        $this->actingAs($this->regularUser);

        $category = Category::first();

        $response = $this->delete(route('admin.categories.destroy', $category->id));

        $response->assertForbidden();
    }

    // Admin user can access category pages
    public function test_admin_user_can_access_category_pages()
    {
        $this->actingAs($this->adminUser);

        $response = $this->get(route('admin.categories.index'));

        $response->assertOk();
    }

    // Admin user can create a category
    public function test_admin_user_can_create_a_category()
    {
        $this->actingAs($this->adminUser);

        $response = $this->post(route('admin.categories.store'), [
            'name' => 'Test Category',
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('categories', [
            'name' => 'Test Category',
        ]);
    }

    // Admin user can access form edit category
    public function test_admin_user_can_access_form_edit_category()
    {
        $this->actingAs($this->adminUser);

        $category = Category::first();

        $response = $this->get(route('admin.categories.edit', $category->id));

        $response->assertOk();
    }

    // Admin user can edit a category
    public function test_admin_user_can_edit_a_category()
    {
        $this->actingAs($this->adminUser);

        $category = Category::first();

        $response = $this->put(route('admin.categories.update', $category->id), [
            'name' => 'Test Category',
        ]);

        $response->assertRedirectToRoute('admin.categories.index');

        $this->assertDatabaseHas('categories', [
            'name' => 'Test Category',
        ]);
    }

    // Admin user can delete a category
    public function test_admin_user_can_delete_a_category()
    {
        $this->actingAs($this->adminUser);

        $category = Category::first();

        $response = $this->delete(route('admin.categories.destroy', $category->id));

        $response->assertStatus(302);

        $this->assertDatabaseMissing('categories', [
            'name' => $category->name,
        ]);
    }
}
