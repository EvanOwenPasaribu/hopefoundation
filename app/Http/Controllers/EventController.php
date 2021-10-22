<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Http\Requests\EditEventRequest;
use App\Event;
use JWTAuth;
use Illuminate\Http\Request;

class EventController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->middleware('jwt',['except'=>['index','getdetaileventpengunjung']]);
    }
   
    public function index(Request $request)
    {
        if($request->get('keywords')=="")
            $data = Event::orderby('id_event','DESC')->paginate(8);
        else
            $data = Event::where('event_title','LIKE', '%'.$request->get('keywords').'%')->orWhere('event_short_description','LIKE', '%'.$request->get('keywords').'%')->orderby('id_event','DESC')->paginate(8);
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

    public function getdetaileventpengunjung($id)
    {
        $data = Event::with(['user'])->find($id);
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
        $data = Event::with(['user'])->orderby('id_event','DESC')->get();
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

    public function eventuploadimage(Request $request)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $tujuan_upload = 'images/event/descriptionimage';
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

    public function addevent(EventRequest $request)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $save = new Event();
        $save->id = $this->user->id;
        $save->event_title = $request->get('event_title');
        $save->event_short_description = $request->get('event_short_description');
        $save->event_description = $request->get('event_description');
        $tujuan_upload = 'images/event';
        $namafile = $this->user->id . date('Ymdhis') . '.jpg';
        $request->file('event_foto')->move($tujuan_upload,$namafile);
        $save->event_foto = '/' . $tujuan_upload . '/' . $namafile;
        $save->save();
        return response()->json([
            'code' => 200,
            'message' => 'Data kegiatan berhasil ditambahkan',
            'status' => 0,
            'data' => $save
        ], 200);
    }

    public function editevent(EditEventRequest $request,$id)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $save = Event::find($id);
        $save->event_title = $request->get('event_title');
        $save->event_short_description = $request->get('event_short_description');
        $save->event_description = $request->get('event_description');
        $tujuan_upload = 'images/event';
        if($request->hasFile('event_foto'))
            $request->file('event_foto')->move($tujuan_upload,$save->event_foto);
        $save->save();
        return response()->json([
            'code' => 200,
            'message' => 'Data event berhasil diubah',
            'status' => 0,
            'data' => $save
        ], 200);
    }

    public function geteditevent($id)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $data = Event::find($id);
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

    public function deleteevent($id)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $delete = Event::findOrFail($id);
        unlink(public_path() . $delete->event_foto);
        $delete->delete();
        return response()->json([
            'code' => 200,
            'message' => 'Data kegiatan berhasil dihapus',
            'status' => 0,
            'data' => $delete
        ], 200);
    }

    public function getdetailevent($id)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $data = Event::with(['user'])->find($id);
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
