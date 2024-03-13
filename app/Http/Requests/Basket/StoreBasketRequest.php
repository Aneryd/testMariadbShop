<?php

namespace App\Http\Requests\Basket;

use Illuminate\Foundation\Http\FormRequest;

class StoreBasketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "product_id" => "required|integer|exists:products,id"
        ];
    }
}
