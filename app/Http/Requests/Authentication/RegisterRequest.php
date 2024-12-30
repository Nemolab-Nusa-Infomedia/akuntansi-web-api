<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\RequestErrorMessage;

class RegisterRequest extends FormRequest
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
            'password' => 'bail|required|string|min:8|max:100',
            'company_name' => 'bail|required|string|max:100',
            'email' => 'bail|required|string|email|max:100',
            'phone' => 'bail|required|string|max:100',
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
            'company_name' => 'Nama perusahaan',
            'password' => 'Kata sandi',
            'email' => 'Email',
            'phone' => 'Nomor',
            'name' => 'Nama',
        ];
    }
}
