<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VaksinasiTemp extends Model
{
    protected $table = 'vaksinasitemp';
    protected $primaryKey = 'id_vaksinasi';

    protected $fillable = [
       'id_kota','namalengkap','nik','ktp_foto','jenis_kelamin','kotakelahiran','tanggallahir','alamat','nomorhpvaksin','nomorwavaksin','golongan_darah','rhesus_darah'
    ];
}
