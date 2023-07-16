<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 10; $i < 50; $i++) {
            $category = new \App\Models\Category();
            $category->name = "Category $i";
            $category->code = "code-$i";
            $category->save();
        }

    }
}
