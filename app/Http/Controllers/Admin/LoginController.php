<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\User;
use App\Http\Controllers\Controller as Controller;

class LoginController extends Controller
{


  use AuthenticatesUsers;

  protected $redirectTo = '/admin';

  public function __construct(){
    $this->middleware('guest')->except('logout');
  }

  /*
  * Login
  */

  public function index(){
    return view('admin.login');
  }


  /*
  * DoLogin
  */

  public function doLogin(Request $request){

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials) && Auth::user()->role_id == 1) {
      return redirect('admin/dashboard');
    }else{
      Session::flash('error', "E-mail or password is wrong");
      return redirect()->back();
    }

  }

  public function logout(){
    Auth::logout();

    return redirect('admin/login');
  }


}
