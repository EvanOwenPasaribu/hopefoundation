<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pendonor extends Model
{
    protected $table = 'pendonor';
    protected $primaryKey = 'id_pendonor';

    protected $fillable = [
        'id_pendonor','namapendonor','golongandarah','nomorhandphone1','nomorhandphone2','nomorhandphone3','alamatpendonor'
    ];

    public function rumahsakit()
    {
        return $this->belongsTo(RumahSakit::class,'id_rumahsakit');
    }

}
