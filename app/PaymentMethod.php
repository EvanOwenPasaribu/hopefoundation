<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = 'payment_method';
    protected $primaryKey = 'id_paymentmethod';

    protected $fillable = [
        'payment_code','method_name','description_payment','is_active','is_default'
    ];
    
    public function paymentmethoddetails()
    {
        return $this->hasMany(PaymentMethodDetails::class,'id_paymentmethod');
    }

}
