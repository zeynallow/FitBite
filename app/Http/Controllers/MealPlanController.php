<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Page;
use App\MealPlan;

class MealPlanController extends Controller
{

  /*
  * Meal Plans
  */
  public function index($plan_slug=null){
    $getMealPlans = MealPlan::orderBy('id','asc')->get();
    return view('site.pages.meal_plan',compact('getMealPlans'));
  }

}
