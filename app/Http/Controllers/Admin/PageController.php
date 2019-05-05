<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Page;
use Validator;
use App\Http\Controllers\Controller as Controller;


class PageController extends Controller{

  public function __construct(){

     $this->middleware(function ($request, $next) {
         $this->user = auth()->user();
         if($this->user->role_id != 1){
            abort(403);
         }else{
            return $next($request);
         }
     });
  }

  /*
  * Page
  */
  public function allPages(){
    $pages = Page::orderBy('created_at', 'desc')->paginate(20);
    return view('admin.pages.all_pages',compact('pages'));
  }

  /*
  * Add Page
  */

  public function addPage(){
    return view('admin.pages.add_page');
  }

  /*
  * Store Page
  */

  public function storePage(Request $request){

    //Validation
    $validator = Validator::make($request->all(), [
      'title' => 'required|min:2|max:255',
      'content' => 'required'
    ]
  );

  if($validator->fails()){
    $errors = $validator->errors();
    return view('admin.pages.add_page', compact('errors'));
  }

  #create
  Page::create([
    'title'=>$request->title,
    'slug'=>str_slug($request->title),
    'content' => $request->content
  ]);

  return redirect('/admin/page/all');
}



/*
* Edit Page
*/

public function editPage($id){
  $page = Page::findOrFail($id);
  return view('admin.pages.edit_page', compact('page'));
}


/*
* Update Page
*/

public function updatePage(Request $request,$id){
  $page = Page::findOrFail($id);

  //Validation
  $validator = Validator::make($request->all(), [
    'title' => 'required|min:2|max:255',
    'content' => 'required'
  ]
);

if($validator->fails()){
  $errors = $validator->errors();
  $page = Page::findOrFail($id);
  return view('admin.pages.edit_page', compact('errors','page'));
}


#Update Page
Page::where('id', $id)->update([
  'title'=>$request->title,
  'slug'=>$request->slug,
  'content' => $request->content
]);

return redirect('/admin/page/all');
}

/*
* Delete Page
*/

public function deletePage($id){
  $page = Page::findOrFail($id);
  $page->delete();

  return redirect('/admin/page/all');
}


}
