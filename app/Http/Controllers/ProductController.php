<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Http\Resources\Product\ProductResource;
use App\Http\Requests\Product\IndexProductRequest;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(IndexProductRequest $request)
    {
        return ProductResource::collection($this->productService->index($request));
    }
}
