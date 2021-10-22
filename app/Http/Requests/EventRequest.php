<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class EventRequest extends FormRequest
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
            'event_title' => 'required|string',
            'event_short_description' => 'required|string|min:50|max:250',
            'event_description' => 'required|string',
            'event_foto' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'event_title.required' =>  'Judul kegiatan wajib diisi',
            'event_short_description.required' =>  'Deskripsi singkat wajib diisi',
            'event_short_description.min' =>  'Deskripsi singkat minimal 50 huruf',
            'event_short_description.max' =>  'Deskripsi singkat maksimal 250 huruf',
            'event_description.required' =>  'Isi kegiatan wajib diisi',
            'event_foto.required' => 'Foto wajib diisi'
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
