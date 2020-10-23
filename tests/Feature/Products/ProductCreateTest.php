<?php

use App\Models\User;

beforeEach(function () {
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('TestingUserSeeder');
    $this->category = App\Models\Category::factory()->create();
    $this->product = App\Models\Product::factory()->create();
    $this->price = App\Models\Price::factory()->create();
});

test('admin can see the product create page', function () {
   $admin = User::find(3);

   $this->actingAs($admin)
       ->get(route('products.create'))
       ->assertViewIs('admin.products.create');
});

test('sales can see the product create page', function () {
    $sales = User::find(2);

    $this->actingAs($sales)
        ->get(route('products.create'))
        ->assertViewIs('admin.products.create');
});

test('customer can not see the product create page', function () {
    $customer = App\Models\User::find(1);

    $this->actingAs($customer)
        ->get(route('products.create'))
        ->assertForbidden();
});

test('guests can not see the product create page', function () {
    $this->get(route('products.create'))
        ->assertRedirect(route('login'));
});
