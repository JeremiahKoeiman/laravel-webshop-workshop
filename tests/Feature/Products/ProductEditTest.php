<?php

use App\Models\User;

beforeEach(function () {
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('TestingUserSeeder');
    $this->category = App\Models\Category::factory()->create();
    $this->product = App\Models\Product::factory()->create();
    $this->price = App\Models\Price::factory()->create();
});

test('admin can see the product edit page', function () {
   $admin = User::find(3);

   $this->actingAs($admin)
       ->get(route('products.edit', ['product' => $this->product->id]))
       ->assertViewIs('admin.products.edit')
       ->assertSee($this->category->name)
       ->assertSee($this->product->name)
       ->assertSee($this->product->description)
       ->assertSee($this->product->get_latest_price->price);
})->group('ProductEdit');

test('sales can see the product edit page', function () {
    $sales = User::find(2);

    $this->actingAs($sales)
        ->get(route('products.edit', ['product' => $this->product->id]))
        ->assertViewIs('admin.products.edit')
        ->assertSee($this->category->name)
        ->assertSee($this->product->name)
        ->assertSee($this->product->description)
        ->assertSee($this->product->get_latest_price->price);
})->group('ProductEdit');

test('customer can not see the product edit page', function () {
    $customer = App\Models\User::find(1);

    $this->actingAs($customer)
        ->get(route('products.edit', ['product' => $this->product->id]))
        ->assertForbidden();
})->group('ProductEdit');

test('guests can not see the product edit page', function () {
    $this->get(route('products.edit', ['product' => $this->product->id]))
        ->assertRedirect(route('login'));
})->group('ProductEdit');
