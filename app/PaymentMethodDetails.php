<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethodDetails extends Model
{
    protected $table = 'payment_method_detail';
    protected $primaryKey = 'id_paymentmethoddetail';

    protected $fillable = [
        'id_paymentmethod','method_detail_name','description_payment_detail','payment_detail_logo','atas_nama'
    ];

    public function paymentmethod()
    {
        return $this->belongsToMany(PaymentMethod::class,'id_paymentmethod');
    }
}
