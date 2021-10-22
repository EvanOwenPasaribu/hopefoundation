<?php
 
namespace App\Http\Controllers;

use App\Http\Requests\RegisterAuthRequest;
use App\Http\Requests\LoginAuthRequest;
use App\Http\Requests\ResendRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\User;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Mail;
use App\Mail\RegisterEmail;
use App\Mail\ResetPasswordEmail;
use Auth;
 
class LoginRegisterController extends Controller
{
    public $loginAfterSignUp = false;
 
    public function __construct()
    {
        $this->middleware('jwt',['except'=>['login','register','verifyEmail','resend','resetpassword','postresetpassword']]);
    }

    public function register(RegisterAuthRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->balance = 0;
        $user->nomorhp = $request->nomorhp;
        $user->logo = "/images/logo/default.jpg";
        $user->isverified = 'N';
        $user->users_status = '1';
        $user->status_penerimaan = '0';
        $user->token_for_verification = sha1(time());
        $user->token_for_reset_password = sha1(time());
        $user->save();
    
        if ($this->loginAfterSignUp) {
            return $this->login($request);
        }
        
        Mail::to($request->email)->send(new RegisterEmail($user));

        if (Mail::failures()) {
            return response()->json([
                'code' => 401,
                'message'=> 'Verifikasi Email Tidak Berhasil Dikirimkan',
                'status' => 0,
                'data' => $user
            ], 401);
        }else{
            return response()->json([
                'code' => 200,
                'message' => 'Pendaftaran Berhasil, Silahkan Cek Email Anda Untuk Melakukan Veriikasi',
                'status' => 0,
                'data' => $user
            ], 200);
        }

    }
 
    public function login(LoginAuthRequest $request)
    {
        $input = $request->only('email', 'password');
        $jwt_token = null;
        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                'code' => 401,
                'message' => 'Kombinasi email dan kata sandi tidak ditemukan',
                'status' => 0,
                'errors' => (object) array()
            ], 401);
        }
        $user = Auth::user();
        if($user->isverified == 'N')
        {
            return response()->json([
                'code' => 401,
                'message' => 'Anda belum melakukan verifikasi email, silahkan cek email anda',
                'status' => 0,
                'errors' => (object) array()
            ], 401);
        }
        $user->token = $jwt_token;
        return response()->json([
            'code' => 200,
            'message' => '',
            'status' => 0,
            'data' => $user
        ],200);
    }
 
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json([
            'code' => 200,
            'message' => 'User logged out successfully',
            'status' => 0,
            'data' => (object) array()
        ],200);
        
    }
 
    public function getAuthUser()
    {
        $user = JWTAuth::parseToken()->authenticate();
        return response()->json([
            'code' => 200,
            'message' => '',
            'status' => 0,
            'data' => $user
        ],200);
    }

    public function verifyEmail($token)
    {
        $verifyUser = User::where('token_for_verification', $token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser;
            if($user->isverified == 'N') {
                $user->isverified = 'Y';
                $user->save();
                return response()->json([
                    'code' => 200,
                    'message' => 'Email anda berhasil diverifikasi, sekarang anda dapat melakukan proses login',
                    'status' => 0,
                    'data' => $user
                ],200);
            } else {
                return response()->json([
                    'code' => 200,
                    'message' => 'Email anda sudah pernah diverifikasi, silahkan lakukan proses login',
                    'status' => 0,
                    'data' => $user
                ],200);
            }
        } else {
            return response()->json([
                'code' => 401,
                'message' => 'Email anda tidak ditemukan',
                'status' => 0,
                'errors' => (object) array()
            ], 401);
        }
    }

    public function resend(ResendRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if(!$user)
        {
            return response()->json([
                'code' => 401,
                'message' => 'Token sudah expired',
                'status' => 0,
                'errors' => (object) array()
            ], 401);
        }
        else
        {
            if($user->isverified == "Y")
            {
                return response()->json([
                    'code' => 401,
                    'message' => 'Email anda sudah diverifikasi',
                    'status' => 0,
                    'errors' => (object) array()
                ], 401);
            }
            else
            {
                $user->token_for_verification = sha1(time());
                $user->save();
                Mail::to($request->email)->send(new RegisterEmail($user));
                if (Mail::failures()) {
                    return response()->json([
                        'code' => 401,
                        'message'=> 'Verifikasi Email Tidak Berhasil Dikirimkan',
                        'status' => 0,
                        'data' => $user
                    ], 401);
                }else{
                    return response()->json([
                        'code' => 200,
                        'message' => 'Permintaan verifikasi ulang telah dikirimkan ke email anda',
                        'status' => 0,
                        'data' => $user
                    ],200);
                }
                
            }
            
        }
        
    }

    public function resetpassword(ResendRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if(!$user)
        {
            return response()->json([
                'code' => 401,
                'message' => 'Email anda tidak ditemukan',
                'status' => 0,
                'errors' => (object) array()
            ], 401);
        }
        else
        {
            $user->token_for_reset_password = sha1(time());
            $user->save();
            Mail::to($request->email)->send(new ResetPasswordEmail($user));
            if (Mail::failures()) {
                return response()->json([
                    'code' => 401,
                    'message'=> 'Email Reset Kata Sandi Tidak Berhasil Dikirimkan',
                    'status' => 0,
                    'data' => $user
                ], 401);
            }else{
                return response()->json([
                    'code' => 200,
                    'message' => 'Permintaan reset kata sandi telah dikirimkan ke email anda',
                    'status' => 0,
                    'data' => $user
                ],200);
            }
            
        }
        
    }

    public function postresetpassword(ResetPasswordRequest $request,$tokenresetpassword)
    {
        $resetpassword = User::where('token_for_reset_password', $tokenresetpassword)->first();
        if(isset($resetpassword) ){
            $user = $resetpassword;
            $user->password = bcrypt($request->password);
            $user->save();
            return response()->json([
                'code' => 200,
                'message' => 'Kata sandi anda berhasil diubah, silahkan lakukan proses login',
                'status' => 0,
                'data' => $user
            ],200);
        } else {
            return response()->json([
                'code' => 401,
                'message' => 'Token sudah expired',
                'status' => 0,
                'errors' => (object) array()
            ], 401);
        }
    }
}