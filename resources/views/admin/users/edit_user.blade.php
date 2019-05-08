@extends('admin.app')

@section('content')


  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Users</h1>
  </div>

  <!-- Content Row -->
  <div class="row">

    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Update user</h6>
        </div>
        <div class="card-body">
          @if($alert_message)
          <div class="alert alert-danger">
            {{$alert_message}}
          </div>
        @endif
          <form class="" action="{{url('/admin/user/update').'/'.$user->id}}" method="post">
            @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" autocomplete="off"  name="name" id="name" class="form-control" value="{{$user->name}}">
                  @if(!empty($errors->get('name')))
                    <ul class="alert-danger">
                      @foreach ($errors->get('name') as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  @endif
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" class="form-control" value="{{$user->email}}">
                  @if(!empty($errors->get('email')))
                    <ul class="alert-danger">
                      @foreach ($errors->get('email') as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  @endif
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="role_id">Role</label>
                  <select class="form-control" name="role_id">
                    <option value="">Seçin</option>
                    @if($user->role_id == 1)
                      <option value="1" selected>Admin</option>
                      <option value="2">User</option>
                    @else
                      <option value="1">Admin</option>
                      <option value="2" selected>User</option>
                    @endif
                  </select>
                  @if(!empty($errors->get('role_id')))
                    <ul class="alert-danger">
                      @foreach ($errors->get('role_id') as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  @endif
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" id="password" autocomplete="off" class="form-control" value="" placeholder="Boş qaldıqda parol dəyişmir">
                  @if(!empty($errors->get('password')))
                    <ul class="alert-danger">
                      @foreach ($errors->get('password') as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  @endif
                </div>
              </div>
            </div>

            <div class="row justify-content-center">
              <div class="col-md-4">
                <div class="form-group">
                  <button type="submit" class="btn btn-primary form-control">Update</button>
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>


    @endsection
