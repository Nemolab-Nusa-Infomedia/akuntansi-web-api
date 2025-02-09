<?php

namespace App\Traits;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use App\Helpers\Response;

trait RequestErrorMessage
{
    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'max_digits' => ':attribute tidak boleh melebihi :max digit',
            'before' => ':attribute tidak boleh kurang dari :before',
            'after' => ':attribute tidak boleh lebih dari :after',
            'integer' => ':attribute harus berupa bilangan bulat',
            'confirmed' => 'Konfirmasi :attribute tidak sesuai',
            'in' => ':attribute tidak valid (pilihan: :values)',
            'min' => ':attribute tidak boleh kurang dari :min',
            'max' => ':attribute tidak boleh melebihi :max',
            'exists' => ':attribute tidak dapat digunakan',
            'email' => ':attribute harus berformat email',
            'numeric' => ':attribute harus berupa angka',
            'date' => ':attribute harus berupa tanggal',
            'string' => ':attribute harus berupa teks',
            'unique' => ':attribute sudah digunakan',
            'required' => ':attribute wajib diisi',
        ];
    }

    /**
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     * 
     * @return never
     */
    public function failedValidation(Validator $validator): never
    {
        $errors = [];

        foreach ($validator->errors()->toArray() as $index => $value) {
            $errors[] = [
                'property' => $index,
                'message' => $value[0],
            ];
        }

        throw new HttpResponseException(Response::SetAndGet(Response::BAD_REQUEST, 'Validasi gagal', $errors));
    }
}
