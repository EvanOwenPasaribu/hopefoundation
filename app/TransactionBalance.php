<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionBalance extends Model
{
    protected $table = 'transaction_balance';
    protected $primaryKey = 'id_transactionbalance';

    protected $fillable = [
        'id','id_paymentmethoddetail','transaction_code','saldosebelumnya','nominaltransaction','kodeunik','debit','kredit','saldosebelumnya','saldosesudahnya','keterangantransaksi','transaction_balance_status'
    ];

    public function paymentmethoddetails()
    {
        return $this->belongsTo(PaymentMethodDetails::class,'id_paymentmethoddetail');
    }
}
