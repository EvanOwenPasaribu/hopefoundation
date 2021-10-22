<?php

namespace App\Http\Controllers;
use App\Http\Requests\ProgramKerjaCategoryRequest;
use Illuminate\Http\Request;
use App\ProgramKerjaCategory;
use JWTAuth;

class ProgramKerjaCategoryController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->middleware('jwt',['except'=>['index']]);
    }
    
    public function index()
    {
        $data = ProgramKerjaCategory::where('program_kerja_category_is_deleted','=','N')->get();
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

    public function adminindex()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $data = ProgramKerjaCategory::orderby('id_programkerjacategory','DESC')->get();
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

    public function addprogramkerjacategory(ProgramKerjaCategoryRequest $request)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $save = new ProgramKerjaCategory();
        $save->program_kerja_category_description = $request->get('program_kerja_category_description');
        $save->program_kerja_url = $request->get('program_kerja_url');
        $save->save();
        return response()->json([
            'code' => 200,
            'message' => 'Data program kerja kategori berhasil ditambahkan',
            'status' => 0,
            'data' => $save
        ], 200);
    }

    public function editprogramkerjacategory(ProgramKerjaCategoryRequest $request,$id)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $save = ProgramKerjaCategory::find($id);
        $save->program_kerja_category_description = $request->get('program_kerja_category_description');
        $save->program_kerja_url = $request->get('program_kerja_url');
        $save->program_kerja_category_is_deleted = 'N';
        $save->save();
        return response()->json([
            'code' => 200,
            'message' => 'Data program kerja kategori berhasil diubah',
            'status' => 0,
            'data' => $save
        ], 200);
    }

    public function geteditprogramkerjacategory($id)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $data = ProgramKerjaCategory::find($id);
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

    public function deleteprogramkerjacategory($id)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $delete = ProgramKerjaCategory::findOrFail($id);
        $delete->delete();
        return response()->json([
            'code' => 200,
            'message' => 'Data program kerja kategori berhasil dihapus',
            'status' => 0,
            'data' => $delete
        ], 200);
    }
}
