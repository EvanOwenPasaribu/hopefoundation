<?php

namespace App\Imports;

use App\Vaksinasi;
use App\HariLibur;
use App\Kota;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithStartRow;

class VaksinasiImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $ceknik = Vaksinasi::where('nik','=',$row[2])->count();
        if($ceknik == 0)
        {
            $request = request()->all();
            $kota = Kota::find($request['pilihan_kota']);
            $id_kota = $request['pilihan_kota'];
            $emailvaksin = $row[9];
            $namalengkap = $row[1];
            $nik = $row[2];
            $ktp_foto = "";
            $jenis_kelamin = $row[3];
            $kotakelahiran = $row[4];
            $unixDate = ($row[5] - 25569) * 86400;
            $tanggallahir = gmdate("Y-m-d", $unixDate);
            $alamat = $row[6];
            if($row[7]!="")
                $nomorhpvaksin = "0" . $row[7];
            else
                $nomorhpvaksin = $row[7];
            if($row[8]!="")
                $nomorwavaksin = "0" . $row[8];
            else
                $nomorwavaksin = $row[8];
         
            if($id_kota == '1')
                $seconds = 14;
            else
                $seconds = 19;
            $cekfirstdata = Vaksinasi::where('id_kota','=',$id_kota)->count();
            if($cekfirstdata == 0)
                $tanggalvaksinpertama = date('Y-m-d H:i:s', strtotime($kota->tanggalvaksin . " 09:00:00"));
            else
            {
                $lasttime = Vaksinasi::where('id_kota','=',$id_kota)->orderby('id_vaksinasi','DESC')->first();
                if($id_kota == '1')
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
            $tanggalvaksinpertamalast = substr($tanggalvaksinpertama,0,10);
            $waktuvaksinpertamalast = substr($tanggalvaksinpertama,10,9);
            $tanggalvaksinkedualast = substr($tanggalvaksinkedua,0,10);
            $waktuvaksinkedualast = substr($tanggalvaksinkedua,10,9);
                        
            return new Vaksinasi([
                'id_kota' => $id_kota,
                'emailvaksin' => $emailvaksin,
                'namalengkap' => $namalengkap,
                'nik' => $nik,
                'ktp_foto' => $ktp_foto,
                'jenis_kelamin' => $jenis_kelamin,
                'kotakelahiran' => $kotakelahiran,
                'tanggallahir' => $tanggallahir,
                'alamat' => $alamat,
                'nomorhpvaksin' => $nomorhpvaksin,
                'nomorwavaksin' => $nomorwavaksin,
                'tanggalvaksinpertama' => $tanggalvaksinpertamalast,
                'waktuvaksinpertama' => $waktuvaksinpertamalast,
                'tanggalvaksinkedua' => $tanggalvaksinkedualast,
                'waktuvaksinkedua' => $waktuvaksinkedualast
            ]);
        }
        
    }

    public function startRow(): int
    {
        return 2;
    }
}
