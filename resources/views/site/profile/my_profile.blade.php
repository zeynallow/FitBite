@extends('site.app')

@section('content')

  <section class="banner sample-menu-banner">
    <div class="bannerwrap">
      <figure><img src="/images/sample-menu-banner.jpg" alt="Sample menu banner" /></figure>
      <div class="banner-text text-center banner-text-page">
        <h1>My Profile</h1>
      </div>
    </div>
  </section>

  <main>
    <section style="padding:0px;" class="block">

      <div class='food-tab'>
        <div class='container'>
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class=""><a href="/profile/my-orders">My Orders</a></li>
            <li role="presentation" class="active"><a href="/profile/my-profile">My Profile</a></li>
          </ul>
        </div>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-md-6">

            @if( Session::has( 'success' ))
              <div class="alert alert-success">
              {{ Session::get( 'success' ) }}
            </div>
            @endif

            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <form class="" action="" method="post">
              @csrf
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name"  class="form-control" value="{{(Auth::user()) ? Auth::user()->name : ''}}">
              </div>

              <div class="form-group">
                <label for="email">E-mail</label>
                <input type="text" name="email" id="email" class="form-control" value="{{(Auth::user()) ? Auth::user()->email : ''}}">
              </div>

              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{(Auth::user()) ? Auth::user()->phone : ''}}">
              </div>

              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" value="">
                <small>Leave empty to keep the same</small>
              </div>

              <div class="form-group" id="f_password" style="display:none;">
                <label for="c_password">Confirm Password</label>
                <input type="password" id="c_password" name="password_confirmation" class="form-control" value="">
              </div>

              <div class="form-group">
                <button type="submit" class="form-control btn btn-success" name="button">Update profile</button>
              </div>


            </form>
          </div>
        </div>
      </div>

    </section>
  </main>


@endsection
@push('js')
  <script type="text/javascript">
  $('#password').keyup(function(){
    var pass = $(this).val();
    if(pass.length > 0){
      $("#f_password").fadeIn();
    }else{
      $("#f_password").fadeOut();
    }
  });
  </script>
@endpush
