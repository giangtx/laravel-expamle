<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 10; $i < 50; $i++) {
            $product = new Product();
            $product->name = "Product $i";
            $product->price = rand(100, 1000);
            $product->quantity = rand(1, 100);
            $product->image = "https://picsum.photos/200/300";
            $product->description = "Description $i";
            $product->code = "Code $i";
            $product->save();
        }
    }
}
