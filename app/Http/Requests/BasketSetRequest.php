<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BasketSetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            "products" => "required|array",
            "products.*" => "required|array",
            "product.*.id" => "required|integer|exists:products,id",
            "product.*.quantity" => "required|integer|min:1"
        ];
    }
}
