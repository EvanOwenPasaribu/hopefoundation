<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class IsiSaldoRequest extends FormRequest
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
            'paymentmethod' => 'required',
            'jumlahtopup' => 'required|numeric|min:10000',
        ];
    }

    public function messages()
    {
        return [
            'paymentmethod.required' =>  'Metode pembayaran belum dipilih',
            'jumlahtopup.required' =>  'Nominal top up belum diisi',
            'jumlahtopup.numeric' => 'Isian nominal top up harus angka',
            'jumlahtopup.min' => 'Minimal top up harus Rp. 10.000'
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
