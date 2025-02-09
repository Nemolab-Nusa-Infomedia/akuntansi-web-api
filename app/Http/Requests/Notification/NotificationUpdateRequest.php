<?php

namespace App\Http\Requests\Notification;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\RequestErrorMessage;

class NotificationUpdateRequest extends FormRequest
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
            'body' => 'bail|required|string|max:65535',
            'title' => 'bail|required|string|max:100',

            'receiver_id' => 'bail|required|string|exists:users,id',
            'sender_id' => 'bail|required|string|exists:users,id',
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
            'title' => 'Judul',
            'body' => 'Isi',

            'receiver_id' => 'Penerima',
            'sender_id' => 'Pengirim',
        ];
    }
}
