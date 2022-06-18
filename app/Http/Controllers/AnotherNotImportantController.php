<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use Illuminate\Http\Request;
use App\ContactUs;
use App\Campaigns;
use App\Templates;
use App\ProgramKerja;
use App\Event;
use App\InformasiKesehatan;
use App\Http\Requests\TemplateRequest;
use JWTAuth;
use App\Imports\VaksinasiImport;
use App\Imports\KodePendaftaranImport;
use Maatwebsite\Excel\Facades\Excel;

class AnotherNotImportantController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['postContactUs', 'templateWebsite', 'welcomecount']]);
    }

    public function postContactUs(ContactUsRequest $request)
    {
        $save = new ContactUs();
        $save->email = $request->email;
        $save->name = $request->name;
        $save->pesan = $request->pesan;
        $save->save();
        return response()->json([
            'code' => 200,
            'message' => 'Pesan berhasil dikirimkan, tim admin akan segera membalas pesan anda',
            'status' => 0,
            'data' => (object) array()
        ], 200);
    }

    public function templateWebsite(Request $request)
    {
        $data = Templates::find(1);
        return response()->json([
            'code' => 200,
            'message' => '',
            'status' => 0,
            'data' => $data
        ], 200);
    }

    public function postTemplateWebsite(TemplateRequest $request)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $save = Templates::find(1);
        $save->app_name = $request->get('app_name');
        if ($request->hasFile('front_picture')) {
            $request->file('front_picture')->move('images/template', 'front_picture.jpg');
        }
        if ($request->hasFile('front_picture_info_kesehatan')) {
            $extension = $request->file('front_picture_info_kesehatan')->extension();
            $request->file('front_picture_info_kesehatan')->move('images/template/info', date('Ymdhis') . '1.' . $extension);
            $save->picture_info_kesehatan = "/images/template/info/" . date('Ymdhis') . '1.' . $extension;
        }
        if ($request->hasFile('front_picture_edukasi_kesehatan')) {
            $extension = $request->file('front_picture_edukasi_kesehatan')->extension();
            $request->file('front_picture_edukasi_kesehatan')->move('images/template/info', date('Ymdhis') . '2.' . $extension);
            $save->picture_edukasi_kesehatan = "/images/template/info/" . date('Ymdhis') . '2.' . $extension;
        }
        if ($request->hasFile('front_picture_kerja_sama')) {
            $extension = $request->file('front_picture_kerja_sama')->extension();
            $request->file('front_picture_kerja_sama')->move('images/template/info', date('Ymdhis') . '3.' . $extension);
            $save->picture_kerja_sama = "/images/template/info/" . date('Ymdhis') . '3.' . $extension;
        }

        $countImageSlider1 = $request->get('countImageSlider1');
        $oldDataSlider1 = json_decode($request->get('oldDataSlider1'));
        $countImageSlider2 = $request->get('countImageSlider2');
        $oldDataSlider2 = json_decode($request->get('oldDataSlider2'));

        for ($i = 0; $i < $countImageSlider1; $i++) {
            if ($request->hasFile('slider_picture1' . ($i + 1))) {
                $tujuan_upload = 'images/template/slider';
                $dataImage = $request->file('slider_picture1' . ($i + 1));
                $extension = $request->file('slider_picture1' . ($i + 1))->extension();
                $namafile = $this->user->id . ($i + 1) . date('Ymdhis') . '1.' . $extension;
                $dataImage->move($tujuan_upload, $namafile);
                $oldDataSlider1[] = '/images/template/slider/' . $namafile;
            }
        }

        for ($i = 0; $i < $countImageSlider2; $i++) {
            if ($request->hasFile('slider_picture2' . ($i + 1))) {
                $tujuan_upload = 'images/template/slider';
                $dataImage = $request->file('slider_picture2' . ($i + 1));
                $extension = $request->file('slider_picture2' . ($i + 1))->extension();
                $namafile = $this->user->id . ($i + 1) . date('Ymdhis') . '2.' . $extension;
                $dataImage->move($tujuan_upload, $namafile);
                $oldDataSlider2[] = '/images/template/slider/' . $namafile;
            }
        }

        $save->profile_description = $request->get('profile_description');
        $save->caption_front_picture = $request->get('caption_front_picture');
        $save->caption_description_front_picture = $request->get('caption_description_front_picture');
        $save->button_description_front_picture = $request->get('button_description_front_picture');
        $save->about_us_description_footer = $request->get('about_us_description_footer');
        $save->address_footer = $request->get('address_footer');
        $save->number_phone_footer = $request->get('number_phone_footer');
        $save->email_footer = $request->get('email_footer');
        $save->whatsapp = $request->get('whatsapp');
        $save->youtube = $request->get('youtube');
        $save->facebook = $request->get('facebook');
        $save->instagram = $request->get('instagram');
        $save->program_kerja = $request->get('program_kerja');
        $save->picture_slider1 = json_encode($oldDataSlider1);
        $save->picture_slider2 = json_encode($oldDataSlider2);
        $save->facebook_page = $request->get('facebook_page');
        $save->instagram_page = $request->get('instagram_page');
        $save->youtube_page = $request->get('youtube_page');
        $save->tiktok_page = $request->get('tiktok_page');
        if ($request->hasFile('excel'))
            $row = Excel::import(new VaksinasiImport, $request->file('excel'));
        if ($request->hasFile('excelkodependaftaran'))
            $row = Excel::import(new KodePendaftaranImport, $request->file('excelkodependaftaran'));
        $save->save();
        return response()->json([
            'code' => 200,
            'message' => 'Data templates website berhasil diubah',
            'status' => 0,
            'data' => $save
        ], 200);
    }

    public function templatesuploadimage(Request $request)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $tujuan_upload = 'images/template/descriptionimage';
        $namafile = $this->user->id . date('Ymdhis') . '.jpg';
        $request->file('image')->move($tujuan_upload, $namafile);
        return response()->json([
            'code' => 200,
            'message' => '',
            'status' => 0,
            'data' => [
                'url' =>  '/' . $tujuan_upload . '/' . $this->user->id . date('Ymdhis') . '.jpg'
            ]
        ], 200);
    }

    public function welcomecount()
    {
        $countevent = Event::get()->count();
        $countprogramkerja = ProgramKerja::get()->count();
        $countinformasikesehatan = InformasiKesehatan::get()->count();
        $countcampaignspengobatan = Campaigns::where('id_category', '=', 5)->get()->count();
        $data = (object) array(
            'countevent' => $countevent,
            'countprogramkerja' => $countprogramkerja,
            'countinformasikesehatan' => $countinformasikesehatan,
            'countcampaignspengobatan' => $countcampaignspengobatan
        );
        return response()->json([
            'code' => 200,
            'message' => '',
            'status' => 0,
            'data' => $data
        ], 200);
    }
}
