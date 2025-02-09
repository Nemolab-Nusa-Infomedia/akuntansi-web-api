<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\RequestErrorMessage;

class CompanyCreateRequest extends FormRequest
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
            'sub_from' => 'bail|required|date|before:sub_to',
            'sub_to' => 'bail|required|date|after:sub_from',
            'name' => 'bail|required|string|max:100',

            'location' => 'bail|nullable|string|max:100',

            'category_id' => 'bail|required|string|exists:company_categories,id',
            'subscription_id' => 'bail|required|string|exists:subscriptions,id',
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
            'sub_from' => 'Tanggal layanan dimulai',
            'sub_to' => 'Tanggal layanan berakhir',
            'name' => 'Nama',

            'location' => 'Lokasi',

            'subscription_id' => 'Langganan',
            'category_id' => 'Kategori',
        ];
    }
}
