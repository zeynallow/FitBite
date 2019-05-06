<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Blog;

use Validator;
use Carbon\Carbon;
use File;
use Image;

use App\Http\Controllers\Controller as Controller;


class BlogController extends Controller{


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
      'content' => 'required',
      'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]
  );

  if($validator->fails()){
    $errors = $validator->errors();
    return view('admin.blogs.add_blog', compact('errors'));
  }


  $photo = $request->file('cover');

  #Upload
  File::makeDirectory($this->photos_path, $mode = 0777, true, true);

  $name = sha1(date('YmdHis') . str_random(30));
  $save_name = $name . '.' . $photo->getClientOriginalExtension();
  $resize_name = $name . str_random(2) . '.' . $photo->getClientOriginalExtension();

  Image::make($photo)
  ->resize(250, null, function ($constraints) {
    $constraints->aspectRatio();
  })
  ->save($this->photos_path . '/' . $resize_name);

  $photo->move($this->photos_path, $save_name);

  $photo_name = $this->_photos_path . '/' . $save_name;
  $photo_cover = $this->_photos_path . '/' . $resize_name;


  #create
  Blog::create([
    'title'=>$request->title,
    'slug'=>str_slug($request->title),
    'content' => $request->content,
    'photo' => $photo_name,
    'cover' => $photo_cover
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
    'content' => 'required',
    'cover' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
  ]
);

if($validator->fails()){
  $errors = $validator->errors();
  $blog = Blog::findOrFail($id);
  return view('admin.blogs.edit_blog', compact('errors','blog'));
}


#Upload
$photo = $request->file('cover');
if($photo){

  File::makeDirectory($this->photos_path, $mode = 0777, true, true);

  $name = sha1(date('YmdHis') . str_random(30));
  $save_name = $name . '.' . $photo->getClientOriginalExtension();
  $resize_name = $name . str_random(2) . '.' . $photo->getClientOriginalExtension();

  Image::make($photo)
  ->resize(250, null, function ($constraints) {
    $constraints->aspectRatio();
  })
  ->save($this->photos_path . '/' . $resize_name);

  $photo->move($this->photos_path, $save_name);

  $photo_name = $this->_photos_path . '/' . $save_name;
  $photo_cover = $this->_photos_path . '/' . $resize_name;

  #Update Blog
  Blog::where('id', $id)->update([
    'title'=>$request->title,
    'slug'=>$request->slug,
    'content' => $request->content,
    'photo' => $photo_name,
    'cover' => $photo_cover
  ]);
  
}else{

  #Update Blog
  Blog::where('id', $id)->update([
    'title'=>$request->title,
    'slug'=>$request->slug,
    'content' => $request->content
  ]);

}





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
