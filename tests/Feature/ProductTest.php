<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Storage;
use Tests\TestCase;

class ProductTest extends TestCase
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

    // Regular user cannot access products pages
    public function test_regular_user_cannot_access_products_pages()
    {
        $category = Category::factory()->has(Product::factory()->count(1))->create();

        $this->actingAs($this->regularUser);

        $this->get(route('admin.products.index'))->assertForbidden();
        $this->get(route('admin.products.create'))->assertForbidden();
        $this->get(route('admin.products.edit', $category->products()->first()))->assertForbidden();
    }

    // Admin user can access product pages
    public function test_admin_can_access_product_pages()
    {
        $category = Category::factory()->has(Product::factory()->count(1))->create();

        $this->actingAs($this->adminUser);

        $this->get(route('admin.products.index'))->assertOk();
        $this->get(route('admin.products.create'))->assertOk();
        $this->get(route('admin.products.edit', $category->products()->first()))->assertOk();
    }

    // Admin user can create a product
    public function test_admin_can_create_a_product()
    {
        $category = Category::factory()->create();

        Storage::fake('local');

        $photo = UploadedFile::fake()->image('product.jpg');

        $this->actingAs($this->adminUser);

        $this->post(route('admin.products.store'), [
            'name' => 'Test Product',
            'description' => 'Test Description',
            'price' => 100,
            'category_id' => $category->id,
            'photo' => $photo,
        ])->assertStatus(302);

        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'description' => 'Test Description',
            'price' => 100,
            'category_id' => $category->id,
        ]);

        Storage::disk('local')->assertExists('public/products/'.$photo->hashName());
    }

    // view product
    public function test_view_a_product()
    {
        $category = Category::factory()->has(Product::factory()->count(1))->create();

        $this->actingAs($this->regularUser);

        $this->get(route('products.show', $category->products()->first()))->assertOk();
    }

    // Admin user can update a product
    public function test_admin_can_update_a_product()
    {
        $category = Category::factory()->has(Product::factory()->count(1))->create();

        Storage::fake('local');

        $photo = UploadedFile::fake()->image('product.jpg');

        $this->actingAs($this->adminUser);

        $this->put(route('admin.products.update', $category->products()->first()), [
            'name' => 'Test Product',
            'description' => 'Test Description',
            'price' => 100,
            'category_id' => $category->id,
            'photo' => $photo,
        ])->assertStatus(302);

        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'description' => 'Test Description',
            'price' => 100,
            'category_id' => $category->id,
        ]);

        Storage::disk('local')->assertExists('public/products/'.$photo->hashName());
    }

    // Admin user can delete a product
    public function test_admin_can_delete_a_product()
    {
        $category = Category::factory()->has(Product::factory()->count(1))->create();

        $product = $category->products()->first();

        $this->actingAs($this->adminUser);

        $this->delete(route('admin.products.destroy', $product))->assertStatus(302);

        $this->assertDatabaseMissing('products', [
            'id' => $product,
        ]);
    }
}
