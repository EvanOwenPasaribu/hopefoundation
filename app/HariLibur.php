<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HariLibur extends Model
{
    protected $table = 'harilibur';
    protected $primaryKey = 'id_harilibur';

    protected $fillable = [
        'tanggalibur'
    ];
}
