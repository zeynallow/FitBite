<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class DashboardController extends Controller
{


  public function __construct(){

     $this->middleware(function ($request, $next) {
         $this->user = auth()->user();
         if($this->user->role_id != 1){
            abort(403);
         }else{
            return $next($request);
         }
     });
  }

  /*
  * Dashboard
  */

  public function index(){
    return view('admin.dashboard');
  }

}
