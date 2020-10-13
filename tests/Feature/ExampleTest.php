<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\User;
use function PHPUnit\Framework\assertNotEmpty;

uses(RefreshDatabase::class);

it('has a welcome page', function () {
    $response = $this->get('/');
    $response->assertStatus(200);
})->skip();

it('validate emails', function ($email) {
    assertNotEmpty($email);
})->with('emails');

it('has users', function () {
    beforeEach(fn() => User::factory()->create());
    $this->assertDatabaseHas('users', ['id' => 1]);
});
