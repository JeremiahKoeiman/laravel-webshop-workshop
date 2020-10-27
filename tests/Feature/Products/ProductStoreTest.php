<?php

use App\Models\User;
use App\Models\Category;
use App\Models\Product;

beforeEach(function () {
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('TestingUserSeeder');
    $this->category = App\Models\Category::factory()->create();
    $this->product = App\Models\Product::factory()->create();
    $this->price = App\Models\Price::factory()->create();
});

test('admin can create a product', function () {
   $admin = User::find(3);
   $category = Category::find(1);

   $this->actingAs($admin);
   $product = Product::factory(['category_id' => $category->id])->create();
   $response = $this->post(route('products.store'), $product->toArray());

   $this->get(route('products.index'))
       ->assertSee($product->name)
       ->assertSee($product->description);

})->group('ProductStore');

test('sales can create a product', function () {
    $sales = User::find(2);
    $category = Category::find(1);

    $this->actingAs($sales);
    $product = Product::factory(['category_id' => $category->id])->create();
    $response = $this->post(route('products.store'), $product->toArray());

    $this->get(route('products.index'))
        ->assertSee($product->name)
        ->assertSee($product->description);

})->group('ProductStore');

test('customer can not create a product', function () {
    $customer = App\Models\User::find(1);
    $category = Category::find(1);

    $this->actingAs($customer);
    $product = Product::factory(['category_id' => $category->id])->create();
    $response = $this->post(route('products.store'), $product->toArray());

    $this->get(route('products.create'))
        ->assertForbidden();

    $this->get(route('products.store'))
        ->assertForbidden();

    $this->get(route('products.index'))
        ->assertForbidden();
})->group('ProductStore');

test('guests can not create a product', function () {
    $this->get(route('products.create'))
        ->assertRedirect(route('login'));

    $this->post(route('products.store'))
        ->assertRedirect(route('login'));
})->group('ProductStore');
