<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class DonationRequest extends FormRequest
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
            'paymentmethod' => 'required|string',
            'jumlahdonasi' => 'required|numeric|min:50000',
        ];
    }

    public function messages()
    {
        return [
            'paymentmethod.required' =>  'Metode pembayaran wajib dipilih',
            'jumlahdonasi.required' =>  'Jumlah donasi wajib diisi',
            'jumlahdonasi.min' => 'Jumlah donasi tidak boleh di bawah Rp. 50.000'
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
