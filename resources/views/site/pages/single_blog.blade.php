@extends('site.app')

@section('content')

  <section class="banner sample-menu-banner">
    <div class="bannerwrap">
      <figure><img src="/images/sample-menu-banner.jpg" alt="Sample menu banner" /></figure>
      <div class="banner-text text-center banner-text-page">
        <h1>{{$getBlog->title}}</h1>
      </div>
    </div>
  </section>

  <main>
    <section class="block">
      <div class="container">
        <span class="posted-date"><i class="fa fa-calendar"></i> {{$getBlog->created_at->diffForHumans()}}</span>
        <span class="posted-views"><i class="fa fa-eye"></i>  {{$getBlog->views}}</span>
        {!! $getBlog->content !!}
      </section>
    </div>
  </main>


@endsection
