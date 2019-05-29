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

    $getBlogs = Blog::paginate(6);
    $getPopularBlogs = Blog::orderBy('views','desc')->limit(10)->get();

    return view('site.pages.all_blogs',compact('getBlogs','getPopularBlogs'));
  }

  /*
  * Single blog
  */

  public function getBlog($blog_slug){

    $_getBlog = Blog::where('slug',$blog_slug);
    $_getBlog->increment('views');
    $getBlog = $_getBlog->firstOrFail();

    return view('site.pages.single_blog',compact('getBlog'));
  }

}
