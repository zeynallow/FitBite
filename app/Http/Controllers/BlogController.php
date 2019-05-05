<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;

class BlogController extends Controller
{

  /*
  * All blogs
  */
  public function index(){

    $getBlogs = Blog::paginate(2);

    return view('site.pages.all_blogs',compact('getBlogs'));
  }

  /*
  * Single blog
  */

  public function getBlog($blog_slug){

    $getBlog = Blog::where('slug',$blog_slug)->firstOrFail();

    return view('site.pages.single_blog',compact('getBlog'));
  }

}
