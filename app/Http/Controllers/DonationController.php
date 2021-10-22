<?php
 
namespace App\Http\Controllers;

use App\Http\Requests\DonationRequest;
use App\Donations;
use App\Campaigns;
use App\User;
use App\TransactionBalance;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Mail;
use App\Mail\DonationEmail;
use Auth;
 
class DonationController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function donation($raising_link,DonationRequest $request)
    {
        $id_campaigns = Campaigns::where('raising_link','=',$raising_link)->first();
        $donation = new Donations();
        $donation->id_campaigns = $id_campaigns->id_campaigns;
        $donation->id = $this->user->id;
        $donation->id_paymentmethoddetail = $request->paymentmethod;
        $donation->amount_of_donation = $request->jumlahdonasi;
        $donation->support_description = $request->doa;
        $donation->unique_number = rand(100,999);
        $donation->user_is_anonim = $request->useranonim;
        $donation->donations_is_deleted = 'N';
        if($request->paymentmethod == '1')
        {
            if($request->jumlahdonasi > $this->user->balance)
            {
                return response()->json([
                    'code' => 401,
                    'message'=> 'Balance Anda Tidak Mencukupi Untuk Melakukan Donasi',
                    'status' => 0,
                    'data' => (object) array()
                ], 401);
            }
            else
            {
                $user = User::find($this->user->id);
                $donation->donations_status = '1';
                $transactionbalance = new TransactionBalance();
                $transactionbalance->id = $user->id;
                $transactionbalance->id_paymentmethoddetail = $request->paymentmethod;
                $kode = date('YmdHis') + $user->id;
                $transactionbalance->transaction_code = 'KT' . $kode;
                $transactionbalance->saldosebelumnya = $user->balance;
                $transactionbalance->nominaltransaction = $request->jumlahdonasi;
                $transactionbalance->kodeunik = "0";
                $transactionbalance->debit = "0";
                $transactionbalance->kredit = $request->jumlahdonasi;
                $transactionbalance->saldosesudahnya = $user->balance - $request->jumlahdonasi;
                $transactionbalance->keterangantransaksi = "Donasi Dengan Metode Pembayaran Balance";
                $transactionbalance->transaction_balance_status = "1";
                $transactionbalance->save();
                $user->balance -= $request->jumlahdonasi;
                $user->save();
                $donation->save();
                $campaigns = Campaigns::find($id_campaigns->id_campaigns);
                $campaigns->funds_collected += $request->jumlahdonasi;
                $campaigns->save();
                return response()->json([
                    'code' => 200,
                    'message' => 'Terima Kasih Donasi Anda Berhasil Kami Terima',
                    'status' => 0,
                    'data' => $donation
                ], 200);
            }
        }
        else
        {
            $donation->donations_status = '0';
            $donation->save();
            Mail::to($this->user->email)->send(new DonationEmail($donation));
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
                    'message' => 'Donasi Sedang Dalam Status Pending, Silahkan Proses Pembayaran Dalam Waktu 1x24 Jam',
                    'status' => 0,
                    'data' => $donation
                ], 200);
            }
        }
        
        
        

    }



}