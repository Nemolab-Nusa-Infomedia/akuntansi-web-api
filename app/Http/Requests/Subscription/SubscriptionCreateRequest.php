<?php

namespace App\Http\Requests\Subscription;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\RequestErrorMessage;

class SubscriptionCreateRequest extends FormRequest
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
            'price' => 'bail|required|numeric|integer|min:0|max_digits:20|max:18446744073709551615',
            'duration' => 'bail|required|numeric|integer|min:0|max_digits:10|max:4294967295',
            'description' => 'bail|required|string|max:65535',
            'duration_text' => 'bail|required|string|max:100',
            'name' => 'bail|required|string|max:100',
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
            'duration_text' => 'Teks durasi',
            'description' => 'Deskripsi',
            'duration' => 'Duration',
            'price' => 'Harga',
            'name' => 'Nama',
        ];
    }
}
