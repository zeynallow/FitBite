<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Slider;

use Validator;
use Carbon\Carbon;
use File;
use Image;

use App\Http\Controllers\Controller as Controller;


class SliderController extends Controller{


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
  * Sliders
  */
  public function allSlider(){
    $slider = Slider::orderBy('created_at', 'desc')->paginate(20);
    return view('admin.slider.all_slider',compact('slider'));
  }

  /*
  * Add Slide
  */

  public function addSlide(){
    return view('admin.slider.add_slider');
  }

  /*
  * Store Slide
  */

  public function storeSlide(Request $request){

    //Validation
    $validator = Validator::make($request->all(), [
      'title' => 'required|min:2|max:255',
      'content' => 'required',
      'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]
  );

  if($validator->fails()){
    $errors = $validator->errors();
    return view('admin.slider.add_slider', compact('errors'));
  }

  $photo = $request->file('image');

  #Upload
  File::makeDirectory($this->photos_path, $mode = 0777, true, true);
  $name = sha1(date('YmdHis') . str_random(30));
  $save_name = $name . '.' . $photo->getClientOriginalExtension();
  $resize_name = $name . str_random(2) . '.' . $photo->getClientOriginalExtension();
  $photo->move($this->photos_path, $save_name);
  $photo_name = $this->_photos_path . '/' . $save_name;

  #create
  Slider::create([
    'title'=>$request->title,
    'content' => $request->content,
    'status' => $request->status,
    'sort' => $request->sort,
    'url' => $request->url,
    'image'=>$photo_name
  ]);

  return redirect('/admin/slider/all');
}



/*
* Edit Slide
*/

public function editSlide($id){
  $slide = Slider::findOrFail($id);
  return view('admin.slider.edit_slider', compact('slide'));
}


/*
* Update Slide
*/

public function updateSlide(Request $request,$id){
  $slide = Slider::findOrFail($id);

  //Validation
  $validator = Validator::make($request->all(), [
    'title' => 'required|min:2|max:255',
    'content' => 'required',
    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
  ]
);

if($validator->fails()){
  $errors = $validator->errors();
  $slide = Slider::findOrFail($id);
  return view('admin.slider.edit_slider', compact('errors','slide'));
}


#Upload
$photo = $request->file('image');

if($photo){
  File::makeDirectory($this->photos_path, $mode = 0777, true, true);
  $name = sha1(date('YmdHis') . str_random(30));
  $save_name = $name . '.' . $photo->getClientOriginalExtension();
  $resize_name = $name . str_random(2) . '.' . $photo->getClientOriginalExtension();
  $photo->move($this->photos_path, $save_name);
  $photo_name = $this->_photos_path . '/' . $save_name;

  #Update Slide
  Slider::where('id', $id)->update([
    'title'=>$request->title,
    'content' => $request->content,
    'status' => $request->status,
    'sort' => $request->sort,
    'url' => $request->url,
    'image'=>$photo_name
  ]);

}else{
  #Update Slide
  Slider::where('id', $id)->update([
    'title'=>$request->title,
    'content' => $request->content,
    'status' => $request->status,
    'sort' => $request->sort,
    'url' => $request->url,
  ]);
}

return redirect('/admin/slider/all');
}

/*
* Delete Slide
*/

public function deleteSlide($id){
  $slide = Slider::findOrFail($id);
  $slide->delete();

  return redirect('/admin/slider/all');
}


}
