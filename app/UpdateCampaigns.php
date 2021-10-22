<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UpdateCampaigns extends Model
{
    protected $table = 'update_campaigns';
    protected $primaryKey = 'id_updatecampaigns';

    protected $fillable = [
        'id_campaigns','id','title_update','description_update'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'id');
    }
}
