<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kota;
use JWTAuth;

class KotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt',['except'=>['index']]);
    }
    public function index()
    {
        $data = Kota::where('is_active','=','Y')->get();
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
}
