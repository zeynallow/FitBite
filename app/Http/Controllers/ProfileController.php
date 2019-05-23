<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\OrderPlan;

class ProfileController extends Controller
{

  /*
  * Profile
  */

  public function index(){
    return redirect()->to('/profile/my-orders');
  }

  /*
  * User Orders
  */

  public function myOrders(){
    $user = Auth::user();

    $getOrders = OrderPlan::where('user_id',$user->id)->where('status','!=',0)->paginate(10);

    return view('site.profile.my_orders',compact('getOrders'));
  }


  /*
  * Profile
  */

  public function myProfile(){
    $user = Auth::user();


    return view('site.profile.my_profile',compact('user'));
  }


  }
