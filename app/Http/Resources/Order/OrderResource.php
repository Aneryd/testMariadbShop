<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\User\UserResource;
use App\Http\Resources\Product\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'total_price' => $this->total_price,
            'user' => $this->whenLoaded("user", new UserResource($this->user)),
            'is_cancel' => $this->is_cancel,
            'products' => $this->whenLoaded("products", ProductResource::collection($this->products)),
        ];
    }
}
