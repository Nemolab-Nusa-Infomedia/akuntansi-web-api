<?php

namespace App\Http\Requests\Sale;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\RequestErrorMessage;

class SaleUpdateRequest extends FormRequest
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
            'subtotal' => 'bail|required|numeric|integer|min:0|max_digits:20|max:18446744073709551615',
            'total' => 'bail|required|numeric|integer|min:0|max_digits:20|max:18446744073709551615',
            'no_transaction' => 'bail|required|string|max:100',
            'payment_team' => 'bail|required|string|max:100',
            'attachment' => 'bail|required|string|max:100',
            'transaction_date' => 'bail|required|date',
            'memo' => 'bail|required|string|max:100',
            'due_date' => 'bail|required|date',

            'transaction_id' => 'bail|required|string|exists:transactions,id',
            'contact_id' => 'bail|required|string|exists:contacts,id',
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
            'transaction_date' => 'Tanggal transaksi',
            'no_transaction' => 'Nomor Transaksi',
            'due_date' => 'Tanggal akhir',
            'subtotal' => 'Sub Total',
            'payment_team' => 'Tim',
            'attachment' => 'File',
            'total' => 'Total',
            'memo' => 'Memo',

            'transaction_id' => 'Transaksi',
            'contact_id' => 'Kontak',
        ];
    }
}
