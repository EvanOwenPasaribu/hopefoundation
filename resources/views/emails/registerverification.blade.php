<h3>Halo, {{ $user->name }} </h3>
<h5>Tinggal selangkah lagi, silahkan klik link berikut ini untuk melakukan <a href="{{url('auth/verifyemail')}}/{{$user->token_for_verification}}">Verifikasi</a></h5> 