<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class EditPendonorRequest extends FormRequest
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
            'namapendonor' => 'required|string|max:200',
            'golongandarah' => 'required|string',
            'nomorhandphone1' => 'required|string|unique:pendonor|min:10|max:16|different:nomorhandphone2',
            'nomorhandphone2' => 'nullable|unique:pendonor|min:10|max:16|different:nomorhandphone1',
            'alamatpendonor' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'namapendonor.required' => 'Nama pendonor wajib diisi',
            'golongandarah.required' =>  'Golongan darah wajib diisi',
            'nomorhandphone1.required' =>  'Nomor handphone yang pertama wajib diisi',
            'nomorhandphone1.min' => 'Nomor handphone yang pertama minimal 10 angka',
            'nomorhandphone1.max' => 'Nomor handphone yang pertama maksimal 16 angka',
            'nomorhandphone1.different' => 'Nomor handphone yang pertama tidak boleh sama dengan yang kedua',
            'nomorhandphone2.min' => 'Nomor handphone yang kedua minimal 10 angka',
            'nomorhandphone2.max' => 'Nomor handphone yang kedua maksimal 16 angka',
            'nomorhandphone2.different' => 'Nomor handphone yang kedua tidak boleh sama dengan yang pertama',
            'alamatpendonor.required' => 'Alamat pendonor wajib diisi'
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
