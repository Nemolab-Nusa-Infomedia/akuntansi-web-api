<?php

namespace App\Http\Requests\SaleDetail;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\RequestErrorMessage;

class SaleDetailUpdateRequest extends FormRequest
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
            'total' => 'bail|required|numeric|integer|min:0|max_digits:20|max:18446744073709551615',
            'qty' => 'bail|required|numeric|integer|min:0|max_digits:10|max:4294967295',

            'product_id' => 'bail|required|string|exists:products,id',
            'sale_id' => 'bail|required|string|exists:sales,id',
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
            'qty' => 'Kuantitas',
            'total' => 'Total',

            'product_id' => 'Produk',
            'sale_id' => 'Penjualan',
        ];
    }
}
