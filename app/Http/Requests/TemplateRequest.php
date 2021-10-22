<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class TemplateRequest extends FormRequest
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
            'app_name' => 'required|string|min:5|max:20',
            'profile_description' => 'required|string',
            'caption_front_picture' => 'required|string|min:10|max:40',
            'caption_description_front_picture' => 'required|string|min:40|max:80',
            'button_description_front_picture' => 'required|string|min:10|max:20',
            'about_us_description_footer' => 'required|string|min:50|max:200',
            'address_footer' => 'required|string|min:5|max:100',
            'number_phone_footer' => 'required|string|min:10|max:16',
            'email_footer' => 'required|string|min:5|max:30',
            'whatsapp' => 'required|string|min:10|max:16',
            'youtube' => 'required|string|max:30',
            'facebook' => 'required|string|max:30',
            'instagram' => 'required|string|max:30',
            'facebook_page' => 'required|string',
            'pilihan_kota'=>'required_with:excel',
            'excel'=>'required_with:pilihan_kota',
        ];
    }

    public function messages()
    {
        return [
            'app_name.required' =>  'Nama aplikasi wajib diisi',
            'app_name.min' => 'Nama aplikasi minimal 5 huruf',
            'app_name.max' => 'Nama aplikasi maksimal 20 huruf',
            'profile_description.required' => 'Profile website wajib diisi',
            'caption_front_picture.required' =>  'Caption foto depan wajib diisi',
            'caption_front_picture.min' => 'Caption foto depan minimal 10 huruf',
            'caption_front_picture.max' => 'Caption foto depan maksimal 40 huruf',
            'caption_description_front_picture.required' =>  'Deskripsi Caption foto depan wajib diisi',
            'caption_description_front_picture.min' => 'Deskripsi Caption foto depan minimal 40 huruf',
            'caption_description_front_picture.max' => 'Deskripsi Caption foto depan maksimal 80 huruf',
            'button_description_front_picture.required' =>  'Nama button pada foto depan wajib diisi',
            'button_description_front_picture.min' => 'Nama button pada foto depan minimal 10 huruf',
            'button_description_front_picture.max' => 'Nama button pada foto depan maksimal 20 huruf',
            'about_us_description_footer.required' =>  'Informasi about us pada footer wajib diisi',
            'about_us_description_footer.min' => 'Informasi about us pada footer minimal 50 huruf',
            'about_us_description_footer.max' => 'Informasi about us pada footer maksimal 200 huruf',
            'address_footer.required' =>  'Alamat pada footer wajib diisi',
            'address_footer.min' => 'Alamat pada footer minimal 5 huruf',
            'address_footer.max' => 'Alamat pada footer maksimal 100 huruf',
            'number_phone_footer.required' =>  'Nomor telepon pada footer wajib diisi',
            'number_phone_footer.min' => 'Nomor telepon pada footer minimal 10 huruf',
            'number_phone_footer.max' => 'Nomor telepon pada footer maksimal 16 huruf',
            'email_footer.required' =>  'Email pada footer wajib diisi',
            'email_footer.min' => 'Email pada footer minimal 5 huruf',
            'email_footer.max' => 'Email pada footer maksimal 30 huruf',
            'whatsapp.required' =>  'Whatsapp wajib diisi',
            'whatsapp.min' => 'Whatsapp minimal 10 huruf',
            'whatsapp.max' => 'Whatsapp maksimal 16 huruf',
            'youtube.required' =>  'Youtube wajib diisi',
            'youtube.max' => 'Youtube maksimal 30 huruf',
            'facebook.required' =>  'Facebook wajib diisi',
            'facebook.max' => 'Facebook maksimal 30 huruf',
            'instagram.required' =>  'Instagram wajib diisi',
            'instagram.max' => 'Instagram maksimal 30 huruf',
            'facebook_page.required' =>  'Facebook page wajib diisi',
            'pilihan_kota.required_with' =>  'Pilihan kota wajib diisi jika ingin melakukan import File Excel Data Vaksinasi',
            'excel.required_with' => 'Pilih file Excel yang akan diimport'
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
