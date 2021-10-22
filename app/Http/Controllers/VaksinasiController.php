<?php

namespace App\Http\Controllers;

use App\Http\Requests\VaksinasiRequest;
use App\Http\Requests\CekTanggalVaksinRequest;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Mail;
use App\Vaksinasi;
use App\VaksinasiTemp;
use App\Templates;
use App\HariLibur;
use App\KodePendaftaran;
use App\Kota;
use Illuminate\Http\Request;
use DateTime;
use Carbon\Carbon;

class VaksinasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt',['except'=>['postVaksinasi','postCekTanggalVaksin']]);
    }

    public function postVaksinasi(VaksinasiRequest $request)
    {
        /*if($request->get('kodependaftaran') != "")
        {
            $cekkodeada = KodePendaftaran::where('kode','=',$request->kodependaftaran)->count();
            if($cekkodeada == 0)
            {
                return response()->json([
                    'code' => 401,
                    'message' => 'Kode pendaftaran tidak ditemukan, silahkan hubungi Admin',
                    'status' => 0,
                    'errors' => (object) array()
                ], 401);
            }
            else
            {
                $cekkodesudahdigunakan = KodePendaftaran::where('kode','=',$request->kodependaftaran)->where('is_use','=','Y')->count();
                if($cekkodesudahdigunakan > 0)
                {
                    return response()->json([
                        'code' => 401,
                        'message' => 'Kode pendaftaran sudah pernah digunakan, silahkan hubungi Admin',
                        'status' => 0,
                        'errors' => (object) array()
                    ], 401);
                }
                else
                {
                    //$save = new Vaksinasi();
                    //$kota = Kota::find($request->get('pilihan_kota'));
                    //$seconds = 6832;
                    //echo date('Y-m-d H:i:s', strtotime($kota->tanggalvaksin . " 09:00 + " . $seconds . " seconds"));
                    
                    $save = new Vaksinasi();
                    $kota = Kota::find($request->get('pilihan_kota'));
                    $kodependaftaran = KodePendaftaran::where('kode','=',$request->get('kodependaftaran'))->first();
                    $save->id_kota = $request->get('pilihan_kota');
                    $save->emailvaksin = $request->get('email');
                    $save->namalengkap = $request->get('namalengkap');
                    $save->nik = $request->get('nik');
                    $tujuan_upload = 'images/fotoktpvaksin';
                    $namafile = 'fotoktp' . $request->get('nik') . '.jpg';
                    $request->file('ktp_foto')->move($tujuan_upload,$namafile);
                    $save->ktp_foto = '/' . $tujuan_upload . '/' . $namafile;
                    $save->jenis_kelamin = $request->get('jenis_kelamin');
                    $save->kotakelahiran = $request->get('kotakelahiran');
                    $save->tanggallahir = $request->get('tanggallahir');
                    $save->alamat = $request->get('alamat');
                    $save->nomorhpvaksin = $request->get('nomorhpvaksin');
                    $save->nomorwavaksin = $request->get('nomorwavaksin');
                    $save->golongan_darah = $request->get('golongan_darah');
                    $save->rhesus_darah = $request->get('rhesus_darah');
                    $save->kodependaftaran = $request->get('kodependaftaran');
                    if($request->get('pilihan_kota') == '1')
                        $seconds = 14;
                    else
                        $seconds = 19;
                    $cekfirstdata = Vaksinasi::where('id_kota','=',$request->get('pilihan_kota'))->count();
                    if($cekfirstdata == 0)
                        $tanggalvaksinpertama = date('Y-m-d H:i:s', strtotime($kota->tanggalvaksin . " 09:00:00"));
                    else
                    {
                        $lasttime = Vaksinasi::where('id_kota','=',$request->get('pilihan_kota'))->orderby('id_vaksinasi','DESC')->first();
                        if($request->get('pilihan_kota') == '1')
                        {
                            if($lasttime->waktuvaksinpertama == "16:46:40")
                            {
                                $tanggalvaksinpertama = date('Y-m-d H:i:s', strtotime($lasttime->tanggalvaksinpertama . " 09:00:00 + 1 days"));
                                $cekv1 = false;
                                while (!$cekv1){
                                    $cekharilibur = HariLibur::where('tanggallibur','=',substr($tanggalvaksinpertama,0,10))->count();
                                    if($cekharilibur > 0)
                                        $tanggalvaksinpertama = date('Y-m-d H:i:s', strtotime($tanggalvaksinpertama. ' + 1 days'));
                                    else
                                        $cekv1 = true;
                                };
                            }
                            else
                            {
                                $tanggalvaksinpertama = date('Y-m-d H:i:s', strtotime($lasttime->tanggalvaksinpertama . " " . $lasttime->waktuvaksinpertama . " + " . $seconds . " seconds"));
                            }
                        }
                        else
                        {
                            if($lasttime->waktuvaksinpertama == "16:55:00")
                            {
                                $tanggalvaksinpertama = date('Y-m-d H:i:s', strtotime($lasttime->tanggalvaksinpertama . " 09:00:00 + 1 days"));
                                $cekv1 = false;
                                while (!$cekv1){
                                    $cekharilibur = HariLibur::where('tanggallibur','=',substr($tanggalvaksinpertama,0,10))->count();
                                    if($cekharilibur > 0)
                                        $tanggalvaksinpertama = date('Y-m-d H:i:s', strtotime($tanggalvaksinpertama. ' + 1 days'));
                                    else
                                        $cekv1 = true;
                                };
                            }
                            else
                            {
                                $tanggalvaksinpertama = date('Y-m-d H:i:s', strtotime($lasttime->tanggalvaksinpertama . " " . $lasttime->waktuvaksinpertama . " + " . $seconds . " seconds"));
                            }
                        }
                        
                        
                        
                    }
                    $tanggalvaksinkedua = date('Y-m-d H:i:s', strtotime($tanggalvaksinpertama. ' + 28 days'));
                    $cekv2 = false;
                    while (!$cekv2){
                        $cekharilibur = HariLibur::where('tanggallibur','=',substr($tanggalvaksinkedua,0,10))->count();
                        if($cekharilibur > 0)
                            $tanggalvaksinkedua = date('Y-m-d H:i:s', strtotime($tanggalvaksinkedua. ' + 1 days'));
                        else
                            $cekv2 = true;
                    };
                    $save->tanggalvaksinpertama = substr($tanggalvaksinpertama,0,10);
                    $save->waktuvaksinpertama = substr($tanggalvaksinpertama,10,9);
                    $save->tanggalvaksinkedua = substr($tanggalvaksinkedua,0,10);
                    $save->waktuvaksinkedua = substr($tanggalvaksinkedua,10,9);
                    $save->save();
                    $kodependaftaran->is_use = "Y";
                    $kodependaftaran->save();
                    return response()->json([
                        'code' => 200,
                        'message' => 'Pendaftaran vaksinasi berhasil dilakukan, silahkan cek tanggal vaksin pertama dan kedua di halaman Cek Tanggal Vaksin',
                        'status' => 0,
                        'data' => (object) array()
                    ], 200);
                }
            }
        }
        else
        {
            $save = new VaksinasiTemp();
            $kota = Kota::find($request->get('pilihan_kota'));
            $kodependaftaran = KodePendaftaran::where('kode','=',$request->get('kodependaftaran'))->first();
            $save->id_kota = $request->get('pilihan_kota');
            $save->emailvaksin = $request->get('email');
            $save->namalengkap = $request->get('namalengkap');
            $save->nik = $request->get('nik');
            $tujuan_upload = 'images/fotoktpvaksin';
            $namafile = 'fotoktp' . $request->get('nik') . '.jpg';
            $request->file('ktp_foto')->move($tujuan_upload,$namafile);
            $save->ktp_foto = '/' . $tujuan_upload . '/' . $namafile;
            $save->jenis_kelamin = $request->get('jenis_kelamin');
            $save->kotakelahiran = $request->get('kotakelahiran');
            $save->tanggallahir = $request->get('tanggallahir');
            $save->alamat = $request->get('alamat');
            $save->nomorhpvaksin = $request->get('nomorhpvaksin');
            $save->nomorwavaksin = $request->get('nomorwavaksin');
            $save->golongan_darah = $request->get('golongan_darah');
            $save->rhesus_darah = $request->get('rhesus_darah');
            $save->save();
            $tanggalduahari = date('d F Y', strtotime(date('Y-m-d'). ' + 2 days'));
            return response()->json([
                'code' => 200,
                'message' => 'Terima Kasih sudah mendaftar. Kami akan mengabarkan Jadwal Vaksin nya melalui Whatsapp. Jika ada yang mau ditanyakan, silahkan hubungi Call Centre Yayasan HOPE: 0852 1143 3338',
                'status' => 0,
                'data' => (object) array()
            ], 200);

            //Pendaftaran vaksinasi berhasil dilakukan, silahkan cek kembali jadwa vaksin pada tanggal ' . $tanggalduahari,
        }*/
        return response()->json([
            'code' => 401,
            'message' => 'Maaf, Pendaftaran sudah ditutup. Terakhir Vaksinasi HOPE di Lapangan Ex Polonia adalah sampai Rabu, 07 Juli 2021, Pkl 13.00 Wib. Untuk Informasi lebih jelas, silahkan hubungi Call Centre : 0812 3333 9859',
            'status' => 0,
            'errors' => (object) array()
        ], 401);
    }

    public function postCekTanggalVaksin(CekTanggalVaksinRequest $request)
    {
        $data = Vaksinasi::where('nik','=',$request->get('nik'))->get();
        if($data->count() == 0)
        {
            return response()->json([
                'code' => 401,
                'message' => 'Data tidak ditemukan berarti belum terdaftar / kuota vaksin sudah full',
                'status' => 0,
                'data' => $data
            ], 401);
        }
        else
        {
            $data2 = Vaksinasi::find($data->first()->id_vaksinasi);
            return response()->json([
                'code' => 200,
                'message' => '',
                'status' => 0,
                'data' => $data2
            ], 200);
        }
    }

}
