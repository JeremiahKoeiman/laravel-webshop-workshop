<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Category::factory()
            ->times(3)
            ->create()
            ->each(function ($category) {
                $category->product()->saveMany(Product::factory()->times(10)->create(['category_id' => $category->id]));
            })
        ;
    }
}
