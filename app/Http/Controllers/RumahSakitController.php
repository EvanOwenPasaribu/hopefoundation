<?php

namespace App\Http\Controllers;

use App\Http\Requests\RumahSakitRequest;
use App\Http\Requests\EditRumahSakitRequest;
use App\RumahSakit;
use App\Dokter;
use JWTAuth;
use Illuminate\Http\Request;

class RumahSakitController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->middleware('jwt',['except'=>['index','getdetailrumahsakitpengunjung']]);
    }

    public function index(Request $request)
    {
		function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6378137)
		{
			$latFrom = deg2rad($latitudeFrom);
			$lonFrom = deg2rad($longitudeFrom);
			$latTo = deg2rad($latitudeTo);
			$lonTo = deg2rad($longitudeTo);
			$latDelta = $latTo - $latFrom;
			$lonDelta = $lonTo - $lonFrom;
			$angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
			return $angle * $earthRadius;
		}
		$lat = $request->get('latitude');
		$lng = $request->get('longitude');
        $radiusnya = array();
        $rumahsakit = RumahSakit::where('rumah_sakit_is_deleted','=','N')->orderby('id_rumahsakit','DESC')->get();
		foreach($rumahsakit as $rs)
		{
            $radiusnya = haversineGreatCircleDistance($lat,$lng,$rs->latituders,$rs->longituders);
            $rs->radius = $radiusnya/1000;
		}
        $rumahsakit->sortBy('radius');
        
        if(count($rumahsakit)==0)
        {
            return response()->json([
                'code' => 401,
                'message' => 'Hasil pencarian tidak ditemukan',
                'status' => 0,
                'data' => $rumahsakit
            ], 401);
        }
        else
        {
            return response()->json([
                'code' => 200,
                'message' => '',
                'status' => 0,
                'data' => $rumahsakit
            ], 200);
        }
    }

    public function getdetailrumahsakitpengunjung($id)
    {
        $data = RumahSakit::find($id);
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
        $data = RumahSakit::where('rumah_sakit_is_deleted','=','N')->orderby('id_rumahsakit','DESC')->get();
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

    public function addrumahsakit(RumahSakitRequest $request)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $save = new RumahSakit();
        $save->namarumahsakit = $request->get('namarumahsakit');
        $save->alamatrumahsakit = $request->get('alamatrumahsakit');
        $save->latituders = $request->get('latituders');
        $save->longituders = $request->get('longituders');
        if($request->hasFile('rumah_sakit_foto'))
        {
            $tujuan_upload = 'images/rumahsakit';
            $namafile = $this->user->id . date('Ymdhis') . '.jpg';
            $request->file('rumah_sakit_foto')->move($tujuan_upload,$namafile);
            $save->rumah_sakit_foto = '/' . $tujuan_upload . '/' . $namafile;
        }
        else
            $save->rumah_sakit_foto = "";
        $save->rumah_sakit_is_deleted = 'N';
        $save->save();
        return response()->json([
            'code' => 200,
            'message' => 'Data rumah sakit berhasil ditambahkan',
            'status' => 0,
            'data' => $save
        ], 200);
    }

    public function editrumahsakit(EditRumahSakitRequest $request,$id)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $save = RumahSakit::find($id);
        $save->namarumahsakit = $request->get('namarumahsakit');
        $save->alamatrumahsakit = $request->get('alamatrumahsakit');
        $save->latituders = $request->get('latituders');
        $save->longituders = $request->get('longituders');
        $tujuan_upload = 'images/rumahsakit';
        if($request->hasFile('rumah_sakit_foto'))
            $request->file('rumah_sakit_foto')->move($tujuan_upload,$save->rumah_sakit_foto);
        $save->save();
        return response()->json([
            'code' => 200,
            'message' => 'Data rumah sakit berhasil diubah',
            'status' => 0,
            'data' => $save
        ], 200);
    }

    public function geteditrumahsakit($id)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $data = RumahSakit::find($id);
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

    public function deleterumahsakit($id)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $delete = RumahSakit::findOrFail($id);
        if($delete->rumah_sakit_foto != "")
            unlink(public_path() . $delete->rumah_sakit_foto);
        $delete->delete();
        return response()->json([
            'code' => 200,
            'message' => 'Data rumah sakit berhasil dihapus',
            'status' => 0,
            'data' => $delete
        ], 200);
    }

    public function getdetailrumahsakit($id)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $data = RumahSakit::find($id);
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

