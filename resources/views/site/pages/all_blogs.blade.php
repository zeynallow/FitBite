@extends('site.app')

@section('content')

  <section class="banner sample-menu-banner">
    <div class="bannerwrap">
      <figure><img src="/images/sample-menu-banner.jpg" alt="Sample menu banner" /></figure>
      <div class="banner-text text-center">
        <h1 style="color:#000" class="text-uppercase">Blogs</h1>
      </div>
    </div>
  </section>

  <main>
    <section class='block blog-listing-block'>
      <div class='container'>
        <div class="row">
          <div class="col-xs-12 col-sm-8 col-md-9 blog-lisiting">

            @if($getBlogs)
              @foreach ($getBlogs as $key => $blog)
                <div class="col-xs-6 col-sm-6 wow fadeInUp blog-post">
                  <div class="blog-post-wrap">
                    <figure>
                      <a href="/blog/{{$blog->slug}}">
                        <img class="blog-img" width="100%" src="{{$blog->cover}}" alt="{{str_limit($blog->title,70)}}" />
                      </a>
                    </figure>
                      <span class="posted-date"><i class="fa fa-calendar"></i> {{$blog->created_at->diffForHumans()}}</span>
                      <span class="posted-views"><i class="fa fa-eye"></i>  {{$blog->views}}</span>
                      <h3><a href="/blog/{{$blog->slug}}">{{str_limit($blog->title,70)}}</a></h3>
                  </div>
                </div>
              @endforeach
            @endif


            <div class="pull-right pagination">
              {{$getBlogs}}
            </div>

          </div>

          <div class="col-xs-12 col-sm-4 col-md-3 blog-right-sidebar">
            <div class="sidebar-wrap">

              {{-- <div class="search-section">
                <form>
                  <fieldset><input type="text" /></fieldset>
                </form>
              </div> --}}

              <!-- == popular posts block starts == -->
              <div class="sidebar-widget popular-posts">
                <h6 class="text-uppercase">POPULAR POSTS</h6>
                <ul>
                  @if($getPopularBlogs)
                    @foreach ($getPopularBlogs as $key => $blog)
                      <li>
                        <div class="row">
                        <div class="col-md-4">
                          <a href="/blog/{{$blog->slug}}"><img class="img-responsive" src="{{$blog->cover}}" alt="Post image" /></a></figure>
                        </div>
                        <div class="col-md-8">
                          <h6><a href="/blog/{{$blog->slug}}">{{str_limit($blog->title,50)}}</a></h6>
                        </div>
                        </div>
                      </li>
                    @endforeach
                  @endif
                </ul>
              </div>
              <!-- == popular posts block ends == -->



            </div>
          </div>
          <!-- == blog right sidebar ends == -->

        </div>
      </div>
    </section>
    <!-- =============== blog listing block ends ================== -->

  </main>


@endsection
