<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\RequestErrorMessage;
use App\Models\User;

class UserCreateRequest extends FormRequest
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
            'status_account' => 'bail|required|string|in:' . User::ACTIVE . ',' . User::DISABLE,
            'email' => 'bail|required|string|email|max:100|unique:users,email',
            'password' => 'bail|required|string|min:8',
            'phone' => 'bail|required|string|max:100',
            'name' => 'bail|required|string|max:100',

            'role_id' => 'bail|required|string|exists:roles,id',
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
            'status_account' => 'Status akun',
            'password' => 'Kata sandi',
            'email' => 'Alamat email',
            'phone' => 'Nomor HP',
            'name' => 'Nama',

            'role_id' => 'Akses',
        ];
    }
}
