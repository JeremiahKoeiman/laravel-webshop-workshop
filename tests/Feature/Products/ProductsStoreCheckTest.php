<?php

namespace Tests\Feature\Products;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Price;
use App\Models\Category;
use App\Models\User;

class ProductsStoreCheckTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        // First include all the normal setUp operations
        parent::setUp();

        $this->seed('RoleAndPermissionSeeder');
        $this->seed('TestingUserSeeder');
        $this->category = Category::factory()->create();
        $this->product = Product::factory()->create();
        $this->price = Price::factory()->create();
    }

    /**
     *
     * @param array $overrides
     * @return \Illuminate\Testing\TestResponse
     */
    public function postProduct($overrides = [])
    {
        $this->withExceptionHandling();
        $product = make('App\Models\Product', [
            $overrides
        ]);
        //return $this->post(route('products.store'), $product->toArray());
        return $this->postJson(route('products.store'), $product->toArray());
    }

    /**
     * @test
     * @return void
     */
    function a_product_requires_a_name()
    {
        $admin = User::find(3);
        $this->actingAs($admin);
        $this->postProduct(['name' => null])
            ->assertStatus(422);
    }

    /**
     * @test
     * @return void
     */
    function a_product_name_can_be_max_45_characters()
    {
        $admin = User::find(3);
        $this->actingAs($admin);
        $this->postProduct(['name' => '11324652365231562315621456236524545894785641561454526556'])
            ->assertStatus(422);
    }

    /**
     * @test
     * @return void
     */
    function a_product_name_must_be_unique()
    {
        $admin = User::find(3);
        $product = Product::find(1);
        $this->actingAs($admin);
        $this->postProduct(['name' => $product->name])
            ->assertStatus(422);
    }

    /**
     * @test
     * @return void
     */
    function a_product_requires_a_description()
    {
        $admin = User::find(3);
        $this->actingAs($admin);
        $this->postProduct(['description' => null])
            ->assertStatus(422);
    }

    /**
     * @test
     * @return void
     */
    function a_product_price_should_be_a_number()
    {
        $admin = User::find(3);
        $this->actingAs($admin);
        $this->postProduct(['price' => 'abc'])
            ->assertStatus(422);
    }

    /**
     * @test
     * @return void
     */
    function a_product_can_be_max_999999_99()
    {
        $admin = User::find(3);
        $this->actingAs($admin);
        $this->postProduct(['price' => 1000000.00])
            ->assertStatus(422);
    }
}
