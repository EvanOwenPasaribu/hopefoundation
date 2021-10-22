<?php

namespace App\Http\Controllers;

use App\PaymentMethod;
use App\PaymentMethodDetails;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function __construct()
    {
        
    }

    public function index(Request $request)
    {
        $data = PaymentMethod::with(['paymentmethoddetails'])->where('payment_code','!=',$request->get('payment_code'))->get();
        if(count($data) == 0)
        {
            return response()->json([
                'code' => 401,
                'message' => 'Payment method tidak ditemukan',
                'status' => 0,
                'data' => $data
            ], 401);
        }
        else
        {
            return response()->json([
                'code' => 200,
                'message' => '',
                'status' => 0,
                'data' => $data
            ], 200);
        }
    }
}
