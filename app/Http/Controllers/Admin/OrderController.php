<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\OrderPlan;
use App\Http\Controllers\Controller as Controller;


class OrderController extends Controller{

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
  * All Orders
  */

  public function index(){
    $orders = OrderPlan::where('status','!=',0)->orderBy('created_at', 'desc')->paginate(20);
    return view('admin.orders.all_orders',compact('orders'));
  }

}
