<?php

namespace App\Services;

use App\Models\Basket;
use Illuminate\Http\Request;
use App\Http\Requests\Basket\StoreBasketRequest;

class BasketService
{
    public function index(Request $request)
    {
        return $request->user()->baskets->load('product');
    }

    public function store(StoreBasketRequest $request)
    {
        $basket = new Basket($request->toArray());
        $basket->user()->associate($request->user()->id);
        $basket->save();

        return $basket;
    }

    public function destroy(Basket $basket)
    {
        return $basket->delete();
    }
}
