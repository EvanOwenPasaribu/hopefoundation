<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RumahSakit extends Model
{
    protected $table = 'rumahsakit';
    protected $primaryKey = 'id_rumahsakit';

    protected $fillable = [
        'namarumahsakit','alamatrumahsakit','latituders','longituders','rumah_sakit_is_deleted'
    ];

}
