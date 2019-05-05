<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;

class PageController extends Controller
{

    public function index($page_slug){

      $getPage = Page::where('slug',$page_slug)->firstOrFail();

      return view('site.pages.single_page',compact('getPage'));
    }
}
