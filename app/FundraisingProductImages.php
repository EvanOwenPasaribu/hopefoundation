<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FundraisingProductImages extends Model
{
    protected $table = 'fundraising_product_images';
    protected $primaryKey = 'id_fundraisingproductimages';

    protected $fillable = [
        'id_fundraisingproduct','fundraising_product_images','fundraising_product_images_thumbs','is_default','fundraising_product_images_is_deleted'
    ];

}
