<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class RumahSakitRequest extends FormRequest
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
            'namarumahsakit' => 'required|string|max:200',
            'alamatrumahsakit' => 'required|string',
            'latituders' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'namarumahsakit.required' =>  'Nama rumah sakit wajib diisi',
            'namarumahsakit.max' =>  'Nama rumah sakit maksimal 200 huruf',
            'alamatrumahsakit.required' =>  'Alamat rumah sakit wajib diisi',
            'latituders.required' =>  'Posisi koordinat rumah sakit belum ditandai'
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
}
