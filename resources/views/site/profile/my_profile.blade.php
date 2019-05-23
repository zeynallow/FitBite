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
          
      </div>

    </section>
  </main>


@endsection
