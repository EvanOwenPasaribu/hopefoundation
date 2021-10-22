<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vaksinasi extends Model
{
    protected $table = 'vaksinasi';
    protected $primaryKey = 'id_vaksinasi';

    protected $fillable = [
       'id_kota','emailvaksin','namalengkap','nik','ktp_foto','jenis_kelamin','kotakelahiran','tanggallahir','alamat','nomorhpvaksin','nomorwavaksin','golongan_darah','rhesus_darah','kodependaftaran','tanggalvaksinpertama','waktuvaksinpertama','tanggalvaksinkedua','waktuvaksinkedua'
    ];
}
