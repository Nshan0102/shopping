<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BasketStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            "product" => "required|array",
            "product.id" => "required|integer|exists:products,id",
            "product.quantity" => "required|integer|min:1"
        ];
    }
}
