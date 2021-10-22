<?php

namespace App\Http\Controllers;

use App\Http\Requests\IsiSaldoRequest;
use App\TransactionBalance;
use App\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Mail;
use App\Mail\IsiSaldoEmail;
use Auth;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function isisaldo(IsiSaldoRequest $request)
    {
        $isisaldo = new TransactionBalance();
        $isisaldo->id = $this->user->id;
        $isisaldo->id_paymentmethoddetail = $request->paymentmethod;
        $kode = date('YmdHis') + $this->user->id;
        $isisaldo->transaction_code = 'KT' . $kode;
        $isisaldo->saldosebelumnya = $this->user->balance;
        $isisaldo->nominaltransaction = $request->jumlahtopup;
        $isisaldo->kodeunik = rand(111,999);
        $isisaldo->debit = $request->jumlahtopup;
        $isisaldo->kredit = "0";
        $isisaldo->saldosesudahnya = "0";
        $isisaldo->keterangantransaksi = "Pengisian Saldo Elektronik";
        $isisaldo->transaction_balance_status = "0";
        $isisaldo->save();

        Mail::to($this->user->email)->send(new IsiSaldoEmail($isisaldo));
        if (Mail::failures()) {
            return response()->json([
                'code' => 401,
                'message'=> 'Email Tidak Berhasil Dikirimkan',
                'status' => 0,
                'data' => $user
            ], 401);
        }else{
            return response()->json([
                'code' => 200,
                'message' => 'Terima Kasih, Permintaan Isi Saldo Anda Akan Diverifikasi Oleh Admin',
                'status' => 0,
                'data' => $isisaldo
            ], 200);
        }
    }

    public function instruksipembayaran($id_transactionbalance)
    {
        $data = TransactionBalance::with(['paymentmethoddetails'])->find($id_transactionbalance);
        if($data == "")
        {
            return response()->json([
                'code' => 401,
                'message' => 'Data masih kosong',
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

    public function adminindex()
    {
        $data = TransactionBalance::with(['paymentmethoddetails'])->where('transaction_balance_status','=','0')->orderby('id_transactionbalance','DESC')->get();
        if(count($data)==0)
        {
            return response()->json([
                'code' => 401,
                'message' => 'Data masih kosong',
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

    public function terimaisisaldo($id_transactionbalance)
    {
        $transactionbalance = TransactionBalance::find($id_transactionbalance);
        if($transactionbalance->transaction_balance_status == "0")
        {
            $usersave = User::find($transactionbalance->id);
            $transactionbalance->transaction_balance_status = "1";
            $transactionbalance->saldosebelumnya = $usersave->balance;
            $transactionbalance->saldosesudahnya = $usersave->balance + $transactionbalance->nominaltransaction + $transactionbalance->kodeunik;
            $transactionbalance->save();
            $usersave->balance += $transactionbalance->nominaltransaction + $transactionbalance->kodeunik;
            $usersave->save();
            return response()->json([
                'code' => 200,
                'message' => 'Verifikasi Penerimaan Isi Saldo Berhasil Dilakukan',
                'status' => 0,
                'data' => $transactionbalance
            ], 200);
        }
        else
        {
            return response()->json([
                'code' => 401,
                'message'=> 'Verifikasi Sudah Pernah Dilakukan Sebelumnya',
                'status' => 0,
                'data' => $transactionbalance
            ], 401);
        }
      

    }

    public function tolakisisaldo($id_transactionbalance)
    {
        $transactionbalance = TransactionBalance::find($id_transactionbalance);
        if($transactionbalance->transaction_balance_status == "0")
        {
            $usersave = User::find($transactionbalance->id);
            $transactionbalance->transaction_balance_status = "2";
            $transactionbalance->saldosebelumnya = $usersave->balance;
            $transactionbalance->saldosesudahnya = $usersave->balance;
            $transactionbalance->save();

            return response()->json([
                'code' => 200,
                'message' => 'Verifikasi Penolakan Isi Saldo Berhasil Dilakukan',
                'status' => 0,
                'data' => $transactionbalance
            ], 200);
        }
        else
        {
            return response()->json([
                'code' => 401,
                'message'=> 'Verifikasi Sudah Pernah Dilakukan Sebelumnya',
                'status' => 0,
                'data' => $transactionbalance
            ], 401);
        }
    }

}

