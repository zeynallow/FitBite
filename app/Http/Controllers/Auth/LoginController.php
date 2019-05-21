<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles authenticating users for the application and
  | redirecting them to your home screen. The controller uses a trait
  | to conveniently provide its functionality to your applications.
  |
  */

  use AuthenticatesUsers;

  /**
  * Where to redirect users after login.
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
  }



  // public function index()
  // {
  //   if(Auth::user()){
  //     return redirect()->to("/home");
  //   }else{
  //     return view('Desktop.pages.login');
  //   }
  //
  // }
  //

  /*
  * Login Request
  */

  public function doLogin(Request $request){
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
      return response()->json(['message' => "success"]);
    }else{
      return response()->json(['message'=>"E-mail or password is wrong!"]);
    }

  }

  /*
  * Logout
  */
  public function doLogout(){
    Auth::logout();
    return redirect()->back();
  }
}
