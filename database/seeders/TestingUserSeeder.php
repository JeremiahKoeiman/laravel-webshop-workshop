<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class TestingUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->times(1)
            ->create([
                'name' => 'Customer',
                'email' => 'customer@test.com',
                'password' => bcrypt('test1234')
            ])
            ->each(function (User $user){
                $user->assignRole('customer');
            });

        User::factory()
            ->times(1)
            ->create([
                'name' => 'Sales',
                'email' => 'sales@test.com',
                'password' => bcrypt('test1234')
            ])
            ->each(function (User $user){
                $user->assignRole('sales');
            });

        User::factory()
            ->times(1)
            ->create([
                'name' => 'Admin',
                'email' => 'admin@test.com',
                'password' => bcrypt('test1234')
            ])
            ->each(function (User $user){
                $user->assignRole('admin');
            });
    }
}
