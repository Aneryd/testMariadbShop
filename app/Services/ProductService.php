<?php

namespace App\Services;

use App\Models\Product;
use App\Http\Requests\Product\IndexProductRequest;

class ProductService
{
    public function index(IndexProductRequest $request)
    {
        $products = Product::orderBy("price");

        if ($request->has('price_from') || $request->has('price_to')) {
            if ($request->has('price_from')) {
                $products = $products->where("price", ">=", $request->price_from);
            }
            if ($request->has('price_to')) {
                $products = $products->where("price", "<=", $request->price_to);
            }
        }

        return $products->paginate($request->per_page ?? 15);
    }
}