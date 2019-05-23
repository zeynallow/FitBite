<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Page;
use App\MealPlan;
use App\OrderPlan;

class MealPlanController extends Controller
{

  /*
  * Meal Plans
  */
  public function index($plan_slug=null){
    $getMealPlans = MealPlan::orderBy('id','asc')->get();
    return view('site.pages.meal_plan',compact('getMealPlans'));
  }


  /*
  * Order Meal Plan
  */
  public function orderPlanGenerate(Request $request, $plan_id){

    if(Auth::guest()){
      return redirect()->to('/home');
    }

    if(empty($plan_id)){
      return redirect()->to('/home');
    }

    $user = Auth::user();

    $getOrder = OrderPlan::create([
      'user_id'=>$user->id,
      'plan_id'=> $plan_id,
      'select_day'=>$request->select_day,
      'select_day_per_week'=>$request->select_day_per_week,
      'select_eat_time'=>$request->select_eat_time,
      'status'=>0,
      'amount'=>0,
      'currency'=>'AED',
      'payment_status'=>0
    ]);

    if($getOrder){
      return redirect()->to("/order/{$getOrder->id}");
    }else{
      abort(404);
    }

  }

  /*
  * Order Meal Plan
  */
  public function orderPlan($order_id){

    if(Auth::guest()){
      return redirect()->to('/home');
    }

    if(empty($order_id)){
      return redirect()->to('/home');
    }


    $user = Auth::user();

    $getOrder = OrderPlan::where('user_id',$user->id)
    ->where('id',$order_id)
    ->firstOrFail();

    return view('site.pages.order_plan',compact('getOrder'));
  }


  /*
  * Confirm Order Meal Plan
  */
  public function confirmOrderPlan(Request $request, $order_id){

    if(Auth::guest()){
      return redirect()->to('/home');
    }

    if(empty($order_id)){
      return redirect()->to('/home');
    }

    $user = Auth::user();

    $updatePlan = OrderPlan::where('user_id',$user->id)
    ->where('id',$order_id)
    ->update([
      'start_date'=>$request->start_date,
      'status'=>1, //user confirm
      'payment_status'=>0 //no payment
    ]);

    return redirect()->to('/profile/my-orders');
  }


}
