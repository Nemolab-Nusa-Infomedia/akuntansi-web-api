<?php

namespace App\Http\Requests\ProductRestock;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\RequestErrorMessage;

class ProductRestockCreateRequest extends FormRequest
{
    use RequestErrorMessage;

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
            'price_buy' => 'bail|required|numeric|integer|min:0|max_digits:20|max:18446744073709551615',
            'amount' => 'bail|required|numeric|integer|min:0|max_digits:20|max:18446744073709551615',
            'stock' => 'bail|required|numeric|integer|min:0|max_digits:10|max:4294967295',

            'product_id' => 'bail|required|string|exists:products,id',
        ];
    }

    /**
     * Aliases name
     * 
     * @return array
     */
    public function attributes(): array
    {
        return [
            'price_buy' => 'Harga beli',
            'amount' => 'Nominal',
            'stock' => 'Stok',

            'product_id' => 'Produk',
        ];
    }
}
