<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use Validator;
use App\Http\Controllers\Controller as Controller;

class UserController extends Controller
{

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
  * All Users
  */

  public function allUsers(){
    $users = User::orderBy('created_at', 'desc')->paginate(20);
    return view('admin.users.all_users',compact('users'));
  }


  /*
  * Edit User
  */

  public function editUser($id){
    $user = User::findOrFail($id);
    $alert_message=NULL;
    return view('admin.users.edit_user', compact('user','alert_message'));
  }


  /*
  * Update Product
  */

  public function updateUser(Request $request,$id){
    $user = User::findOrFail($id);
    $alert_message = NULL;
    //Validation
    $validator = Validator::make($request->all(), [
      'email' => 'required|email',
      'name' => 'required|min:2|max:255',
      'role_id' => 'required'
    ],
    [
      'email.email' => 'Emaili düzgün daxil edin',
      'name.min' => 'Ad minimum 2 simvol ola bilər',
      'name.max' => 'Ad maksimum 255 simvol ola bilər',
      'name.required' => 'Ad boş ola bilməz',
      'role_id.required' => 'Rol boş ola bilməz',
    ]
  );

  if($validator->fails()){
    $errors = $validator->errors();
    return view('admin.users.edit_user', compact('errors','user','alert_message'));
  }


  #Update User
  if($user->role_id == 1 && $request->role_id == 2){
    $checkAdmin = User::where('role_id',1)->count();

    if($checkAdmin == 1){
      $alert_message = 'Ən azı bir admin olmalıdır';
      return view('admin.users.edit_user', compact('errors','user','alert_message'));
    }
  }

  if(empty($request->password)){
    User::where('id', $id)->update([
      'name'=>$request->name,
      'email'=>$request->email,
      'role_id' => $request->role_id
    ]);
  }else{
    User::where('id', $id)->update([
      'name'=>$request->name,
      'email'=>$request->email,
      'role_id' => $request->role_id,
      'password' => bcrypt($request->password)
    ]);
  }


  return redirect('/admin/user/all');
}

/*
* Delete Product
*/

public function deleteUser($id){
  $user = User::findOrFail($id);
  $user->delete();

  return redirect('/admin/user/all');
}



}
