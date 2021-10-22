<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class VaksinasiRequest extends FormRequest
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
            'pilihan_kota' => 'required',
            'email' => 'nullable|email',
            'namalengkap' => 'required|string',
            'nik' => 'required|digits_between:15,16|unique:vaksinasi|unique:vaksinasitemp',
            'ktp_foto' => 'required|mimes:jpeg,jpg,png',
            'jenis_kelamin' => 'required',
            'kotakelahiran' => 'required',
            'tanggallahir' => 'required',
            'alamat' => 'required',
            'nomorhpvaksin' => 'required|string|min:10|max:16',
            'nomorwavaksin' => 'required|string|min:10|max:16',
            'kodependaftaran' => 'nullable|size:9'
        ];
    }

    public function messages()
    {
        return [
            'pilihan_kota.required' =>  'Pilihan kota wajib dipilih',
            'email.email' => 'E-mail harus memiliki huruf @ dan .',
            'namalengkap.required' =>  'Nama wajib diisi',
            'nik.required' =>  'NIK e-KTP wajib diisi',
            'nik.digits_between' =>  'NIK e-KTP wajib 16 angka',
            'nik.unique' =>  'NIK e-KTP sudah pernah didaftarkan',
            'ktp_foto.required' => 'Foto KTP wajib diisi',
            'ktp_foto.mimes' => 'Foto KTP harus format JPG,JPEG, atau PNG',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi',
            'kotakelahiran.required' => 'Kota kelahiran wajib diisi',
            'tanggallahir.required' => 'Tanggal lahir wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'nomorhpvaksin.required' =>  'Nomor handphone wajib diisi',
            'nomorhpvaksin.min' => 'Nomor handphone minimal 10 angka',
            'nomorhpvaksin.max' => 'Nomor handphone maksimal 16 angka',
            'nomorwavaksin.required' =>  'Nomor whatsapp wajib diisi',
            'nomorwavaksin.min' => 'Nomor whatsapp minimal 10 angka',
            'nomorwavaksin.max' => 'Nomor whatsapp maksimal 16 angka',
            'kodependaftaran.size' =>  'Kode pendaftaran wajib 9 huruf',
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
