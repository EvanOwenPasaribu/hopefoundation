<?php

namespace App\Http\Controllers;
use App\Http\Requests\ProgramKerjaRequest;
use App\Http\Requests\EditProgramKerjaRequest;
use App\ProgramKerja;
use App\ProgramKerjaCategory;
use JWTAuth;

use Illuminate\Http\Request;

class ProgramKerjaController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->middleware('jwt',['except'=>['showByCategory','getdetailprogramkerjapengunjung']]);
    }

    public function showByCategory($program_kerja_url,Request $request)
    {
        $id_programkerjacategory = ProgramKerjaCategory::where('program_kerja_url','=',$program_kerja_url)->first();
        if($request->get('keywords')=="")
            $data = ProgramKerja::with(['programkerjacategory'])->where('id_programkerjacategory','=',$id_programkerjacategory->id_programkerjacategory)->orderby('id_programkerja','DESC')->paginate(8);
        else
            $data = ProgramKerja::with(['programkerjacategory'])->where('id_programkerjacategory','=',$id_programkerjacategory->id_programkerjacategory)->where('program_kerja_title','LIKE', '%'.$request->get('keywords').'%')->orWhere('program_kerja_short_description','LIKE', '%'.$request->get('keywords').'%')->orderby('id_programkerja','DESC')->paginate(8);
        if(count($data)==0)
        {
            return response()->json([
                'code' => 401,
                'message' => 'Hasil pencarian tidak ditemukan',
                'status' => 0,
                'category' => $id_programkerjacategory->program_kerja_category_description,
                'current_page' => $data->currentPage(),
                'data' => $data->items(),
                'first_page_url' => $data->url(1),
                'from' => $data->firstItem(),
                'last_page' => $data->lastPage(),
                'last_page_url'=> $data->url($data->lastPage()),
                'next_page_url' => $data->nextPageUrl(),
                'option' => $data->getOptions(),
                'per_page' => $data->perPage(),
                'prev_page_url' => $data->previousPageUrl(),
                'to' => $data->lastItem(),
                'total' => $data->total()
            ], 401);
        }
        else
        {
            return response()->json([
                'code' => 200,
                'message' => '',
                'status' => 0,
                'category' => $id_programkerjacategory->program_kerja_category_description,
                'current_page' => $data->currentPage(),
                'data' => $data->items(),
                'first_page_url' => $data->url(1),
                'from' => $data->firstItem(),
                'last_page' => $data->lastPage(),
                'last_page_url'=> $data->url($data->lastPage()),
                'next_page_url' => $data->nextPageUrl(),
                'option' => $data->getOptions(),
                'per_page' => $data->perPage(),
                'prev_page_url' => $data->previousPageUrl(),
                'to' => $data->lastItem(),
                'total' => $data->total()
            ], 200);
        }
    }

    public function getdetailprogramkerjapengunjung($program_kerja_url,$id)
    {
        $programkerjacategory = ProgramKerjaCategory::where('program_kerja_url','=',$program_kerja_url)->first();
        if($programkerjacategory == "")
        {
            return response()->json([
                'code' => 401,
                'message' => 'Data tidak ditemukan',
                'status' => 0,
                'data' => (object) array()
            ], 401);
        }
        else
        {
            $data = ProgramKerja::with(['user','programkerjacategory'])->where('id_programkerjacategory','=',$programkerjacategory->id_programkerjacategory)->find($id);
            if($data == "")
            {
                return response()->json([
                    'code' => 401,
                    'message' => 'Data tidak ditemukan',
                    'status' => 0,
                    'data' => $data
                ], 401);
            }
            else
            {
                return response()->json([
                    'code' => 200,
                    'message' => '',
                    'status' => 0,
                    'data' => $data
                ], 200);
            }
        }
    }

    public function adminindex()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $data = ProgramKerja::with(['user','programkerjacategory'])->orderby('id_programkerja','DESC')->get();
        if(count($data)==0)
        {
            return response()->json([
                'code' => 401,
                'message' => 'Data masih kosong',
                'status' => 0,
                'data' => $data
            ], 401);
        }
        else
        {
            return response()->json([
                'code' => 200,
                'message' => '',
                'status' => 0,
                'data' => $data
            ], 200);
        }
        
    }

    public function programkerjauploadimage(Request $request)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $tujuan_upload = 'images/programkerja/descriptionimage';
        $namafile = $this->user->id . date('Ymdhis') . '.jpg';
        $request->file('image')->move($tujuan_upload,$namafile);
        return response()->json([
            'code' => 200,
            'message' => '',
            'status' => 0,
            'data' => [
                'url' =>  '/' . $tujuan_upload . '/' . $this->user->id . date('Ymdhis') . '.jpg'
            ]
        ], 200);
    }

    public function addprogramkerja(ProgramKerjaRequest $request)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $save = new ProgramKerja();
        $save->id = $this->user->id;
        $save->id_programkerjacategory = $request->get('program_kerja_category');
        $save->program_kerja_title = $request->get('program_kerja_title');
        $save->program_kerja_short_description = $request->get('program_kerja_short_description');
        $save->program_kerja_description = $request->get('program_kerja_description');
        $tujuan_upload = 'images/programkerja';
        $namafile = $this->user->id . date('Ymdhis') . '.jpg';
        $request->file('program_kerja_foto')->move($tujuan_upload,$namafile);
        $save->program_kerja_foto = '/' . $tujuan_upload . '/' . $namafile;
        $save->program_kerja_foto_name = $namafile;
        $save->save();
        return response()->json([
            'code' => 200,
            'message' => 'Data program kerja berhasil ditambahkan',
            'status' => 0,
            'data' => $save
        ], 200);
    }

    public function editprogramkerja(EditProgramKerjaRequest $request,$id)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $save = ProgramKerja::find($id);
        $save->id_programkerjacategory = $request->get('program_kerja_category');
        $save->program_kerja_title = $request->get('program_kerja_title');
        $save->program_kerja_short_description = $request->get('program_kerja_short_description');
        $save->program_kerja_description = $request->get('program_kerja_description');
        $tujuan_upload = 'images/programkerja';
        if($request->hasFile('program_kerja_foto'))
            $request->file('program_kerja_foto')->move($tujuan_upload,$save->program_kerja_foto);
        $save->save();
        return response()->json([
            'code' => 200,
            'message' => 'Data program kerja berhasil diubah',
            'status' => 0,
            'data' => $save
        ], 200);
    }

    public function geteditprogramkerja($id)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $data = ProgramKerja::find($id);
        if($data == "")
        {
            return response()->json([
                'code' => 401,
                'message' => 'Data tidak ditemukan',
                'status' => 0,
                'data' => $data
            ], 401);
        }
        else
        {
            return response()->json([
                'code' => 200,
                'message' => '',
                'status' => 0,
                'data' => $data
            ], 200);
        }
        
    }

    public function deleteprogramkerja($id)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $delete = ProgramKerja::findOrFail($id);
        unlink(public_path() . $delete->program_kerja_foto);
        $delete->delete();
        return response()->json([
            'code' => 200,
            'message' => 'Data program kerja berhasil dihapus',
            'status' => 0,
            'data' => $delete
        ], 200);
    }

    public function getdetailprogramkerja($id)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $data = ProgramKerja::with(['user','programkerjacategory'])->find($id);
        if($data == "")
        {
            return response()->json([
                'code' => 401,
                'message' => 'Data tidak ditemukan',
                'status' => 0,
                'data' => $data
            ], 401);
        }
        else
        {
            return response()->json([
                'code' => 200,
                'message' => '',
                'status' => 0,
                'data' => $data
            ], 200);
        }
        
    }
}
