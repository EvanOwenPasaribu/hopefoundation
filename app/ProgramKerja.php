<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramKerja extends Model
{
    protected $table = 'program_kerja';
    protected $primaryKey = 'id_programkerja';

    protected $fillable = [
        'id_programkerjacategory','id','program_kerja_title','program_kerja_short_description','program_kerja_description','program_kerja_foto','program_kerja_foto_name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'id');
    }

    public function programkerjacategory()
    {
        return $this->belongsTo(ProgramKerjaCategory::class,'id_programkerjacategory');
    }
}

