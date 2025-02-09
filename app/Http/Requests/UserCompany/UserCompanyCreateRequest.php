<?php

namespace App\Http\Requests\UserCompany;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\RequestErrorMessage;

class UserCompanyCreateRequest extends FormRequest
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
            'role' => 'bail|required|string|max:100',

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
            'role' => 'Akses',

            'company_id' => 'Perusahaan',
            'user_id' => 'Pengguna',
        ];
    }
}
