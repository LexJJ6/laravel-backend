<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => 'required|integer|min:0',
            'product_name' => 'required|string|max:255',
            'unit_price' => 'required|integer|min:0',
            'quantity' => 'required|integer|min:0',
            'subtotal' => 'required|integer|min:0',
        ];
    }
}
