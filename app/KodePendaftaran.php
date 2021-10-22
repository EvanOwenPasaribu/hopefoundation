<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KodePendaftaran extends Model
{
    protected $table = 'kodependaftaran';
    protected $primaryKey = 'id_kodependaftaran';

    protected $fillable = [
        'kode','is_use'
    ];
}
