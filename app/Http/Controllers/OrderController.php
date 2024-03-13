<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Basket;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Http\Resources\Order\OrderResource;

class OrderController extends Controller
{
    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request)
    {
        return OrderResource::collection($this->orderService->index($request));
    }
    public function createOrder(Request $request)
    {
        $data = $this->orderService->createOrder($request);
        return $data;
        if (isset($data["error"])) {
            return response()->json(["error" => $data["error"]], $data["code"]);
        }
        return new OrderResource($data);
    }

    public function cancelOrder(Request $request, Order $order)
    {
        if ($request->user()->id != $order->user_id) {
            return response()->json(["error" => "Access denied"], 403);
        }
        return new OrderResource($this->orderService->cancelOrder($request, $order));
    }
}
