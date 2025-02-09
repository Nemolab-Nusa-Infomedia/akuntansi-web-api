<?php

namespace App\Http\Requests\PaymentSubscription;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\RequestErrorMessage;

class PaymentSubscriptionCreateRequest extends FormRequest
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

            'subscription_id' => 'bail|required|string|exists:subscriptions,id',
            'company_id' => 'bail|required|string|exists:companies,id',
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
            'amount' => 'Nominal',

            'subscription_id' => 'Langganan',
            'company_id' => 'Perusahaan',
        ];
    }
}
