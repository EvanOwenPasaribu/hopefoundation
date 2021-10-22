<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaigns extends Model
{
    protected $table = 'campaigns';
    protected $primaryKey = 'id_campaigns';

    protected $fillable = [
        'id_fundraiser','id_category','campaigns_title','campaigns_description','target_funds','funds_collected','rasing_deadline','raising_link','campaigns_photo','fundraiser_phone_number','purpose_of_raising','campaigns_total_views','is_important','campaigns_is_deleted','campaigns_verification','campaigns_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'id');
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class,'id_category');
    }

    public function donations()
    {
        return $this->hasMany(Donations::class,'id_campaigns');
    }

}
