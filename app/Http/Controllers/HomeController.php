<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\MealPlan;
use App\Blog;

class HomeController extends Controller
{

  /*
  * Home
  */
  public function index(){


    $getMealPlans = MealPlan::orderBy('id','asc')->get();
    $getLatestBlogs = Blog::limit(3)->orderBy('id','asc')->get();

    return view('site.pages.home',compact('getLatestBlogs','getMealPlans'));
  }

}
