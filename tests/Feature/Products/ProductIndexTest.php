<?php

beforeEach(function () {
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('TestingUserSeeder');
    $this->category = App\Models\Category::factory()->create();
    $this->product = App\Models\Product::factory()->create();
    $this->price = App\Models\Price::factory()->create();
});

test('admin can see the product index page', function () {
    $admin = App\Models\User::find(3);

    $this->actingAs($admin)
        ->get(route('products.index'))
        ->assertSee($this->product->name)
        ->assertSee($this->product->category->name)
        ->assertSee($this->product->get_latest_price->price);
});

test('sales can see the product index page', function () {
    $sales = App\Models\User::find(2);

    $this->actingAs($sales)
        ->get(route('products.index'))
        ->assertSee($this->product->name)
        ->assertSee($this->product->category->name)
        ->assertSee($this->product->get_latest_price->price);
});

test('customer can not see the product index page', function () {
    $customer = App\Models\User::find(1);

    $this->actingAs($customer)
        ->get(route('products.index'))
        ->assertForbidden();
});

test('guests can not see the product index page', function () {
    $this->get(route('products.index'))
        ->assertRedirect(route('login'));
});
