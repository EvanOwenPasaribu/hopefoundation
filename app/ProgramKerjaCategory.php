<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramKerjaCategory extends Model
{
    protected $table = 'program_kerja_category';
    protected $primaryKey = 'id_programkerjacategory';

    protected $fillable = [
        'program_kerja_category_description','program_kerja_url'
    ];
}
