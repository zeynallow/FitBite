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


  /*
  * Order Status Change
  */

  public function statusApprove($order_id){
    $change = OrderPlan::where('id',$order_id)->update(['status'=>2]);

    if($change){
      return response()->json(['message'=>'success'],201);
    }else{
      return response()->json(['message'=>'error'],400);
    }
  }

  public function statusDecline($order_id){
    $change = OrderPlan::where('id',$order_id)->update(['status'=>3]);

    if($change){
      return response()->json(['message'=>'success'],201);
    }else{
      return response()->json(['message'=>'error'],400);
    }
  }

  public function paymentPaid($order_id){
    $change = OrderPlan::where('id',$order_id)->update(['payment_status'=>1]);

    if($change){
      return response()->json(['message'=>'success'],201);
    }else{
      return response()->json(['message'=>'error'],400);
    }
  }

  public function paymentNoPaid($order_id){
    $change = OrderPlan::where('id',$order_id)->update(['payment_status'=>0]);

    if($change){
      return response()->json(['message'=>'success'],201);
    }else{
      return response()->json(['message'=>'error'],400);
    }
  }


}
