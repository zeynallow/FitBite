<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Register Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles the registration of new users as well as their
  | validation and creation. By default this controller uses a trait to
  | provide this functionality without requiring any additional code.
  |
  */

  use RegistersUsers;

  /**
  * Where to redirect users after registration.
  *
  * @var string
  */
  protected $redirectTo = '/home';

  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct()
  {
    $this->middleware('guest');
  }


  /*
  * Register Request
  */
  public function doRegister(Request $request){

    $validator = Validator::make($request->all(), [
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', 'min:6', 'max:255', 'confirmed'],
    ],
    [
      'name.required' => 'Adınızı daxil edin',
      'name.max' => 'Adınız maksimum 255 simvol ola bilər',
      'password.required' => 'Şifrəni daxil edin',
      'password.min' => 'Şifrə minimum 6 simvol ola bilər',
      'password.max' => 'Şifrə maksimum 255 simvol ola bilər',
      'password.confirmed' => 'Şifrələr eyni deyil',
      'email.required' => 'E-mail daxil edin',
      'email.email' => 'E-maili düzgün daxil edin',
      'email.unique' => 'Bu e-mail artıq istifadə olunur',
    ]
  );


  if ($validator->fails()){
    return response()->json(['errors'=>$validator->errors()->all()]);
  }

  if(!Auth::guest()){
    return response()->json(['errors'=>['Siz artıq qeydiyyatdan keçmisiniz']], 200);
  }

  $create = User::create([
    'name' => $request['name'],
    'phone' => $request['phone'],
    'email' => $request['email'],
    'password' => Hash::make($request['password']),
  ]);


  if ($create) {
    Auth::attempt(['email'=>$create->email,'password'=>$request['password']]);

    return response()->json(['message' => "success"]);

  }else{
    return response()->json(['errors'=>['Səhv baş verdi']], 200);
  }

}

}
