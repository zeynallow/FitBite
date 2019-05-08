@extends('site.app')

@section('content')

  <section class="banner sample-menu-banner">
    <div class="bannerwrap">
      <figure><img src="/images/sample-menu-banner.jpg" alt="Sample menu banner" /></figure>
      <div class="banner-text text-center banner-text-page">
        <h1>{{$getPage->title}}</h1>
      </div>
    </div>
  </section>

  <main>
    <section class="block">
      <div class="container">
        {!! $getPage->content !!}
      </section>
    </div>
  </main>


@endsection
