<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\MealPlan;
use App\MealPlanIncludes;

use Validator;
use Carbon\Carbon;
use File;
use Image;

use App\Http\Controllers\Controller as Controller;


class MealPlanController extends Controller{


  private $photos_path;
  private $_photos_path;

  public function __construct(){

    $this->middleware(function ($request, $next) {
      $this->user = auth()->user();
      if($this->user->role_id != 1){
        abort(403);
      }else{
        return $next($request);
      }
    });

    $time = Carbon::now();
    $this->photos_path = public_path('/uploads/' . date_format($time, 'Y') . '/' . date_format($time, 'm') . '/' . date_format($time, 'd'));
    $this->_photos_path = '/uploads/' . date_format($time, 'Y') . '/' . date_format($time, 'm') . '/' . date_format($time, 'd');


  }

  /*
  * Meal Plan
  */
  public function allPlans(){
    $plans = MealPlan::orderBy('created_at', 'desc')->paginate(20);
    return view('admin.meal-plans.all_plans',compact('plans'));
  }

  /*
  * Add Plan
  */

  public function addPlan(){
    return view('admin.meal-plans.add_plan');
  }

  /*
  * Store Plan
  */

  public function storePlan(Request $request){

    //Validation
    $validator = Validator::make($request->all(), [
      'name' => 'required|min:2|max:255',
      'full_day' => 'required',
      'half_day' => 'required',
      'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]
  );

  if($validator->fails()){
    $errors = $validator->errors();
    return view('admin.meal-plans.add_plan', compact('errors'));
  }

  $photo = $request->file('cover');

  #Upload
  File::makeDirectory($this->photos_path, $mode = 0777, true, true);
  $name = sha1(date('YmdHis') . str_random(30));
  $save_name = $name . '.' . $photo->getClientOriginalExtension();
  $resize_name = $name . str_random(2) . '.' . $photo->getClientOriginalExtension();
  $photo->move($this->photos_path, $save_name);
  $photo_name = $this->_photos_path . '/' . $save_name;


  #create
  $create = MealPlan::create([
    'name'=>$request->name,
    'full_day'=>$request->full_day,
    'half_day'=>$request->half_day,
    'slug'=>str_slug($request->name),
    'cover' => $photo_name
  ]);

  return redirect("/admin/meal-plan/edit/{$create->id}");
}



/*
* Edit Plan
*/

public function editPlan($id){
  $plan = MealPlan::findOrFail($id);
  return view('admin.meal-plans.edit_plan', compact('plan'));
}


/*
* Update Plan
*/

public function updatePlan(Request $request,$id){
  $plan = MealPlan::findOrFail($id);

  //Validation
  $validator = Validator::make($request->all(), [
    'name' => 'required|min:2|max:255',
    'full_day' => 'required',
    'half_day' => 'required',
    'cover' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
  ]
);

if($validator->fails()){
  $errors = $validator->errors();
  return view('admin.meal-plans.edit_plan', compact('errors','plan'));
}


#Upload
$photo = $request->file('cover');
if($photo){
  File::makeDirectory($this->photos_path, $mode = 0777, true, true);
  $name = sha1(date('YmdHis') . str_random(30));
  $save_name = $name . '.' . $photo->getClientOriginalExtension();
  $resize_name = $name . str_random(2) . '.' . $photo->getClientOriginalExtension();
  $photo->move($this->photos_path, $save_name);
  $photo_name = $this->_photos_path . '/' . $save_name;

  #Update Plan
  MealPlan::where('id', $id)->update([
    'name'=>$request->name,
    'full_day'=>$request->full_day,
    'half_day'=>$request->half_day,
    'cover' => $photo_name
  ]);

}else{

  #Update Plan
  MealPlan::where('id', $id)->update([
    'name'=>$request->name
  ]);

}


return redirect('/admin/meal-plan/all');
}

/*
* Delete Plan
*/

public function deletePlan($id){
  $plan = MealPlan::findOrFail($id);
  $plan->delete();

  return redirect('/admin/meal-plan/all');
}


/*
* Add Includes
*/

public function addInclude(Request $request){

  //Validation
  $validator = Validator::make($request->all(), [
    'cover' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
  ]
  );


  if($validator->fails()){
    $errors = $validator->errors();
    return response()->json($errors,400);
  }

  #Upload
  $photo = $request->file('cover');
  if($photo){
    File::makeDirectory($this->photos_path, $mode = 0777, true, true);
    $name = sha1(date('YmdHis') . str_random(30));
    $save_name = $name . '.' . $photo->getClientOriginalExtension();
    $resize_name = $name . str_random(2) . '.' . $photo->getClientOriginalExtension();
    $photo->move($this->photos_path, $save_name);
    $photo_name = $this->_photos_path . '/' . $save_name;
  }else{
    $photo_name=NULL;
  }


  $includes = MealPlanIncludes::create([
    'plan_id'=>$request->plan_id,
    'name'=>$request->name,
    'includes'=>$request->includes,
    'cover'=>$photo_name
  ]);

  return response()->json($includes);

}

/*
* Delete Includes
*/

public function deleteInclude(Request $request){

  $delete = MealPlanIncludes::where('id',$request->id)->delete();

  return response()->json($delete);

}


}
