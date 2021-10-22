<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    protected $table = 'kotavaksinasi';
    protected $primaryKey = 'id_kota';

    protected $fillable = [
        'namakota','tanggalvaksin','is_active'
    ];
}
