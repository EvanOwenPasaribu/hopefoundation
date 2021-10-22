<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InformasiKesehatan extends Model
{
    protected $table = 'informasi_kesehatan';
    protected $primaryKey = 'id_informasikesehatan';

    protected $fillable = [
        'id','informasi_kesehatan_title','informasi_kesehatan_short_description','informasi_kesehatan_description','informasi_kesehatan_foto','informasi_kesehatan_is_deleted'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'id');
    }

}
