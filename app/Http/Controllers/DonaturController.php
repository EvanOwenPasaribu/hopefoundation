<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use JWTAuth;

class DonaturController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt',['except'=>['']]);
    }
    public function adminindex()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $data = User::where('users_status','=','1')->where('isverified','=','Y')->orderby('id','DESC')->get();
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

    public function terimavoucher($id)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $save = User::find($id);
        $save->status_penerimaan = "1";
        $save->save();
        return response()->json([
            'code' => 200,
            'message' => 'Perubahan status penerimaan voucher berhasil dilakukan',
            'status' => 0,
            'data' => $save
        ], 200);
        
    }

    public function deletedonatur($id)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $delete = User::findOrFail($id);
        $delete->delete();
        return response()->json([
            'code' => 200,
            'message' => 'Data donatur berhasil dihapus',
            'status' => 0,
            'data' => $delete
        ], 200);
    }
}
