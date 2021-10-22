<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table = 'dokter';
    protected $primaryKey = 'id_dokter';

    protected $fillable = [
        'id_rumahsakit','namadokter','spesialist','jadwalpraktek'
    ];

    public function rumahsakit()
    {
        return $this->belongsTo(RumahSakit::class,'id_rumahsakit');
    }

}
