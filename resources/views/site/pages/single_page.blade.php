@extends('site.app')

@section('content')

  <section class="banner sample-menu-banner">
    <div class="bannerwrap">
      <figure><img src="/images/sample-menu-banner.jpg" alt="Sample menu banner" /></figure>
      <div class="banner-text text-center">
        <h1 class="text-uppercase">{{$getPage->title}}</h1>
      </div>
    </div>
  </section>

  <main>
    <section style="padding:0px;" class="block">
      {!! $getPage->content !!}
    </section>
  </main>


@endsection
