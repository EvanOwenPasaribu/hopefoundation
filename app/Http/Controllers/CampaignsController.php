<?php

namespace App\Http\Controllers;

use App\Http\Requests\CampaignsRequest;
use App\Campaigns;
use App\Donations;
use App\UpdateCampaigns;
use Illuminate\Http\Request;
use JWTAuth;

class CampaignsController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->middleware('jwt',['except'=>['show','frontImportantCampaign','search']]);
    }

    public function index()
    {
        
    }

    public function show($raising_link)
    {
        $id_campaigns = Campaigns::where('raising_link','=',$raising_link)->first();
        if($id_campaigns)
        {
            $campaigns = Campaigns::with(['user','category'])->find($id_campaigns->id_campaigns);
            $donations = Donations::with(['user'])->where("id_campaigns",'=',$id_campaigns->id_campaigns)->where('donations_status','=','1')->get();
            $updatecampaigns = UpdateCampaigns::with(['user'])->where("id_campaigns",'=',$id_campaigns->id_campaigns)->get();
            $campaigns->donations = $donations;
            $campaigns->totaldonations = count($campaigns->donations);
            $campaigns->updatecampaigns = $updatecampaigns;
            return response()->json([
                'code' => 200,
                'message' => '',
                'status' => 0,
                'data' => $campaigns
            ], 200);
        }
        else
        {
            return response()->json([
                'code' => 401,
                'message' => 'Campaigns tidak ditemukan',
                'status' => 0,
                'data' => (object) array()
            ], 401);
        }
        
    }

    public function store(CampaignsRequest $request)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $lastidcampaign = Campaigns::orderby('id_campaigns','DESC')->first();
        if($lastidcampaign)
        {
            $id = $lastidcampaign->id + 1;
        }
        else
        {
            $id = 0;
        }
        $save = new Campaigns();
        $save->id = $this->user->id;
        $save->id_category = $request->get('kategori');
        $save->campaigns_title = $request->get('judul');
        $save->campaigns_description = $request->get('isicampaign');
        $save->short_invitation = $request->get('ajakansingkat');
        $save->target_funds = $request->get('target');
        $save->funds_collected = 0;
        $batastanggal = strtotime($request->get('batastanggal'));
        $newformat = date('Y-m-d h:i:s',$batastanggal);
        $save->raising_deadline = $newformat;
        $save->raising_link = $request->get('link');
        $tujuan_upload = 'images/campaigns/' . $this->user->id . '/' . $id;
        $namafile = $this->user->id . date('Ymdhis') . '.jpg';
        $request->file('foto')->move($tujuan_upload,$namafile);
        $save->campaigns_foto = '/' . $tujuan_upload . '/' . $namafile;
        $save->fundraiser_phone_number = $request->get('nomorhp');
        $save->purpose_of_raising = $request->get('keperluan');
        $save->campaigns_total_views = 0;
        $save->is_important = 'N';
        $save->campaigns_is_deleted = 'N';
        if($this->user->users_status == 0)
            $save->campaigns_verification = '2';
        else
            $save->campaigns_verification = '0';
        $save->campaigns_status = '0';
        $save->save();
        return response()->json([
            'code' => 200,
            'message' => 'Penggalangan dana berhasil dilakukan, tim admin akan melakukan verifikasi terhadap informasi anda',
            'status' => 0,
            'data' => $save
        ], 200);
       
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
        
    }

    public function frontImportantCampaign()
    {
        $data = Campaigns::with(['user','category'])->where('is_important','=','Y')->where('campaigns_is_deleted','=','N')->where('campaigns_verification','=','2')->where('campaigns_status','=','0')->get();
        if(count($data) == 0)
        {
            return response()->json([
                'code' => 401,
                'message' => 'Campaigns tidak ditemukan',
                'status' => 0,
                'data' => $data
            ], 401);
        }
        else
        {
            for($i=0;$i<count($data);$i++)
            {
                if($i == 0)
                    $data[$i]->active = "active";
                else
                    $data[$i]->active = "";
            }
            return response()->json([
                'code' => 200,
                'message' => '',
                'status' => 0,
                'data' => $data
            ], 200);
        }
    }

    public function search(Request $request)
    {
        if($request->get('kategori')=='0' && $request->get('keywords')=="")
            $data = Campaigns::with(['user','category'])->where('campaigns_is_deleted','=','N')->where('campaigns_verification','=','2')->where('campaigns_status','=','0')->paginate(6);
        else if($request->get('kategori')!='0' && $request->get('keywords')!="")  
            $data = Campaigns::with(['user','category'])->where('campaigns_is_deleted','=','N')->where('campaigns_verification','=','2')->where('campaigns_status','=','0')->where('id_category','=',$request->get('kategori'))->where('campaigns_title','LIKE', '%'.$request->get('keywords').'%')->paginate(6);
        else if($request->get('kategori')!='0' && $request->get('keywords')=="")
            $data = Campaigns::with(['user','category'])->where('campaigns_is_deleted','=','N')->where('campaigns_verification','=','2')->where('campaigns_status','=','0')->where('id_category','=',$request->get('kategori'))->paginate(6);
        else if($request->get('kategori')=='0' && $request->get('keywords')!="")
            $data = Campaigns::with(['user','category'])->where('campaigns_is_deleted','=','N')->where('campaigns_verification','=','2')->where('campaigns_status','=','0')->where('campaigns_title','LIKE', '%'.$request->get('keywords').'%')->paginate(6);

        if(count($data) == 0)
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

    public function adminindex()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $data = Campaigns::with(['user','category','donations'])->where('campaigns_is_deleted','=','N')->where('campaigns_verification','=','2')->where('campaigns_status','=','0')->orderby('id_campaigns','DESC')->get();
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

    public function campaignuploadimage(Request $request)
    {
        $lastidcampaign = Campaigns::orderby('id_campaigns','DESC')->first()->id + 1;
        $this->user = JWTAuth::parseToken()->authenticate();
        $tujuan_upload = 'images/campaigns/' . $this->user->id . '/' . $lastidcampaign . '/descriptionimage';
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

    public function deletecampaigns($id)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $delete = Campaigns::findOrFail($id);
        unlink(public_path() . $delete->campaigns_foto);
        $delete->delete();
        return response()->json([
            'code' => 200,
            'message' => 'Data penggalangan berhasil dihapus',
            'status' => 0,
            'data' => $delete
        ], 200);
    }
}

