<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\RequestErrorMessage;
use App\Models\Contact;

class ContactCreateRequest extends FormRequest
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
            'identity' => 'bail|required|string|in:' . Contact::PASPOR . '.' . Contact::KTP . '.' . Contact::SIM,
            'billing_address' => 'bail|required|string|max:65535',
            'payment_address' => 'bail|required|string|max:65535',
            'name_bank' => 'bail|required|string|max:100',
            'no_bank' => 'bail|required|string|max:100',
            'pt_name' => 'bail|required|string|max:100',
            'phone' => 'bail|required|string|max:100',
            'email' => 'bail|required|string|max:100',
            'name' => 'bail|required|string|max:100',

            'type_id' => 'bail|required|string|exists:contact_types,id',
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
            'payment_address' => 'Alamat pembayaran',
            'billing_address' => 'Alamat tagihan',
            'name_bank' => 'Nama Bank',
            'identity' => 'Identitas',
            'no_bank' => 'Nomor Bank',
            'pt_name' => 'Nama PT',
            'phone' => 'Nomor HP',
            'email' => 'Email',
            'name' => 'Nama',

            'type_id' => 'Tipe',
        ];
    }
}
