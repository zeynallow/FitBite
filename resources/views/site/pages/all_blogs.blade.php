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

                <div class="blog-listing-wrap">
                  <div class="row">
                    <div class="col-xs-12 col-sm-12 wow fadeInUp blog-post">
                      <div class="blog-post-wrap">
                        <span class="posted-date">{{$blog->created_at}}</span>
                        <h3><a href="/blog/{{$blog->slug}}">{{$blog->title}}</a></h3>
                        <figure>
                          <a href="/blog/{{$blog->slug}}">
                            <img width="100%" src="images/blog-img1.jpg" alt="Blog image" />
                          </a>
                        </figure>
                        <p>{!! $blog->content !!}</p>
                        <a href="/blog/{{$blog->slug}}" class="text-capitalize pull-right read-more-btn">read more</a>
                      </div>
                    </div>
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

              <!-- == search block starts == -->
              <div class="search-section">
                <form>
                  <fieldset><input type="text" /></fieldset>
                </form>
              </div>
              <!-- == search block ends == -->

              <!-- == popular posts block starts == -->
              <div class="sidebar-widget popular-posts">
                <h6 class="text-uppercase">POPULAR POSTS</h6>
                <ul>
                  <li>
                    <figure><a href="#"><img class="img-responsive" src="images/image-small1.jpg" alt="Post image" /></a></figure>
                    <h6><a href="#">Getting Saucy: Pineapple Salsa</a></h6>
                  </li>
                  <li>
                    <figure><a href="#"><img class="img-responsive" src="images/image-small2.jpg" alt="Post image" /></a></figure>
                    <h6><a href="#">6 Tips to Make Paleo Eating Easy</a></h6>
                  </li>
                  <li>
                    <figure><a href="#"><img class="img-responsive" src="images/image-small3.jpg" alt="Post image" /></a></figure>
                    <h6><a href="#">5 Simple &amp; Healthy Gluten Free Cookies</a></h6>
                  </li>
                  <li>
                    <figure><a href="#"><img class="img-responsive" src="images/image-small4.jpg" alt="Post image" /></a></figure>
                    <h6><a href="#">#CookingwithMadang Weekly Harvest</a></h6>
                  </li>
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
