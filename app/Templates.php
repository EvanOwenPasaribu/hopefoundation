<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Templates extends Model
{
    protected $table = 'templates';
    protected $primaryKey = 'id_templates';

    protected $fillable = [
        'app_name','front_picture','profile_description','caption_front_picture','caption_description_front_picture','button_description_front_picture','about_us_description_footer','address_footer','number_phone_footer','email_footer','twitter','facebook','instagram','facebook_page'
    ];
}
