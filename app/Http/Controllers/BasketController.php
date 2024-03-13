<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use Illuminate\Http\Request;
use App\Services\BasketService;
use App\Http\Resources\Basket\BasketResource;
use App\Http\Requests\Basket\StoreBasketRequest;

class BasketController extends Controller
{
    private BasketService $basketService;

    public function __construct(BasketService $basketService)
    {
        $this->basketService = $basketService;
    }

    public function index(Request $request)
    {
        return BasketResource::collection($this->basketService->index($request));
    }

    public function store(StoreBasketRequest $request)
    {
        return (new BasketResource($this->basketService->store($request)));
    }

    public function destroy(Request $request, Basket $basket)
    {
        if ($request->user()->id != $basket->user_id) {
            return response()->json(["error" => "Access denied"], 403);
        }
        return response()->json([$this->basketService->destroy($basket), 204]);
    }
}
