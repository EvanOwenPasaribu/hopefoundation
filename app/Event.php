<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'event';
    protected $primaryKey = 'id_event';

    protected $fillable = [
        'id','event_title','event_short_description','event_description','event_foto','event_is_deleted'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'id');
    }

}
