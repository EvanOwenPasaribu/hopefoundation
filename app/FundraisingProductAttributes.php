<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FundraisingProductAttributes extends Model
{
    protected $table = 'fundraising_product_attributes';
    protected $primaryKey = 'id_fundraisingproductattributes';

    protected $fillable = [
        'id_fundraisingproduct','product_price_netto','product_price_gross','disc_pecentage','product_weight','stock','min_order','attribute_string','attribute_string_value','fundraising_product_attributes_is_deleted'
    ];

}
