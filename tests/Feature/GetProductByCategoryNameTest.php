<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetProductByCategoryNameTest extends TestCase
{
    use RefreshDatabase;

    public User $user;

    public Category $category;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->category = Category::factory()->create();
    }

    // test if user can get products by category name
    public function test_user_can_get_products_by_category_name()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('getProductByCategoryName') . '?name=' . $this->category->name);

        $response->assertStatus(200);
    }

    // status code should be 404 if category name is not found
    public function test_status_code_should_be_404_if_category_not_found()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('getProductByCategoryName') . '?name=' . 'random');

        $response->assertStatus(404);
    }


}
