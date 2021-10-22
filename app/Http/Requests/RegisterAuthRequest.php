<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class RegisterAuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'nomorhp' => 'required|string|unique:users|min:10|max:16'
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'Email sudah pernah digunakan',
            'email.email' => 'Email harus memiliki huruf @ dan .',
            'email.required' =>  'Email wajib diisi',
            'name.required' =>  'Nama wajib diisi',
            'password.required' =>  'Kata sandi wajib diisi',
            'password.min' => 'Kata sandi harus lebih dari 6 huruf',
            'nomorhp.required' =>  'Nomor handphone wajib diisi',
            'nomorhp.min' => 'Nomor handphone minimal 10 angka',
            'nomorhp.max' => 'Nomor handphone maksimal 16 angka',
            'nomorhp.unique' => 'Nomor handphone sudah pernah digunakan'
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        $jsonResponse = response()->json([
            'code' => 401,
            'message'=> '',
            'status' => 1,
            'errors' => $validator->errors()
        ], 401);

        throw new HttpResponseException($jsonResponse);
    }

    /*public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->somethingElseIsInvalid()) {
                $validator->errors()->add('field', 'Something is wrong with this field!');
            }
        });
    }*/
}
