<?php

namespace App\Http\Controllers;

use App\Http\Requests\PendonorRequest;
use App\Pendonor;
use JWTAuth;
use Illuminate\Http\Request;

class PendonorController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->middleware('jwt',['except'=>['index','getdetailpendonorpengunjung']]);
    }

    public function index(Request $request)
    {
        
        
    }


    public function getdetailpendonorpengunjung($id)
    {
        $data = Pendonor::find($id);
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

    public function adminindex()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $data = Pendonor::where('pendonor_is_deleted','=','N')->orderby('id_pendonor','DESC')->get();
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

    public function addpendonor(PendonorRequest $request)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $save = new Pendonor();
        $save->namapendonor = $request->get('namapendonor');
        $save->golongandarah = $request->get('golongandarah');
        $save->nomorhandphone1 = $request->get('nomorhandphone1');
        $save->nomorhandphone2 = $request->get('nomorhandphone2');
        $save->alamatpendonor = $request->get('alamatpendonor');
        $save->pendonor_is_deleted = 'N';
        $save->save();
        return response()->json([
            'code' => 200,
            'message' => 'Data pendonor berhasil ditambahkan',
            'status' => 0,
            'data' => $save
        ], 200);
    }

    public function editpendonor(EditPendonorRequest $request,$id)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $save = Pendonor::find($id);
        $save->namapendonor = $request->get('namapendonor');
        $save->golongandarah = $request->get('golongandarah');
        $save->nomorhandphone1 = $request->get('nomorhandphone1');
        $save->nomorhandphone2 = $request->get('nomorhandphone2');
        $save->alamatpendonor = $request->get('alamatpendonor');
        $save->save();
        return response()->json([
            'code' => 200,
            'message' => 'Data pendonor berhasil diubah',
            'status' => 0,
            'data' => $save
        ], 200);
    }

    public function geteditpendonor($id)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $data = Pendonor::find($id);
        if($data == "")
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

    public function deletependonor($id)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $delete = Pendonor::findOrFail($id);
        $delete->delete();
        return response()->json([
            'code' => 200,
            'message' => 'Data pendonor berhasil dihapus',
            'status' => 0,
            'data' => $delete
        ], 200);
    }

    public function getdetailpendonor($id)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $data = Pendonor::find($id);
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
