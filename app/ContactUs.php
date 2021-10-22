<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $table = 'contact_us';
    protected $primaryKey = 'id_contactus';

    protected $fillable = ['email','name','pesan'];
}
