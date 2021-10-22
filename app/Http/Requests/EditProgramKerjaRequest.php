<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class EditProgramKerjaRequest extends FormRequest
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
            'program_kerja_title' => 'required|string',
            'program_kerja_category' => 'required|string',
            'program_kerja_short_description' => 'required|string|min:50|max:250',
            'program_kerja_description' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'program_kerja_title.required' =>  'Judul program kerja wajib diisi',
            'program_kerja_category.required' =>  'Kategori program kerja wajib dipilih',
            'program_kerja_short_description.required' =>  'Deskripsi singkat wajib diisi',
            'program_kerja_short_description.min' =>  'Deskripsi singkat minimal 50 huruf',
            'program_kerja_short_description.max' =>  'Deskripsi singkat maksimal 250 huruf',
            'program_kerja_description.required' =>  'Isi program kerja wajib diisi',
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
