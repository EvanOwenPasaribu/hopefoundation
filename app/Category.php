<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'id_category';

    protected $fillable = [
        'category_description','category_is_deleted'
    ];

    public function campaigns()
    {
        return $this->hasOne(Campaigns::class,'id_campaigns');
    }
}
