<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\MealPlan;
use App\Slider;
use App\Blog;

class HomeController extends Controller
{

  /*
  * Home
  */
  public function index(){


    $getSlider = Slider::where('status',1)->orderBy('sort','asc')->get();
    $getMealPlans = MealPlan::orderBy('id','asc')->get();
    $getLatestBlogs = Blog::limit(3)->orderBy('id','asc')->get();

    return view('site.pages.home',compact('getLatestBlogs','getMealPlans','getSlider'));
  }

}
