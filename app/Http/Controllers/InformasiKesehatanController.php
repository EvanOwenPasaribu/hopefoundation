<?php

namespace App\Http\Controllers;

use App\Http\Requests\InformasiKesehatanRequest;
use App\Http\Requests\EditInformasiKesehatanRequest;
use App\InformasiKesehatan;
use JWTAuth;
use Illuminate\Http\Request;

class InformasiKesehatanController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->middleware('jwt',['except'=>['index','getdetailinformasikesehatanpengunjung']]);
    }

    public function index(Request $request)
    {
        if($request->get('keywords')=="")
            $data = InformasiKesehatan::orderby('id_informasikesehatan','DESC')->paginate(8);
        else
            $data = InformasiKesehatan::where('informasi_kesehatan_title','LIKE', '%'.$request->get('keywords').'%')->orWhere('informasi_kesehatan_short_description','LIKE', '%'.$request->get('keywords').'%')->orderby('id_informasikesehatan','DESC')->paginate(8);
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

    public function getdetailinformasikesehatanpengunjung($id)
    {
        $data = InformasiKesehatan::with(['user'])->find($id);
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
        $data = InformasiKesehatan::with(['user'])->orderby('id_informasikesehatan','DESC')->get();
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

    public function informasikesehatanuploadimage(Request $request)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $tujuan_upload = 'images/informasikesehatan/descriptionimage';
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

    public function addinformasikesehatan(InformasiKesehatanRequest $request)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $save = new InformasiKesehatan();
        $save->id = $this->user->id;
        $save->informasi_kesehatan_title = $request->get('informasi_kesehatan_title');
        $save->informasi_kesehatan_short_description = $request->get('informasi_kesehatan_short_description');
        $save->informasi_kesehatan_description = $request->get('informasi_kesehatan_description');
        $tujuan_upload = 'images/informasikesehatan';
        $namafile = $this->user->id . date('Ymdhis') . '.jpg';
        $request->file('informasi_kesehatan_foto')->move($tujuan_upload,$namafile);
        $save->informasi_kesehatan_foto = '/' . $tujuan_upload . '/' . $namafile;
        $save->save();
        return response()->json([
            'code' => 200,
            'message' => 'Data informasi kesehatan berhasil ditambahkan',
            'status' => 0,
            'data' => $save
        ], 200);
    }

    public function editinformasikesehatan(EditInformasiKesehatanRequest $request,$id)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $save = InformasiKesehatan::find($id);
        $save->informasi_kesehatan_title = $request->get('informasi_kesehatan_title');
        $save->informasi_kesehatan_short_description = $request->get('informasi_kesehatan_short_description');
        $save->informasi_kesehatan_description = $request->get('informasi_kesehatan_description');
        $tujuan_upload = 'images/informasikesehatan';
        if($request->hasFile('informasi_kesehatan_foto'))
            $request->file('informasi_kesehatan_foto')->move($tujuan_upload,$save->informasi_kesehatan_foto);
        $save->save();
        return response()->json([
            'code' => 200,
            'message' => 'Data informasi kesehatan berhasil diubah',
            'status' => 0,
            'data' => $save
        ], 200);
    }

    public function geteditinformasikesehatan($id)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $data = InformasiKesehatan::find($id);
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

    public function deleteinformasikesehatan($id)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $delete = InformasiKesehatan::findOrFail($id);
        unlink(public_path() . $delete->informasi_kesehatan_foto);
        $delete->delete();
        return response()->json([
            'code' => 200,
            'message' => 'Data informasi kesehatan berhasil dihapus',
            'status' => 0,
            'data' => $delete
        ], 200);
    }

    public function getdetailinformasikesehatan($id)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $data = InformasiKesehatan::with(['user'])->find($id);
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

