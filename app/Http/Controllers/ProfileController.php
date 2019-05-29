<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;

use App\User;
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
  * Cancel Order
  */

  public function orderCancel($order_id){
    $user = Auth::user();

    $change = OrderPlan::where('id',$order_id)->where('user_id',$user->id)->update(['status'=>4]);

    return redirect()->back();
  }

  /*
  * Profile
  */

  public function myProfile(){
    $user = Auth::user();


    return view('site.profile.my_profile',compact('user'));
  }

  /*
  * Profile
  */

  public function storeProfile(Request $request){
    $user = Auth::user();

    if(empty($request->password)){

      $validator = Validator::make($request->all(), [
        'name' => ['required', 'string', 'max:255'],
        'phone' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id.'']
      ]
    );

    if ($validator->fails()){
      return redirect()->back()->withErrors($validator->errors()->all());
    }

    $updateProfile = User::where('id',$user->id)->update([
      'name' => $request['name'],
      'phone' => $request['phone'],
      'email' => $request['email']
    ]);

  }else{

    $validator = Validator::make($request->all(), [
      'name' => ['required', 'string', 'max:255'],
      'phone' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id.''],
      'password' => ['required', 'string', 'min:6', 'max:255', 'confirmed'],
    ]
  );

  if ($validator->fails()){
    return redirect()->back()->withErrors($validator->errors()->all());
  }

  $updateProfile = User::where('id',$user->id)->update([
    'name' => $request['name'],
    'phone' => $request['phone'],
    'email' => $request['email'],
    'password' => Hash::make($request['password'])
  ]);
}


return redirect()->back()->withSuccess('Profile updated!');
}


}
