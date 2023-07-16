<?php
namespace App\Services\ProductManagement;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductModelsProxy {

    public function getAll($page = 1, $limit = 10, $name) {
        // \DB::connection()->enableQueryLog();

        $query = Product::query();

        if ($name) {
            // select * from products where name like '%name%'
            $query = $query->where('name', 'like', '%' . $name . '%');
        }

        $count = $query->count();

        // select * from products limit 10 offset 0
        $results = $query->skip(($page - 1) * $limit)
            ->take($limit)->get();

        foreach ($results as $index => $result) {
            $results[$index]['category'] = Category::find($result->category_id);
        }

        // Log::info(\DB::getQueryLog());
        return [
            'results' => $results,
            'paginate' => [
                'current' => $page,
                'limit' => $limit,
                'last' => ceil($count / $limit),
            ],
        ];
    }

    public function create($data) {
        $product = new Product();
        $product->name = $data['name'];
        $product->code = $data['code'];
        $product->image = $data['image'] ?? null;
        $product->description = $data['description'] ?? null;
        $product->price = $data['price'];
        $product->save();
        return $product;
    }

    public function update($data) {
        $product = $this->findById($data['id']);
        $product->name = $data['name'] ?? $product->name;
        $product->code = $data['code'] ?? $product->code;
        $product->image = $data['image'] ?? $product->image;
        $product->description = $data['description'] ?? $product->description;
        $product->price = $data['price'] ?? $product->price;
        $product->save();
        return $product;
    }
    public function findById($id) {
        return Product::find($id);
    }
}
