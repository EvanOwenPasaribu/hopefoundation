<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CampaignsRequest extends FormRequest
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
            'kategori' => 'required|string',
            'judul' => 'required|string',
            'target' => 'required|integer',
            'batastanggal' => 'required',
            'link' => 'required|string',
            'foto' => 'required',
            'isicampaign' => 'required|string',
            'ajakansingkat' => 'required|string',
            'nomorhp' => 'required|string|min:10|max:16',
            'keperluan' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'kategori.required' =>  'Kategori wajib diisi',
            'judul.required' =>  'Judul campaign wajib diisi',
            'target.required' =>  'Target biaya wajib diisi',
            'target.integer' =>  'Target biaya harus berupa teks',
            'batastanggal.required' =>  'Batas tanggal wajib diisi',
            'link.required' => 'Link penggalangan wajib diisi',
            'foto.required' => 'Foto wajib diisi',
            'isicampaign.required' => 'Isi campaign wajib diisi',
            'ajakansingkat.required' => 'Ajakan singkat wajib diisi',
            'nomorhp.required' => 'Nomor handphone wajib diisi',
            'nomorhp.min' => 'Nomor handphone minimal 10 angka',
            'nomorhp.max' => 'Nomor handphone maksimal 16 angka',
            'keperluan.required' => 'Keperluan wajib diisi'
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
