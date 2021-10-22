<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ProgramKerjaCategoryRequest extends FormRequest
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
            'program_kerja_category_description' => 'required|string|min:5|max:100',
            'program_kerja_url' => 'required|string|min:5|max:50',
        ];
    }

    public function messages()
    {
        return [
            'program_kerja_category_description.required' =>  'Nama program kerja category wajib diisi',
            'program_kerja_category_description.min' =>  'Nama program kerja category minimal 5 huruf',
            'program_kerja_category_description.max' =>  'Nama program kerja category maksimal 100 huruf',
            'program_kerja_url.required' =>  'Url program kerja category wajib diisi',
            'program_kerja_url.min' =>  'Url program kerja category minimal 5 huruf',
            'program_kerja_url.max' =>  'Url program kerja category maksimal 50 huruf'
            
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
