<?php

beforeEach(function () {
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->category = App\Models\Category::factory()->create();
    $this->product = App\Models\Product::factory()->create();
    $this->price = App\Models\Price::factory()->create();
});

test('guests can see the product index page', function () {
    $this->withExceptionHandling()
        ->get(route('products.index'))
        ->assertSee($this->product->name)
        ->assertSee($this->product->category->name)
        ->assertSee($this->product->get_latest_price->price);

});
