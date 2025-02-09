<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\RequestErrorMessage;

class TransactionCreateRequest extends FormRequest
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
            'amount' => 'bail|required|numeric|integer|min:0|max_digits:20|max:18446744073709551615',
            'description' => 'bail|required|string|max:65535',
            'date' => 'bail|required|date',

            'transaction_category_id' => 'bail|required|string|exists:transaction_categories,id',
            'company_id' => 'bail|required|string|exists:companies,id',
            'user_id' => 'bail|required|string|exists:users,id',
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
            'description' => 'Deskripsi',
            'amount' => 'Nominal',
            'date' => 'Tanggal',

            'transaction_category_id' => 'Kategori',
            'company_id' => 'Perusahaan',
            'user_id' => 'Pengguna',
        ];
    }
}
