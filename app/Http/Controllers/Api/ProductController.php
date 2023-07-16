<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Services\ProductManagement\ProductManagementService;
use Illuminate\Support\Facades\Log;

class ProductController extends ApiController
{

    protected $productManagementService;

    public function __construct(ProductManagementService $productManagementService)
    {
        $this->productManagementService = $productManagementService;
    }

    public function getAll(Request $request)
    {

        $page = $request->input('page', 1);
        if ($page < 1) {
            $page = 1;
        }
        $limit = $request->input('limit', 10);
        if ($limit < 1) {
            $limit = 10;
        }
        $name = $request->input('name', '');

        $products = $this->productManagementService->getAll($page, $limit, $name);

        return response()->json([
            'status' => self::STATUS_SUCCESS,
            'msg' => 'gio dua cay cai',
            'data' => $products,
        ]);
    }

    public function create(Request $request) {

        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'price' => 'required|integer',
        ]);

        // $data = $request->all();

        if ($request->has('name')) {
            $data['name'] = $request->input('name');
        }
        if($request->has('code')) {
            $data['code'] = $request->input('code');
        }
        if ($request->has('image')) {
            $data['image'] = $request->input('image');
        }
        if ($request->has('description')) {
            $data['description'] = $request->input('description');
        }
        if ($request->has('price')) {
            $data['price'] = $request->input('price');
        }


        $product = $this->productManagementService->create($data);

        return response()->json([
            'status' => self::STATUS_SUCCESS,
            'msg' => 'gio dua cay cai',
            'data' => $product,
        ]);
    }

    public function update(Request $request) {

        $request->validate([
            "id" => "required|integer",
        ]);

        // $data = $request->all();

        if($request->has('id')) {
            $data['id'] = $request->input('id');
        }
        if ($request->has('name')) {
            $data['name'] = $request->input('name');
        }
        if($request->has('code')) {
            $data['code'] = $request->input('code');
        }
        if ($request->has('image')) {
            $data['image'] = $request->input('image');
        }
        if ($request->has('description')) {
            $data['description'] = $request->input('description');
        }
        if ($request->has('price')) {
            $data['price'] = $request->input('price');
        }


        $product = $this->productManagementService->update($data);

        return response()->json([
            'status' => self::STATUS_SUCCESS,
            'msg' => 'gio dua cay cai',
            'data' => $product,
        ]);
    }
}
