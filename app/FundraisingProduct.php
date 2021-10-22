<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FundraisingProduct extends Model
{
    protected $table = 'fundraising_product';
    protected $primaryKey = 'id_fundraisingproduct';

    protected $fillable = [
        'product_name','description_product','is_active','fundraising_product_is_deleted'
    ];

    public function fundraisingproductattributes()
    {
        return $this->hasMany(FundraisingProductAttributes::class,'id_fundraisingproduct')->orderBy('is_default','DESC');
    }

    public function fundraisingproductimages()
    {
        return $this->hasMany(FundraisingProductImages::class,'id_fundraisingproduct')->orderBy('is_default','DESC');
    }
}
