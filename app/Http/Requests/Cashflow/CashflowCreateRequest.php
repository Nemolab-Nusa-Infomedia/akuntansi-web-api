<?php

namespace App\Http\Requests\Cashflow;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\RequestErrorMessage;

class CashflowCreateRequest extends FormRequest
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
            'cashflow_type_id' => 'bail|required|string|exists:cashflow_types,id',
            'transaction_id' => 'bail|required|string|exists:transactions,id',
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
            'transaction_id' => 'Transaksi',
            'cashflow_type_id' => 'Tipe',
        ];
    }
}
