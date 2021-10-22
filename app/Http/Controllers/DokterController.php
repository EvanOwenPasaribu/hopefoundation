<?php

namespace App\Http\Controllers;

use App\Http\Requests\DokterRequest;
use App\Http\Requests\EditDokterRequest;
use App\Dokter;
use App\RumahSakit;
use JWTAuth;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->middleware('jwt',['except'=>['index','getdetaildokterpengunjung','indexbyid']]);
    }

    public function index(Request $request)
    {
        if($request->get('keywords')=="")
            $data = Dokter::with(['rumahsakit'])->where('dokter_is_deleted','=','N')->orderby('id_dokter','DESC')->paginate(8);
        else
            $data = Dokter::with(['rumahsakit'])->where('dokter_is_deleted','=','N')->where('namadokter','LIKE', '%'.$request->get('keywords').'%')->orWhere('spesialist','LIKE', '%'.$request->get('keywords').'%')->orWhere('namarumahsakit','LIKE', '%'.$request->get('keywords').'%')->orderby('id_dokter','DESC')->paginate(8);
        if(count($data)==0)
        {
            return response()->json([
                'code' => 401,
                'message' => 'Hasil pencarian tidak ditemukan',
                'status' => 0,
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

    public function indexbyid(Request $request,$id_rumahsakit)
    {
        if($request->get('keywords')=="")
            $data = Dokter::where('dokter_is_deleted','=','N')->where('id_rumahsakit','=',$id_rumahsakit)->orderby('id_dokter','DESC')->paginate(8);
        else
            $data = Dokter::where('dokter_is_deleted','=','N')->where('id_rumahsakit','=',$id_rumahsakit)->where('namadokter','LIKE', '%'.$request->get('keywords').'%')->orWhere('spesialist','LIKE', '%'.$request->get('keywords').'%')->orderby('id_dokter','DESC')->paginate(8);
        if(count($data)==0)
        {
            return response()->json([
                'code' => 401,
                'message' => 'Hasil pencarian tidak ditemukan',
                'status' => 0,
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

    public function getdetaildokterpengunjung($id)
    {
        $data = Dokter::with(['rumahsakit'])->find($id);
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
        $data = Dokter::with(['rumahsakit'])->where('dokter_is_deleted','=','N')->orderby('id_dokter','DESC')->get();
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

    public function adddokter(DokterRequest $request)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $save = new Dokter();
        $save->id_rumahsakit = $request->get('rumah_sakits');
        $save->namadokter = $request->get('namadokter');
        $save->spesialist = $request->get('spesialist');
        $save->jadwalpraktek = $request->get('jadwalpraktek');
        $tujuan_upload = 'images/dokter';
        $namafile = $this->user->id . date('Ymdhis') . '.jpg';
        $request->file('dokter_foto')->move($tujuan_upload,$namafile);
        $save->dokter_foto = '/' . $tujuan_upload . '/' . $namafile;
        $save->dokter_is_deleted = 'N';
        $save->save();
        return response()->json([
            'code' => 200,
            'message' => 'Data dokter berhasil ditambahkan',
            'status' => 0,
            'data' => $save
        ], 200);
    }

    public function editdokter(EditDokterRequest $request,$id)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $save = Dokter::find($id);
        $save->id_rumahsakit = $request->get('rumah_sakits');
        $save->namadokter = $request->get('namadokter');
        $save->spesialist = $request->get('spesialist');
        $save->jadwalpraktek = $request->get('jadwalpraktek');
        $tujuan_upload = 'images/dokter';
        if($request->hasFile('dokter_foto'))
            $request->file('dokter_foto')->move($tujuan_upload,$save->dokter_foto);
        $save->save();
        return response()->json([
            'code' => 200,
            'message' => 'Data dokter berhasil diubah',
            'status' => 0,
            'data' => $save
        ], 200);
    }

    public function geteditdokter($id)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $data = Dokter::find($id);
        $rumahsakit = RumahSakit::where('rumah_sakit_is_deleted','=','N')->orderby('namarumahsakit','ASC')->get();
        $data->rumahsakit = $rumahsakit;
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

    public function deletedokter($id)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $delete = Dokter::findOrFail($id);
        unlink(public_path() . $delete->dokter_foto);
        $delete->delete();
        return response()->json([
            'code' => 200,
            'message' => 'Data dokter berhasil dihapus',
            'status' => 0,
            'data' => $delete
        ], 200);
    }

    public function getdetaildokter($id)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $data = Dokter::with(['rumahsakit'])->find($id);
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
