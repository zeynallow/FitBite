<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Blog;
use Validator;
use App\Http\Controllers\Controller as Controller;


class BlogController extends Controller{

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
  * Blog
  */
  public function allBlogs(){
    $blogs = Blog::orderBy('created_at', 'desc')->paginate(20);
    return view('admin.blogs.all_blogs',compact('blogs'));
  }

  /*
  * Add Blog
  */

  public function addBlog(){
    return view('admin.blogs.add_blog');
  }

  /*
  * Store Blog
  */

  public function storeBlog(Request $request){

    //Validation
    $validator = Validator::make($request->all(), [
      'title' => 'required|min:2|max:255',
      'content' => 'required'
    ]
  );

  if($validator->fails()){
    $errors = $validator->errors();
    return view('admin.blogs.add_blog', compact('errors'));
  }

  #create
  Blog::create([
    'title'=>$request->title,
    'slug'=>str_slug($request->title),
    'content' => $request->content
  ]);

  return redirect('/admin/blog/all');
}



/*
* Edit Blog
*/

public function editBlog($id){
  $blog = Blog::findOrFail($id);
  return view('admin.blogs.edit_blog', compact('blog'));
}


/*
* Update Blog
*/

public function updateBlog(Request $request,$id){
  $blog = Blog::findOrFail($id);

  //Validation
  $validator = Validator::make($request->all(), [
    'title' => 'required|min:2|max:255',
    'content' => 'required'
  ]
);

if($validator->fails()){
  $errors = $validator->errors();
  $blog = Blog::findOrFail($id);
  return view('admin.blogs.edit_blog', compact('errors','blog'));
}


#Update Blog
Blog::where('id', $id)->update([
  'title'=>$request->title,
  'slug'=>$request->slug,
  'content' => $request->content
]);

return redirect('/admin/blog/all');
}

/*
* Delete Blog
*/

public function deleteBlog($id){
  $blog = Blog::findOrFail($id);
  $blog->delete();

  return redirect('/admin/blog/all');
}


}
