<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Basket;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class OrderService
{
    public function index(Request $request)
    {
        return $request->user()->orders->load("products");
    }
    public function createOrder(Request $request)
    {
        $products_id = $request->user()->baskets->pluck('product_id')->toArray();
        // return $products_id;
        $products_price = Product::whereIn('id', $products_id)->sum('price');

        if (empty($products_id)) {
            return ["error" => "Корзина пуста", "code" => 403];
        }

        if ($request->user()->balance < $products_price) {
            return ["error" => "У вас не хватает средств на балансе!", "code" => 404];
        }

        $order = Order::create([
            'total_price' => $products_price,
            'user_id' => $request->user()->id
        ]);

        $orderProducts = [];
        array_walk_recursive($products_id, function ($value) use (&$orderProducts, $order) {
            $orderProducts[] = [
                "product_id" => $value,
                "order_id" => $order->id
            ];
        }, $orderProducts);

        OrderProduct::insert($orderProducts);

        $request->user()->balance -= $products_price;
        $request->user()->save();

        Basket::where('user_id', '=', $request->user()->id)->delete();

        return $order;
    }

    public function cancelOrder(Request $request, Order $order)
    {
        $request->user()->balance += $order->total_price;
        $request->user()->save();

        $order->update([
            'is_cancel' => 1,
        ]);

        return $order;
    }
}
