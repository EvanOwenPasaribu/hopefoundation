<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class InformasiKesehatanRequest extends FormRequest
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
            'informasi_kesehatan_title' => 'required|string',
            'informasi_kesehatan_short_description' => 'required|string|min:50|max:250',
            'informasi_kesehatan_description' => 'required|string',
            'informasi_kesehatan_foto' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'informasi_kesehatan_title.required' =>  'Judul informasi wajib diisi',
            'informasi_kesehatan_short_description.required' =>  'Deskripsi singkat wajib diisi',
            'informasi_kesehatan_short_description.min' =>  'Deskripsi singkat minimal 50 huruf',
            'informasi_kesehatan_short_description.max' =>  'Deskripsi singkat maksimal 250 huruf',
            'informasi_kesehatan_description.required' =>  'Isi informasi wajib diisi',
            'informasi_kesehatan_foto.required' => 'Foto wajib diisi'
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
