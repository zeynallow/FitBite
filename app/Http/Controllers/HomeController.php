<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Blog;

class HomeController extends Controller
{

  /**
  * Home
  **/
  public function index(){

    $getLatestBlogs = Blog::limit(3)->orderBy('id','asc')->get();

    return view('site.pages.home',compact('getLatestBlogs'));
  }

}
