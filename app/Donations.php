<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donations extends Model
{
    protected $table = 'donations';
    protected $primaryKey = 'id_donations';

    protected $fillable = [
        'id_campaigns','id','payment_method','amount_of_donation','support_description','unique_number','donations_is_deleted','donations_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'id');
    }
}
