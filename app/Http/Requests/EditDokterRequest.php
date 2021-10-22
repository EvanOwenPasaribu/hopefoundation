<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class EditDokterRequest extends FormRequest
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
            'rumah_sakits' => 'required|string',
            'namadokter' => 'required|string|max:200',
            'spesialist' => 'required|string|max:100',
            'jadwalpraktek' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'rumah_sakits.required' => 'Rumah sakit masih kosong',
            'namadokter.required' =>  'Nama dokter wajib diisi',
            'namadokter.max' =>  'Nama dokter maksimal 200 huruf',
            'spesialist.required' =>  'Informasi spesialist sakit wajib diisi',
            'spesialist.max' =>  'Informasi spesialist maksimal 100 huruf',
            'jadwalpraktek.required' => 'Jadwal praktek wajib diisi'
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
