<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;

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


    //Validation
    $validator = Validator::make($request->all(), [
      'select_eat_time' => 'required',
      'select_day_per_week' => 'required',
      'select_day' => 'required'
    ]
  );

  if($validator->fails()){
    return redirect()->to('/home');
  }


  $user = Auth::user();
  $getPlan = MealPlan::where('id',$plan_id)->firstOrFail();


  $price_eat_time=0;
  $total_price = 0;

  if($request->select_eat_time == 1){
    $price_eat_time = $getPlan->full_day;
  }else{
    $price_eat_time = $getPlan->half_day;
  }


  if($request->select_day == 1){
    $total_price=$price_eat_time;
  }elseif($request->select_day == 2){
    $total_price=$request->select_day_per_week*$price_eat_time;
  }else{
    $total_price=$request->select_day_per_week*4*$price_eat_time;
  }


  $getOrder = OrderPlan::create([
    'user_id'=>$user->id,
    'plan_id'=> $plan_id,
    'select_day'=>$request->select_day,
    'select_day_per_week'=>$request->select_day_per_week,
    'select_eat_time'=>$request->select_eat_time,
    'status'=>0,
    'amount'=>$total_price,
    'currency'=>'AED',
    'payment_status'=>0
  ]);

  // event(new \App\Events\NewOrder($user->name));

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
